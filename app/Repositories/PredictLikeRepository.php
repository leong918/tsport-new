<?php

namespace App\Repositories;

use App\Models\PredictLike;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\DB;

class PredictLikeRepository extends BaseRepository
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
        return PredictLike::class;
    }

    public function getListing()
    {
        return PredictLike::query()
            ->orderBy('created_at', 'desc');
    }

    /**
     * Toggle like for a prediction
     */
    public function togglePredictLike($predictId, $userId)
    {
        return DB::transaction(function () use ($predictId, $userId) {
            $existingLike = PredictLike::where('predict_id', $predictId)
                ->where('user_id', $userId)
                ->lockForUpdate() // Add row-level lock
                ->first();

            $predict = \App\Models\Predict::find($predictId);

            if ($existingLike) {
                // Unlike
                $existingLike->delete();
                if ($predict) {
                    $predict->decrementLikeCount();
                }
                $action = 'unliked';
            } else {
                try {
                    // Like
                    PredictLike::create([
                        'predict_id' => $predictId,
                        'user_id' => $userId,
                    ]);
                    if ($predict) {
                        $predict->incrementLikeCount();
                    }
                    $action = 'liked';
                } catch (\Illuminate\Database\QueryException $e) {
                    // Handle duplicate entry error
                    if ($e->errorInfo[1] === 1062) { // MySQL duplicate entry error
                        // If duplicate, it means someone else just liked it, so treat as unlike
                        $existingLike = PredictLike::where('predict_id', $predictId)
                            ->where('user_id', $userId)
                            ->first();
                        if ($existingLike) {
                            $existingLike->delete();
                            if ($predict) {
                                $predict->decrementLikeCount();
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
            $likeCount = $predict ? $predict->fresh()->like_count : PredictLike::where('predict_id', $predictId)->count();

            return [
                'action' => $action,
                'like_count' => $likeCount,
                'user_liked' => $action === 'liked'
            ];
        });
    }

    /**
     * Check if user has liked a prediction
     */
    public function hasUserLikedPredict($predictId, $userId)
    {
        return PredictLike::where('predict_id', $predictId)
            ->where('user_id', $userId)
            ->exists();
    }

    /**
     * Get like count for a prediction
     */
    public function getPredictLikeCount($predictId)
    {
        return PredictLike::where('predict_id', $predictId)->count();
    }

    /**
     * Get likes for multiple predictions
     */
    public function getLikesForPredicts($predictIds, $userId = null)
    {
        $likes = PredictLike::whereIn('predict_id', $predictIds)
            ->selectRaw('predict_id, COUNT(*) as count')
            ->groupBy('predict_id')
            ->pluck('count', 'predict_id')
            ->toArray();

        $userLikes = [];
        if ($userId) {
            $userLikes = PredictLike::whereIn('predict_id', $predictIds)
                ->where('user_id', $userId)
                ->pluck('predict_id')
                ->toArray();
        }

        return [
            'counts' => $likes,
            'user_likes' => $userLikes
        ];
    }

    /**
     * Get top liked predictions
     */
    public function getTopLikedPredicts($limit = 10)
    {
        return PredictLike::selectRaw('predict_id, COUNT(*) as like_count')
            ->groupBy('predict_id')
            ->orderBy('like_count', 'desc')
            ->limit($limit)
            ->pluck('like_count', 'predict_id')
            ->toArray();
    }

    /**
     * Get prediction like statistics
     */
    public function getPredictLikeStatistics($predictId, $userId = null)
    {
        $predictLikeCount = $this->getPredictLikeCount($predictId);
        $userLikedPredict = $userId ? $this->hasUserLikedPredict($predictId, $userId) : false;

        return [
            'predict' => [
                'like_count' => $predictLikeCount,
                'user_liked' => $userLikedPredict
            ]
        ];
    }
}
