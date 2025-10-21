<?php

namespace App\Repositories;

use App\Models\LiveMatch;
use App\Models\Matches;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Container\Container as Application;

class LiveMatchRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'match_id',
        'status',
        'obs_status'
    ];

    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    /**
     * Get searchable fields array
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     *
     * @return string
     */
    public function model()
    {
        return LiveMatch::class;
    }

    /**
     * Get all active live matches
     */
    public function getActiveLiveMatches(): Collection
    {
        return $this->model->with(['match', 'comments'])
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get currently streaming matches
     */
    public function getCurrentlyStreamingMatches(): Collection
    {
        return $this->model->with(['match', 'comments.user'])
            ->where('obs_status', 2) // Live status
            ->where('status', 1)
            ->orderBy('viewer_count', 'desc')
            ->get();
    }

    /**
     * Get live match by match ID
     */
    public function getLiveMatchByMatchId(int $matchId): ?LiveMatch
    {
        return $this->model->with(['match', 'comments'])
            ->where('match_id', $matchId)
            ->where('status', 1)
            ->first();
    }

    /**
     * Get live match with full details
     */
    public function getLiveMatchWithDetails(int $id): ?LiveMatch
    {
        return $this->model->with(['match', 'comments.user'])
            ->where('id', $id)
            ->where('status', 1)
            ->first();
    }

    /**
     * Create new live match with OBS settings
     */
    public function createLiveMatch(array $data): LiveMatch
    {
        // Generate stream key if not provided
        if (empty($data['obs_stream_key'])) {
            $data['obs_stream_key'] = $this->generateStreamKey();
        }

        // Set default OBS server URL if not provided
        if (empty($data['obs_server_url'])) {
            $data['obs_server_url'] = $this->generateDefaultObsServerUrl();
        }

        // Generate RTMP URL
        $data['rtmp_url'] = rtrim($data['obs_server_url'], '/') . '/' . $data['obs_stream_key'];

        return $this->model->create($data);
    }



    /**
     * Start streaming for a live match
     */
    public function startStreaming(int $id): bool
    {
        $liveMatch = $this->model->find($id);
        
        if (!$liveMatch) {
            return false;
        }

        return $liveMatch->startStream();
    }

    /**
     * Mark streaming as live
     */
    public function markStreamingAsLive(int $id): bool
    {
        $liveMatch = $this->model->find($id);
        
        if (!$liveMatch) {
            return false;
        }

        return $liveMatch->markAsLive();
    }

    /**
     * Stop streaming for a live match
     */
    public function stopStreaming(int $id): bool
    {
        $liveMatch = $this->model->find($id);
        
        if (!$liveMatch) {
            return false;
        }

        return $liveMatch->stopStream();
    }

    /**
     * Update viewer count
     */
    public function updateViewerCount(int $id, int $count): bool
    {
        return $this->model->where('id', $id)->update([
            'viewer_count' => $count,
            'updated_at' => now()
        ]);
    }

    /**
     * Get streaming statistics
     */
    public function getStreamingStatistics(): array
    {
        $totalMatches = $this->model->where('status', 1)->count();
        $liveMatches = $this->model->where('obs_status', 2)->where('status', 1)->count();
        $totalViewers = (int) $this->model->where('obs_status', 2)->sum('viewer_count');
        $averageViewers = $liveMatches > 0 ? round($totalViewers / $liveMatches, 2) : 0;

        return [
            'total_matches' => $totalMatches,
            'live_matches' => $liveMatches,
            'total_viewers' => $totalViewers,
            'average_viewers' => $averageViewers
        ];
    }

    /**
     * Get matches available for live streaming
     * 
     * @param bool $allowDuplicates Allow matches that already have live streams
     */
    public function getAvailableMatchesForStreaming(bool $allowDuplicates = false): Collection
    {
        $query = Matches::where('status', 1);
        
        if (!$allowDuplicates) {
            $existingLiveMatchIds = $this->model->where('status', 1)
                ->pluck('match_id')
                ->toArray();
            
            $query->whereNotIn('id', $existingLiveMatchIds);
        }
        
        return $query->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get all matches for live streaming (including those with existing live streams)
     */
    public function getAllMatchesForLiveStreaming(): Collection
    {
        return $this->getAvailableMatchesForStreaming(true);
    }

    /**
     * Generate default OBS server URL based on app URL
     */
    private function generateDefaultObsServerUrl(): string
    {
        // First check if it's set in config
        $configUrl = config('obs.server_url');
        if ($configUrl) {
            return $configUrl;
        }

        // Generate based on APP_URL
        $appUrl = config('app.url', 'http://localhost');
        $parsedUrl = parse_url($appUrl);
        $host = $parsedUrl['host'] ?? 'localhost';

        // Convert web domain to RTMP server URL
        // If your domain is http://tsport-new.localhost, RTMP will be rtmp://tsport-new.localhost:1936/live
        return "rtmp://{$host}:1936/live";
    }

    /**
     * Search live matches
     */
    public function searchLiveMatches(string $query): Collection
    {
        return $this->model->with(['match'])
            ->whereHas('match', function ($q) use ($query) {
                $q->where('match_title', 'like', "%{$query}%")
                  ->orWhere('short_content', 'like', "%{$query}%");
            })
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get upcoming live matches
     */
    public function getUpcomingLiveMatches(): Collection
    {
        return $this->model->with(['match'])
            ->whereHas('match', function ($q) {
                $q->where('start_at', '>', now());
            })
            ->where('status', 1)
            ->where('obs_status', 0) // Not started yet
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * Generate unique stream key
     */
    private function generateStreamKey(): string
    {
        do {
            $streamKey = 'stream_' . Str::random(16);
        } while ($this->model->where('obs_stream_key', $streamKey)->exists());

        return $streamKey;
    }

    /**
     * Log OBS error for a live match
     */
    public function logObsError(int $id, string $error): bool
    {
        $liveMatch = $this->model->find($id);
        
        if (!$liveMatch) {
            return false;
        }

        return $liveMatch->logObsError($error);
    }

    /**
     * Get recent OBS errors for a live match
     */
    public function getRecentObsErrors(int $id): array
    {
        $liveMatch = $this->model->find($id);
        
        if (!$liveMatch || !$liveMatch->obs_error_log) {
            return [];
        }

        return json_decode($liveMatch->obs_error_log, true) ?: [];
    }



    /**
     * Get live match streaming duration
     */
    public function getStreamingDuration(int $id): ?int
    {
        $liveMatch = $this->model->find($id);
        
        if (!$liveMatch || !$liveMatch->stream_started_at) {
            return null;
        }

        $endTime = $liveMatch->stream_ended_at ?: now();
        
        return $liveMatch->stream_started_at->diffInMinutes($endTime);
    }

    /**
     * Get live match with comments
     */
    public function getLiveMatchWithComments(int $id): ?LiveMatch
    {
        return $this->model->with(['match', 'comments.user'])
            ->find($id);
    }

    /**
     * Add comment to live match
     */
    public function addComment(int $liveMatchId, int $userId, string $comment): ?\App\Models\LiveMatchComment
    {
        $liveMatch = $this->model->find($liveMatchId);
        
        if (!$liveMatch) {
            return null;
        }

        return $liveMatch->comments()->create([
            'user_id' => $userId,
            'comment' => $comment,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Get recent comments for live match
     */
    public function getRecentComments(int $id, int $limit = 50): Collection
    {
        $liveMatch = $this->model->find($id);
        
        if (!$liveMatch) {
            return collect();
        }

        return $liveMatch->comments()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Delete comment from live match
     */
    public function deleteComment(int $liveMatchId, int $commentId, int $userId): bool
    {
        $liveMatch = $this->model->find($liveMatchId);
        
        if (!$liveMatch) {
            return false;
        }

        $comment = $liveMatch->comments()
            ->where('id', $commentId)
            ->where('user_id', $userId)
            ->first();

        if (!$comment) {
            return false;
        }

        return $comment->delete();
    }
}
