<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PredictComment extends Model
{
    use SoftDeletes;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    protected $table = 'predict_comment';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $with = ['user'];

    protected $fillable = [
        'user_id',
        'predict_id',
        'comment',
        'status',
        'like_count'
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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function like(): HasMany
    {
        return $this->hasMany(PredictCommentLike::class, 'predict_comment_id');
    }

    /**
     * Get the total number of likes for this comment
     */
    public function getLikeCountAttribute()
    {
        // Use the cached like_count if available, otherwise count relationships
        return $this->attributes['like_count'] ?? $this->like()->count();
    }

    /**
     * Check if a user has liked this comment
     */
    public function isLikedByUser($userId)
    {
        if (!$userId) {
            return false;
        }
        
        return $this->like()->where('user_id', $userId)->exists();
    }

    /**
     * Increment the like count
     */
    public function incrementLikeCount()
    {
        $this->increment('like_count');
    }

    /**
     * Decrement the like count
     */
    public function decrementLikeCount()
    {
        $this->decrement('like_count');
    }

    /**
     * Update like count based on actual likes
     */
    public function updateLikeCount()
    {
        $count = $this->like()->count();
        $this->update(['like_count' => $count]);
        return $count;
    }
}
