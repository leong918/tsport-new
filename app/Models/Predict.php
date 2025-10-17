<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Predict extends Model
{
    use SoftDeletes;

    public const STATUS = [
        'ACTIVE' => 1,
        'INACTIVE' => 0,
    ];

    public const CHARACTER = [
        'Expert 1' => 'Expert 1',
        'Expert 2' => 'Expert 2',
        'Expert 3' => 'Expert 3',
    ];
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    protected $table = 'predict';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $with = ['matches'];

    protected $fillable = [
        'match_id',
        'character_name',
        'image',
        'description',
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
    protected $casts = [];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => date('Y-m-d H:i:s', strtotime($value)),
        );
    }

    // Accessor for image URL
    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->image) {
                    return null;
                }

                // If image starts with http, return as-is (external URL)
                if (str_starts_with($this->image, 'http')) {
                    return $this->image;
                }

                // Otherwise, return storage URL
                return asset('storage/' . $this->image);
            }
        );
    }

    public function matches(): BelongsTo
    {
        return $this->belongsTo(Matches::class, 'match_id');
    }

    public function comment(): HasMany
    {
        return $this->hasMany(PredictComment::class)->orderBy('created_at', 'desc');
    }

    public function like(): HasMany
    {
        return $this->hasMany(PredictLike::class);
    }

    /**
     * Get the total number of likes for this prediction
     */
    public function getLikeCountAttribute()
    {
        // Use the cached like_count if available, otherwise count relationships
        return $this->attributes['like_count'] ?? $this->like()->count();
    }

    /**
     * Check if a user has liked this prediction
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
