<?php

namespace App\Repositories;

use App\Models\Topic;
use App\Traits\FileUpload;
use Carbon\Carbon;

class TopicRepository extends BaseRepository
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
        return Topic::class;
    }

    public function getListing()
    {
        return Topic::query()
            ->with(['like', 'comment'])
            ->orderBy('created_at', 'desc');
    }

    public function createTopic(array $input)
    {
        $model = new Topic();
        $model->fill($input);
        $model->save();
    }

    public function updateTopic(array $input, int $id)
    {
        $model = Topic::findOrFail($id);
        $model->fill($input);
        $model->save();
    }

    public function deleteTopic(int $id)
    {
        $model = Topic::findOrFail($id);
        $model->delete();
    }

    public function toggleStatus(int $id)
    {
        $model = Topic::find($id);
        $model->status = !$model->status;
        $model->save();
    }
}
