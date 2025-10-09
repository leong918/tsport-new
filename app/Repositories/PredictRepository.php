<?php

namespace App\Repositories;

use App\Models\Predict;
use App\Traits\FileUpload;
use Carbon\Carbon;

class PredictRepository extends BaseRepository
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
        return Predict::class;
    }

    public function getListing()
    {
        return Predict::query()
            ->with(['like', 'comment'])
            ->orderBy('created_at', 'desc');
    }

    public function createPredict(array $input)
    {
        $model = new Predict();
        $model->fill($input);
        $model->save();
    }

    public function updatePredict(array $input, int $id)
    {
        $model = Predict::findOrFail($id);
        $model->fill($input);
        $model->save();
    }

    public function deletePredict(int $id)
    {
        $model = Predict::findOrFail($id);
        $model->delete();
    }

    public function toggleStatus(int $id)
    {
        $model = Predict::find($id);
        $model->status = !$model->status;
        $model->save();
    }
}
