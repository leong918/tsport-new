<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Traits\FileUpload;

class TagRepository extends BaseRepository
{
    use FileUpload;

    /**
     * @var array
     */
    protected $fieldSearchable = [
    ];

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
        return Tag::class;
    }

    public function getListing()
    {
        return Tag::query()->orderBy('created_at', 'desc');
    }

    public function dropdown(string $key = 'id')
    {
        return formalizeDropdown(Tag::all(), $key, 'name');
    }

    public function createTag(array $input)
    {
        $model = new Tag();
        $model->fill($input);
        $model->save();
    }

    public function updateTag(array $input, int $id)
    {
        $model = Tag::findOrFail($id);
        $model->fill($input);
        $model->save();
    }

    public function toggleStatus(int $id)
    {
        $model = Tag::find($id);
        $model->status = !$model->status;
        $model->save();
    }
}
