<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matches extends Model
{
    use SoftDeletes;

    public const STATUS = [
        'ACTIVE' => 1,
        'INACTIVE' => 0,
    ];
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    protected $table = 'match';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'match_title',
        'short_content',
        'banner',
        'start_at',
        'status',
        'is_top'
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
        'start_at' => 'datetime',
    ];

    // Accessor for banner image URL
    protected function bannerUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->banner) {
                    return null;
                }

                // If banner starts with http, return as-is (external URL)
                if (str_starts_with($this->banner, 'http')) {
                    return $this->banner;
                }

                // Otherwise, return storage URL
                return asset('storage/' . $this->banner);
            }
        );
    }

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
     * Scope to get top matches for swiper
     */
    public function scopeTop($query)
    {
        return $query->where('is_top', true);
    }

    /**
     * Scope to get active matches
     */
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS['ACTIVE']);
    }
}
