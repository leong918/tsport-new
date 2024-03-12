<?php

namespace App\Repositories;

use App\Models\CategoryDescription;

class CategoryDescriptionRepository extends BaseRepository
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
        return CategoryDescription::class;
    }

    public function getListing()
    {
        return CategoryDescription::query()->orderBy('created_at', 'desc');
    }

    public function createCategoryDescription(array $input, int $category_id)
    {
        CategoryDescription::where('category_id', $category_id)->delete();

        foreach ($input['language'] as $key => $language) {
            $data['category_id'] = $category_id;
            $data['language'] = $key;
            $data['name'] = $language['name'];

            $model = new CategoryDescription();
            $model->fill($data);
            $model->save();
        }
    }
}
