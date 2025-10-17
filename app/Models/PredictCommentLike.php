<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PredictCommentLike extends Model
{
    use HasFactory;

    protected $table = 'predict_comment_like';

    protected $fillable = [
        'user_id',
        'predict_comment_id',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'predict_comment_id' => 'integer',
    ];

    /**
     * Get the user that liked the comment
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comment that was liked
     */
    public function predictComment(): BelongsTo
    {
        return $this->belongsTo(PredictComment::class);
    }
}
