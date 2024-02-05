<?php

namespace App\Repositories;

use App\Models\Blog;

class BlogRepository extends BaseRepository
{
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
        return Blog::class;
    }

    public function getListing()
    {
        return Blog::query()->orderBy('created_at', 'desc');
    }

    public function dropdown(string $key = 'id')
    {
        return formalizeDropdown(Blog::all(), $key, 'name');
    }

    public function createBlog(array $input)
    {
        $model = new Blog();
        $model->fill($input);
        $model->save();
    }

    public function updateBlog(array $input, int $id)
    {
        $model = Blog::findOrFail($id);
        $model->fill($input);
        $model->save();
    }

    public function toggleStatus(int $id)
    {
        $model = Blog::find($id);
        $model->status = !$model->status;
        $model->save();
    }
}
