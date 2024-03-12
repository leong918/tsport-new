<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Traits\FileUpload;
use Illuminate\Container\Container;

class BrandRepository extends BaseRepository
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
        return Brand::class;
    }

    public function getListing()
    {
        return Brand::query()->orderBy('created_at', 'desc');
    }

    public function dropdown(string $key = 'id')
    {
        return formalizeDropdown(Brand::all(), $key, 'name');
    }

    public function createBrand(array $input)
    {
        $this->verifyDescription($input);

        //image
        $this->upload_path = 'brand';
        $this->uploadFile($input['image']);

        $model = new Brand();
        $model->fill($input);
        $model->image = $this->uploaded_filename;
        $model->save();

        $brandDescriptionRepository = new BrandDescriptionRepository(new Container());
        $brandDescriptionRepository->createBrandDescription($input, $model->id);
    }

    public function updateBrand(array $input, int $id)
    {
        $this->verifyDescription($input);
        
        $model = Brand::findOrFail($id);
        $model->fill($input);

        if(isset($input['image'])){
            //image
            $this->upload_path = 'brand';
            $this->uploadFile($input['image']);  
            $model->image = $this->uploaded_filename;
        }

        $model->save();

        $brandDescriptionRepository = new BrandDescriptionRepository(new Container());
        $brandDescriptionRepository->createBrandDescription($input, $model->id);
    }

    public function toggleStatus(int $id)
    {
        $model = Brand::find($id);
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
