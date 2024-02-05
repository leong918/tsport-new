<?php

namespace App\Repositories;

use App\Models\ProductRelated;
use Illuminate\Container\Container;

class ProductRelatedRepository extends BaseRepository
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
        return ProductRelated::class;
    }

    public function getListing()
    {
        return ProductRelated::query()->orderBy('created_at', 'desc');
    }

    public function createProductRelated(array $input, int $product_id)
    {
        ProductRelated::where('product_id', $product_id)->delete();

        foreach($input['product_related'] as $data){

            $productRepository = new ProductRepository(new Container());
            $product = $productRepository->find($data);

            $model = new ProductRelated();
            $model->product_id = $product->id;
            $model->related_product_id = $product_id;
            $model->save();
        }
    }
}
