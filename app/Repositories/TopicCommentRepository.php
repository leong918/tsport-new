<?php

namespace App\Repositories;

use App\Models\TopicComment;
use App\Traits\FileUpload;
use Carbon\Carbon;

class TopicCommentRepository extends BaseRepository
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
        return TopicComment::class;
    }

    public function getListing()
    {
        return TopicComment::query()
            ->with(['like'])
            ->orderBy('created_at', 'desc');
    }

    public function createTopic(array $input)
    {
        $model = new TopicComment();
        $model->fill($input);
        $model->save();
    }

    public function updateTopic(array $input, int $id)
    {
        $model = TopicComment::findOrFail($id);
        $model->fill($input);
        $model->save();

        return $model;
    }

    public function deleteTopic(int $id)
    {
        $model = TopicComment::findOrFail($id);
        $model->delete();
    }

    public function toggleStatus(int $id)
    {
        $model = TopicComment::find($id);
        $model->status = !$model->status;
        $model->save();
    }
}
