<?php

namespace App\Repositories;

use App\Models\BlogCategory;

class BlogCategoryRepository extends BaseRepository
{
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
        return BlogCategory::class;
    }

    public function dropdown(string $key = 'id')
    {
        return formalizeDropdown(BlogCategory::all(), $key, 'name');
    }
}
