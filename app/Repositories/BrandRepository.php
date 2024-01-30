<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Traits\FileUpload;

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

    public function createBrand(array $input)
    {
        //image
        $this->upload_path = 'brand';
        $this->uploadFile($input['image']);

        $model = new Brand();
        $model->fill($input);
        $model->image = $this->uploaded_filename;
        $model->save();
    }

    public function updateBrand(array $input, int $id)
    {
        $model = Brand::findOrFail($id);
        $model->fill($input);

        if(isset($input['image'])){
            //image
            $this->upload_path = 'brand';
            $this->uploadFile($input['image']);  
            $model->image = $this->uploaded_filename;
        }

        $model->save();
    }

    public function toggleStatus(int $id)
    {
        $model = Brand::find($id);
        $model->status = !$model->status;
        $model->save();
    }
}
