<?php

namespace App\Repositories;

use App\Models\ProductDescription;

class ProductDescriptionRepository extends BaseRepository
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
        return ProductDescription::class;
    }

    public function getListing()
    {
        return ProductDescription::query()->orderBy('created_at', 'desc');
    }

    public function createProductDescription(array $input, int $product_id)
    {
        ProductDescription::where('product_id', $product_id)->delete();

        foreach ($input['language'] as $key => $language) {
            $data['product_id'] = $product_id;
            $data['language'] = $key;
            $data['name'] = $input['name'];
            $data['information'] = $language['information']; 
            $data['description'] = $language['description']; 
            $data['ingredient'] = $language['ingredient']; 
            $data['usage'] = $language['usage']; 

            $model = new ProductDescription();
            $model->fill($data);
            $model->save();
        }
    }
}
