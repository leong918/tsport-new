<?php

namespace App\Repositories;

use App\Models\PredictComment;
use App\Traits\FileUpload;

class PredictCommentRepository extends BaseRepository
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
        return PredictComment::class;
    }

    public function getListing()
    {
        return PredictComment::query()
            ->with(['like'])
            ->orderBy('created_at', 'desc');
    }

    public function createTopic(array $input)
    {
        $model = new PredictComment();
        $model->fill($input);
        $model->save();
    }

    public function updateTopic(array $input, int $id)
    {
        $model = PredictComment::findOrFail($id);
        $model->fill($input);
        $model->save();

        return $model;
    }

    public function deleteTopic(int $id)
    {
        $model = PredictComment::findOrFail($id);
        $model->delete();
    }

    /**
     * Create a new prediction comment
     */
    public function createComment(array $data)
    {
        $comment = new PredictComment();
        $comment->fill($data);
        $comment->save();

        // Load the user relationship and return formatted data
        $comment->load('user');
        
        return [
            'id' => $comment->id,
            'user_name' => $comment->user->name ?? 'Anonymous',
            'comment' => $comment->comment,
            'likes_count' => 0,
            'user_liked' => false,
            'created_at' => $comment->created_at,
            'created_at_human' => $comment->created_at->diffForHumans()
        ];
    }

    /**
     * Get comments for a prediction with user data
     */
    public function getCommentsForPredict($predictId)
    {
        return PredictComment::with(['user', 'like'])
            ->where('predict_id', $predictId)
            ->where('status', 1) // Active status
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get comment by ID with relationships
     */
    public function getCommentById($commentId)
    {
        return PredictComment::with(['user', 'like'])
            ->where('id', $commentId)
            ->first();
    }

    public function toggleStatus(int $id)
    {
        $model = PredictComment::find($id);
        $model->status = !$model->status;
        $model->save();
    }
}
