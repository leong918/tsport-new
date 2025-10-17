<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LiveMatch extends Model
{
    use SoftDeletes;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    protected $table = 'live_match';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'match_id',
        'status',
        'obs_stream_key',
        'obs_server_url',
        'obs_status',
        'rtmp_url',
        'viewer_count',
        'stream_started_at',
        'stream_ended_at',
        'obs_error_log'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'stream_started_at' => 'datetime',
        'stream_ended_at' => 'datetime',
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => date('Y-m-d H:i:s', strtotime($value)),
        );
    }

    protected function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }

    /**
     * Get the match relationship
     */
    public function match(): BelongsTo
    {
        return $this->belongsTo(Matches::class, 'match_id');
    }

    /**
     * Get the comments for this live match
     */
    public function comments()
    {
        return $this->hasMany(LiveMatchComment::class, 'live_match_id');
    }

    /**
     * Check if stream is currently live
     */
    public function isLive(): bool
    {
        return $this->obs_status === 2;
    }

    /**
     * Check if stream is starting
     */
    public function isStarting(): bool
    {
        return $this->obs_status === 1;
    }

    /**
     * Check if stream is stopped
     */
    public function isStopped(): bool
    {
        return $this->obs_status === 0;
    }

    /**
     * Get OBS status text
     */
    public function getObsStatusTextAttribute(): string
    {
        return match($this->obs_status) {
            0 => 'Stopped',
            1 => 'Starting',
            2 => 'Live',
            3 => 'Stopping',
            default => 'Unknown'
        };
    }

    /**
     * Generate RTMP URL for OBS
     */
    public function generateRtmpUrl(): string
    {
        if (!$this->obs_server_url || !$this->obs_stream_key) {
            return '';
        }

        return rtrim($this->obs_server_url, '/') . '/' . $this->obs_stream_key;
    }

    /**
     * Start the stream
     */
    public function startStream(): bool
    {
        $this->update([
            'obs_status' => 1,
            'stream_started_at' => now(),
            'stream_ended_at' => null
        ]);

        return true;
    }

    /**
     * Mark stream as live
     */
    public function markAsLive(): bool
    {
        $this->update([
            'obs_status' => 2,
            'rtmp_url' => $this->generateRtmpUrl()
        ]);

        return true;
    }

    /**
     * Stop the stream
     */
    public function stopStream(): bool
    {
        $this->update([
            'obs_status' => 0,
            'stream_ended_at' => now()
        ]);

        return true;
    }

    /**
     * Update viewer count
     */
    public function updateViewerCount(int $count): bool
    {
        return $this->update(['viewer_count' => $count]);
    }

    /**
     * Log OBS error
     */
    public function logObsError(string $error): bool
    {
        $existingErrors = $this->obs_error_log ? json_decode($this->obs_error_log, true) : [];
        $existingErrors[] = [
            'timestamp' => now()->toISOString(),
            'error' => $error
        ];

        return $this->update([
            'obs_error_log' => json_encode(array_slice($existingErrors, -10)) // Keep last 10 errors
        ]);
    }
}
