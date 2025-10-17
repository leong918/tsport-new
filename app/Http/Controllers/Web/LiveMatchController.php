<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Repositories\LiveMatchRepository;
use App\Repositories\MatchRepository;
use Exception;

class LiveMatchController extends BaseController
{
    protected $liveMatchRepository;
    protected $matchRepository;

    public function __construct(
        LiveMatchRepository $liveMatchRepository,
        MatchRepository $matchRepository
    ) {
        $this->liveMatchRepository = $liveMatchRepository;
        $this->matchRepository = $matchRepository;
    }

    /**
     * Display live matches page
     */
    public function index()
    {
        try {
            $liveMatches = $this->liveMatchRepository->getActiveLiveMatches();
            $streamingMatches = $this->liveMatchRepository->getCurrentlyStreamingMatches();
            $upcomingMatches = $this->liveMatchRepository->getUpcomingLiveMatches();
            $stats = $this->liveMatchRepository->getStreamingStatistics();

            return $this->view('live-matches.index', [
                'liveMatches' => $liveMatches,
                'streamingMatches' => $streamingMatches,
                'upcomingMatches' => $upcomingMatches,
                'stats' => $stats
            ]);
        } catch (Exception $e) {
            Log::error('Error loading live matches: ' . $e->getMessage());
            return $this->view('live-matches.index', [
                'liveMatches' => collect(),
                'streamingMatches' => collect(),
                'upcomingMatches' => collect(),
                'stats' => [
                    'total_matches' => 0,
                    'live_matches' => 0,
                    'total_viewers' => 0,
                    'average_viewers' => 0
                ]
            ]);
        }
    }

    /**
     * Show specific live match
     */
    public function show($id)
    {
        try {
            $liveMatch = $this->liveMatchRepository->getLiveMatchWithDetails($id);

            if (!$liveMatch) {
                abort(404, 'Live match not found');
            }

            // Format match data for the view
            $matchData = [
                'id' => $liveMatch->id,
                'match_id' => $liveMatch->match_id,
                'rtmp_url' => $liveMatch->rtmp_url,
                'obs_stream_key' => $liveMatch->obs_stream_key,
                'obs_status' => $liveMatch->obs_status,
                'obs_status_text' => $liveMatch->obs_status_text,
                'viewer_count' => $liveMatch->viewer_count,
                'stream_started_at' => $liveMatch->stream_started_at,
                'is_live' => $liveMatch->isLive(),
                'match' => $liveMatch->match ? [
                    'id' => $liveMatch->match->id,
                    'title' => $liveMatch->match->match_title,
                    'short_content' => $liveMatch->match->short_content,
                    'start_at' => $liveMatch->match->start_at,
                    'banner_url' => $liveMatch->match->banner_url,
                ] : null,
                'comments' => $liveMatch->comments->map(function ($comment) {
                    return [
                        'id' => $comment->id,
                        'comment' => $comment->comment,
                        'user_name' => $comment->user->name ?? 'Anonymous',
                        'created_at' => $comment->created_at,
                        'created_at_human' => $comment->created_at->diffForHumans(),
                    ];
                })
            ];

            return $this->view('live-matches.show', [
                'liveMatch' => $matchData
            ]);
        } catch (Exception $e) {
            Log::error('Error loading live match: ' . $e->getMessage());
            abort(500, 'Error loading live match');
        }
    }

    /**
     * Create new live match
     */
    public function create()
    {
        try {
            $availableMatches = $this->liveMatchRepository->getAvailableMatchesForStreaming();
            
            return $this->view('live-matches.create', [
                'availableMatches' => $availableMatches
            ]);
        } catch (Exception $e) {
            Log::error('Error loading create live match page: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading page');
        }
    }

    /**
     * Store new live match
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'match_id' => 'required|exists:match,id',
            'obs_server_url' => 'nullable|string|max:255',
            'obs_stream_key' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Check if live match already exists for this match
            $existingLiveMatch = $this->liveMatchRepository->getLiveMatchByMatchId($request->match_id);
            if ($existingLiveMatch) {
                return response()->json([
                    'success' => false,
                    'message' => 'Live match already exists for this match'
                ], 409);
            }

            $liveMatch = $this->liveMatchRepository->createLiveMatch($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Live match created successfully',
                'data' => [
                    'id' => $liveMatch->id,
                    'rtmp_url' => $liveMatch->rtmp_url,
                    'obs_stream_key' => $liveMatch->obs_stream_key,
                    'obs_server_url' => $liveMatch->obs_server_url
                ]
            ]);
        } catch (Exception $e) {
            Log::error('Error creating live match: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error creating live match'
            ], 500);
        }
    }

    /**
     * Start streaming
     */
    public function startStreaming(Request $request, $id)
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

    /**
     * Mark streaming as live
     */
    public function markAsLive(Request $request, $id)
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

    /**
     * Stop streaming
     */
    public function stopStreaming(Request $request, $id)
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

    /**
     * Update viewer count
     */
    public function updateViewerCount(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'viewer_count' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid viewer count'
            ], 422);
        }

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



    /**
     * Log OBS error
     */
    public function logObsError(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'error' => 'required|string|max:1000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid error message'
            ], 422);
        }

        try {
            $result = $this->liveMatchRepository->logObsError($id, $request->error);

            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'Live match not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Error logged successfully'
            ]);
        } catch (Exception $e) {
            Log::error('Error logging OBS error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error logging OBS error'
            ], 500);
        }
    }

    /**
     * Get streaming statistics
     */
    public function getStatistics()
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

    /**
     * Search live matches
     */
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'query' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid search query'
            ], 422);
        }

        try {
            $matches = $this->liveMatchRepository->searchLiveMatches($request->input('query'));

            return response()->json([
                'success' => true,
                'data' => $matches
            ]);
        } catch (Exception $e) {
            Log::error('Error searching live matches: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error searching live matches'
            ], 500);
        }
    }

    /**
     * Get OBS connection info for a live match
     */
    public function getObsConnectionInfo($id)
    {
        try {
            $liveMatch = $this->liveMatchRepository->find($id);

            if (!$liveMatch) {
                return response()->json([
                    'success' => false,
                    'message' => 'Live match not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'obs_server_url' => $liveMatch->obs_server_url,
                    'obs_stream_key' => $liveMatch->obs_stream_key,
                    'rtmp_url' => $liveMatch->rtmp_url,
                    'obs_status' => $liveMatch->obs_status,
                    'obs_status_text' => $liveMatch->obs_status_text
                ]
            ]);
        } catch (Exception $e) {
            Log::error('Error getting OBS connection info: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error getting OBS connection info'
            ], 500);
        }
    }
}
