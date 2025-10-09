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
        'Kar Jun' => 'Kar Jun',
        'Horng Ping' => 'Horng Ping',
        'Felix' => 'Felix',
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
        'description',
        'status'
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

    public function matches(): BelongsTo
    {
        return $this->belongsTo(Matches::class, 'match_id');
    }

    public function comment(): HasMany
    {
        return $this->hasMany(PredictComment::class);
    }

    public function like(): HasMany
    {
        return $this->hasMany(PredictLike::class);
    }
}
