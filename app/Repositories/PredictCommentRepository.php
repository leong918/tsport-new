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

    public function toggleStatus(int $id)
    {
        $model = PredictComment::find($id);
        $model->status = !$model->status;
        $model->save();
    }
}
