<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Container\Container;

class CategoryRepository extends BaseRepository
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
        return Category::class;
    }

    public function getListing()
    {
        return Category::query()->orderBy('created_at', 'desc');
    }

    public function createCategory(array $input)
    {
        $this->verifyDescription($input);

        $model = new Category();
        $model->fill($input);
        $model->save();

        $brandDescriptionRepository = new CategoryDescriptionRepository(new Container());
        $brandDescriptionRepository->createCategoryDescription($input, $model->id);
    }

    public function updateCategory(array $input, int $id)
    {
        $model = Category::findOrFail($id);
        $model->fill($input);
        $model->save();

        $brandDescriptionRepository = new CategoryDescriptionRepository(new Container());
        $brandDescriptionRepository->createCategoryDescription($input, $model->id);
    }

    public function toggleStatus(int $id)
    {
        $model = Category::find($id);
        $model->status = !$model->status;
        $model->save();
    }

    private function verifyDescription($input)
    {
        foreach ($input['language'] as $key => $language) {
            $lang = ($key == 'cn' ? 'Chinese' : 'English');

            if (isset($language['name']) == false) {
                throw new \Exception(__('Name for '.$lang.' cannot be empty!'));
            }
            if (isset($language['description']) == false) {
                throw new \Exception(__('Description for '.$lang.' cannot be empty!'));
            }
        }
    }
}
