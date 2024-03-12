<?php

namespace App\Repositories;

use App\Models\Category;
use App\Traits\FileUpload;
use Illuminate\Container\Container;

class CategoryRepository extends BaseRepository
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
        return Category::class;
    }

    public function getListing()
    {
        return Category::query()->orderBy('created_at', 'desc');
    }

    public function getListingByCategoryType(string $category_id = null, string $order_by = null)
    {
        if ($category_id) {
            //products filtered by category 

            return Category::where('id', $category_id)->orderBy('sort', 'asc')->first();

        } else {
            //filtering for brand

            if ($order_by == 'name') {
                return Category::orderBy('name', 'asc');
            } else {
                return Category::where('id', $category_id)->orderBy('created_at', 'desc');
            }
        }
    }

    public function getSubCategoryByCategoryId(string $category_id)
    {
        return Category::where(['parent_category_id' => $category_id, 'status' => 1])->orderBy('sort', 'asc')->get();
    }

    public function dropdown(string $key = 'id')
    {
        return formalizeDropdown(Category::all(), $key, 'name');
    }

    public function createCategory(array $input)
    {
        $this->verifyDescription($input);

        $this->upload_path = 'category';
        $this->uploadFile($input['image']);

        $model = new Category();
        $model->fill($input);
        $model->image = $this->uploaded_filename;
        $model->save();

        $categoryDescriptionRepository = new CategoryDescriptionRepository(new Container());
        $categoryDescriptionRepository->createCategoryDescription($input, $model->id);
    }

    public function updateCategory(array $input, int $id)
    {
        $model = Category::findOrFail($id);

        $this->verifyChildCategory($model, $input);

        $model->fill($input);

        if (isset($input['image'])) {
            //image
            $this->upload_path = 'brand';
            $this->uploadFile($input['image']);
            $model->image = $this->uploaded_filename;
        }

        $model->save();

        $categoryDescriptionRepository = new CategoryDescriptionRepository(new Container());
        $categoryDescriptionRepository->createCategoryDescription($input, $model->id);
    }

    public function toggleStatus(int $id)
    {
        $model = Category::find($id);
        $model->status = !$model->status;
        $model->save();
    }

    public function deleteChildCategory(int $parent_id)
    {
        $query = Category::whereIn('parent_category_id', [$parent_id])->get();

        if (!$query->isEmpty()) {
            $query->each->delete();
        }
    }

    private function verifyDescription($input)
    {
        foreach ($input['language'] as $key => $language) {
            $lang = ($key == 'cn' ? 'Chinese' : 'English');

            if (isset($language['name']) == false) {
                throw new \Exception(__('Name for ' . $lang . ' cannot be empty!'));
            }
        }
    }

    private function verifyChildCategory($model, $input)
    {
        $sub_category = Category::where(['parent_category_id' => $model->id, 'status' => 1])->first();

        if(isset($input['parent_category_id']) && isset($sub_category)){
            throw new \Exception(__('This category has sub category named ' . $sub_category->name. '!'));
        }
    }

}
