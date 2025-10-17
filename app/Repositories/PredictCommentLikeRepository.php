<?php

namespace App\Repositories;

use App\Models\PredictCommentLike;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\DB;

class PredictCommentLikeRepository extends BaseRepository
{
    use FileUpload;

    /**
     * @var array
     */
    protected $fieldSearchable = [];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     */
    public function model()
    {
        return PredictCommentLike::class;
    }

    public function getListing()
    {
        return PredictCommentLike::query()
            ->orderBy('created_at', 'desc');
    }

    /**
     * Toggle like for a comment
     */
    public function toggleCommentLike($commentId, $userId)
    {
        return DB::transaction(function () use ($commentId, $userId) {
            $existingLike = PredictCommentLike::where('predict_comment_id', $commentId)
                ->where('user_id', $userId)
                ->lockForUpdate() // Add row-level lock
                ->first();

            $comment = \App\Models\PredictComment::find($commentId);

            if ($existingLike) {
                // Unlike
                $existingLike->delete();
                if ($comment) {
                    $comment->decrementLikeCount();
                }
                $action = 'unliked';
            } else {
                try {
                    // Like
                    PredictCommentLike::create([
                        'predict_comment_id' => $commentId,
                        'user_id' => $userId,
                    ]);
                    if ($comment) {
                        $comment->incrementLikeCount();
                    }
                    $action = 'liked';
                } catch (\Illuminate\Database\QueryException $e) {
                    // Handle duplicate entry error
                    if ($e->errorInfo[1] === 1062) { // MySQL duplicate entry error
                        // If duplicate, it means someone else just liked it, so treat as unlike
                        $existingLike = PredictCommentLike::where('predict_comment_id', $commentId)
                            ->where('user_id', $userId)
                            ->first();
                        if ($existingLike) {
                            $existingLike->delete();
                            if ($comment) {
                                $comment->decrementLikeCount();
                            }
                            $action = 'unliked';
                        } else {
                            $action = 'liked'; // Fallback
                        }
                    } else {
                        throw $e;
                    }
                }
            }

            // Get updated like count
            $likeCount = $comment ? $comment->fresh()->like_count : PredictCommentLike::where('predict_comment_id', $commentId)->count();

            return [
                'action' => $action,
                'like_count' => $likeCount,
                'user_liked' => $action === 'liked'
            ];
        });
    }

    /**
     * Check if user has liked a comment
     */
    public function hasUserLikedComment($commentId, $userId)
    {
        return PredictCommentLike::where('predict_comment_id', $commentId)
            ->where('user_id', $userId)
            ->exists();
    }

    /**
     * Get like count for a comment
     */
    public function getCommentLikeCount($commentId)
    {
        return PredictCommentLike::where('predict_comment_id', $commentId)->count();
    }

    /**
     * Get likes for multiple comments
     */
    public function getLikesForComments($commentIds, $userId = null)
    {
        $likes = PredictCommentLike::whereIn('predict_comment_id', $commentIds)
            ->selectRaw('predict_comment_id, COUNT(*) as count')
            ->groupBy('predict_comment_id')
            ->pluck('count', 'predict_comment_id')
            ->toArray();

        $userLikes = [];
        if ($userId) {
            $userLikes = PredictCommentLike::whereIn('predict_comment_id', $commentIds)
                ->where('user_id', $userId)
                ->pluck('predict_comment_id')
                ->toArray();
        }

        return [
            'counts' => $likes,
            'user_likes' => $userLikes
        ];
    }

    /**
     * Get top liked comments for a prediction
     */
    public function getTopLikedCommentsForPredict($predictId, $limit = 5)
    {
        return PredictCommentLike::whereHas('predictComment', function($query) use ($predictId) {
                $query->where('predict_id', $predictId);
            })
            ->selectRaw('predict_comment_id, COUNT(*) as like_count')
            ->groupBy('predict_comment_id')
            ->orderBy('like_count', 'desc')
            ->limit($limit)
            ->pluck('like_count', 'predict_comment_id')
            ->toArray();
    }

    /**
     * Get all comment likes statistics for a prediction
     */
    public function getCommentLikeStatisticsForPredict($predictId, $userId = null)
    {
        // Comment likes
        $commentLikes = PredictCommentLike::whereHas('predictComment', function($query) use ($predictId) {
                $query->where('predict_id', $predictId);
            })
            ->selectRaw('predict_comment_id, COUNT(*) as like_count')
            ->groupBy('predict_comment_id')
            ->pluck('like_count', 'predict_comment_id')
            ->toArray();

        $userLikedComments = [];
        if ($userId) {
            $userLikedComments = PredictCommentLike::where('user_id', $userId)
                ->whereHas('predictComment', function($query) use ($predictId) {
                    $query->where('predict_id', $predictId);
                })
                ->pluck('predict_comment_id')
                ->toArray();
        }

        return [
            'like_counts' => $commentLikes,
            'user_liked_comments' => $userLikedComments
        ];
    }
}
