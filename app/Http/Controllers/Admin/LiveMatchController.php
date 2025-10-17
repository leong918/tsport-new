<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\LiveMatchRepository;
use App\Repositories\MatchRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class LiveMatchController extends BaseController
{
    private LiveMatchRepository $liveMatchRepository;
    private MatchRepository $matchRepository;

    public function __construct(
        LiveMatchRepository $liveMatchRepository,
        MatchRepository $matchRepository
    ) {
        $this->liveMatchRepository = $liveMatchRepository;
        $this->matchRepository = $matchRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->liveMatchRepository->allQuery()
                ->with(['match'])
                ->select('live_match.*');

            return DataTables::of($model)
                ->addColumn('match_title', function ($model) {
                    return $model->match ? $model->match->match_title : 'N/A';
                })
                ->addColumn('obs_status_badge', function ($model) {
                    $statusText = $model->obs_status_text;
                    $badgeClass = match($model->obs_status) {
                        0 => 'bg-secondary',      // Stopped
                        1 => 'bg-warning',        // Starting
                        2 => 'bg-danger',         // Live
                        3 => 'bg-info',           // Stopping
                        default => 'bg-secondary'
                    };
                    return "<span class='badge {$badgeClass}'>{$statusText}</span>";
                })
                ->addColumn('viewer_count', function ($model) {
                    return number_format($model->viewer_count);
                })
                ->addColumn('stream_duration', function ($model) {
                    if (!$model->stream_started_at) {
                        return '-';
                    }
                    $endTime = $model->stream_ended_at ?: now();
                    $duration = $model->stream_started_at->diffInMinutes($endTime);
                    return $duration . ' min';
                })
                ->addColumn('status', function ($model) {
                    $route = route('admin.live-match.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    return $this->view('live-match.action', compact('model'));
                })
                ->rawColumns(['obs_status_badge', 'status', 'action'])
                ->make(true);
        }

        return $this->view('live-match.index');
    }

    public function create()
    {
        // First check for unique available matches
        $uniqueMatches = $this->liveMatchRepository->getAvailableMatchesForStreaming();
        
        // Always get all matches for selection
        $availableMatches = $this->liveMatchRepository->getAllMatchesForLiveStreaming();
        
        // Show warning if all matches already have live streams
        $showWarning = $uniqueMatches->isEmpty();
        
        return $this->view('live-match.create', compact('availableMatches', 'showWarning'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'match_id' => 'required|exists:match,id',
            'stream_url' => 'nullable|url',
            'obs_server_url' => 'nullable|string|max:255',
            'obs_stream_key' => 'nullable|string|max:255',
            'obs_settings' => 'nullable|array',
            'allow_duplicate' => 'nullable|boolean'
        ]);

        DB::beginTransaction();

        try {
            // Check if live match already exists for this match
            $existingLiveMatch = $this->liveMatchRepository->getLiveMatchByMatchId($request->match_id);
            if ($existingLiveMatch && !$request->boolean('allow_duplicate')) {
                throw new Exception('Live match already exists for this match. Enable "Allow Duplicate" if you want to create another live stream for the same match.');
            }

            $data = $request->all();
            $data['status'] = 1; // Active by default
            
            $this->liveMatchRepository->createLiveMatch($data);

            DB::commit();

            return redirect(route('admin.live-match.index'))
                ->with('success', 'Successfully created live match');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating live match: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function show(int $id)
    {
        $model = $this->liveMatchRepository->getLiveMatchWithDetails($id);
        
        if (!$model) {
            abort(404, 'Live match not found');
        }

        $streamingDuration = $this->liveMatchRepository->getStreamingDuration($id);
        $recentErrors = $this->liveMatchRepository->getRecentObsErrors($id);

        return $this->view('live-match.show', compact('model', 'streamingDuration', 'recentErrors'));
    }

    public function edit(int $id)
    {
        $model = $this->liveMatchRepository->find($id);
        $availableMatches = $this->liveMatchRepository->getAvailableMatchesForStreaming();
        
        // Add current match to available matches if it exists
        if ($model && $model->match) {
            $availableMatches->prepend($model->match);
            $availableMatches = $availableMatches->unique('id');
        }

        return $this->view('live-match.update', compact('model', 'availableMatches'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'match_id' => 'required|exists:match,id',
            'stream_url' => 'nullable|url',
            'obs_server_url' => 'nullable|string|max:255',
            'obs_stream_key' => 'nullable|string|max:255',
            'obs_settings' => 'nullable|array',
            'viewer_count' => 'nullable|integer|min:0'
        ]);

        DB::beginTransaction();

        try {
            $data = $request->all();
            
            // Handle OBS settings
            if ($request->has('obs_settings') && is_array($request->obs_settings)) {
                $data['obs_settings'] = $request->obs_settings;
            }

            $this->liveMatchRepository->update($data, $id);

            DB::commit();

            return redirect(route('admin.live-match.index'))
                ->with('success', 'Successfully updated live match');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating live match: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->liveMatchRepository->delete($id);
            
            return response()->json([
                'success' => true,
                'message' => 'Live match deleted successfully'
            ]);
        } catch (Exception $e) {
            Log::error('Error deleting live match: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error deleting live match'
            ], 500);
        }
    }

    public function toggleStatus(int $id)
    {
        try {
            $liveMatch = $this->liveMatchRepository->find($id);
            $newStatus = $liveMatch->status ? 0 : 1;
            
            $this->liveMatchRepository->update(['status' => $newStatus], $id);
            
            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully'
            ]);
        } catch (Exception $e) {
            Log::error('Error toggling live match status: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error updating status'
            ], 500);
        }
    }

    public function startStreaming(int $id)
    {
        try {
            $result = $this->liveMatchRepository->startStreaming($id);

            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'Live match not found or unable to start streaming'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Streaming started successfully'
            ]);
        } catch (Exception $e) {
            Log::error('Error starting streaming: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error starting streaming'
            ], 500);
        }
    }

    public function markAsLive(int $id)
    {
        try {
            $result = $this->liveMatchRepository->markStreamingAsLive($id);

            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'Live match not found or unable to mark as live'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Stream marked as live successfully'
            ]);
        } catch (Exception $e) {
            Log::error('Error marking stream as live: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error marking stream as live'
            ], 500);
        }
    }

    public function stopStreaming(int $id)
    {
        try {
            $result = $this->liveMatchRepository->stopStreaming($id);

            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'Live match not found or unable to stop streaming'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Streaming stopped successfully'
            ]);
        } catch (Exception $e) {
            Log::error('Error stopping streaming: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error stopping streaming'
            ], 500);
        }
    }

    public function updateViewerCount(Request $request, int $id)
    {
        $request->validate([
            'viewer_count' => 'required|integer|min:0'
        ]);

        try {
            $result = $this->liveMatchRepository->updateViewerCount($id, $request->viewer_count);

            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'Live match not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Viewer count updated successfully'
            ]);
        } catch (Exception $e) {
            Log::error('Error updating viewer count: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error updating viewer count'
            ], 500);
        }
    }

    public function statistics()
    {
        try {
            $stats = $this->liveMatchRepository->getStreamingStatistics();
            
            return response()->json([
                'success' => true,
                'data' => $stats
            ]);
        } catch (Exception $e) {
            Log::error('Error getting streaming statistics: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error getting streaming statistics'
            ], 500);
        }
    }
}
