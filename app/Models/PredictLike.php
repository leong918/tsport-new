<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PredictLike extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    protected $table = 'predict_like';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'predict_id',
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
        'user_id' => 'integer',
        'predict_id' => 'integer',
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => date('Y-m-d H:i:s', strtotime($value)),
        );
    }

    /**
     * Get the user that owns the like
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the prediction that owns the like
     */
    public function predict(): BelongsTo
    {
        return $this->belongsTo(Predict::class);
    }
}
