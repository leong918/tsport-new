<?php

namespace App\Repositories;

use App\Traits\FileUpload;
use App\Models\ProductImage;

class ProductImageRepository extends BaseRepository
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
        return ProductImage::class;
    }

    public function getListing()
    {
        return ProductImage::query()->orderBy('created_at', 'desc');
    }

    public function createProductImage(array $input, int $product_id)
    {
        ProductImage::where('product_id', $product_id)->delete();

        $this->upload_path = 'product';

        foreach($input['image'] as $image){

            $this->uploadFile($image);

            $model = new ProductImage();
            $model->product_id = $product_id;
            $model->url = $this->uploaded_filename;
            
            $model->save();
        }


    }
}
