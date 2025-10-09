<?php

namespace App\Repositories;

use App\Models\Matches;
use App\Traits\FileUpload;
use Carbon\Carbon;

class MatchRepository extends BaseRepository
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
        return Matches::class;
    }

    public function getListing()
    {
        return Matches::query()->orderBy('created_at', 'desc');
    }

    public function createMatch(array $input)
    {

        if (isset($input['banner'])) {
            $this->upload_path = 'match';
            $this->uploadFile($input['banner']);

            $input['banner'] = $this->uploaded_filename;
        } else {
            $input['banner'] = $input['original_banner'];
        }

        $model = new Matches();
        $model->fill($input);
        $model->save();
    }

    public function updateMatch(array $input, int $id)
    {

        if (isset($input['banner'])) {
            $this->upload_path = 'match';
            $this->overwriteFile($input['banner'], $input['original_banner']);

            $input['banner'] = $this->uploaded_filename;
        } else {
            $input['banner'] = $input['original_banner'];
        }

        $model = Matches::findOrFail($id);
        $model->fill($input);
        $model->save();
    }

    public function deleteMatch(int $id)
    {
        $model = Matches::findOrFail($id);

        $this->upload_path = 'match';
        $this->deleteFile($model->banner);

        $model->deleteTranslations();
        $model->delete();
    }

    public function toggleStatus(int $id)
    {
        $model = Matches::find($id);
        $model->status = !$model->status;
        $model->save();
    }

    public function toggleTop(int $id)
    {
        $model = Matches::find($id);
        $model->is_top = !$model->is_top;
        $model->save();
        
        return $model;
    }
}
