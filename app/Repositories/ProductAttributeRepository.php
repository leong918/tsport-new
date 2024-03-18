<?php

namespace App\Repositories;

use App\Models\ProductAttribute;
use App\Models\ProductAttributeTerm;
use App\Traits\FileUpload;
use Illuminate\Container\Container;

class ProductAttributeRepository extends BaseRepository
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
        return ProductAttribute::class;
    }

    public function getListing()
    {
        return ProductAttribute::query()->orderBy('created_at', 'desc');
    }

    public function dropdown(string $key = 'id')
    {
        return formalizeDropdown(ProductAttribute::all(), $key, 'name');
    }

    public function createProductAttribute(array $input, int $product_id)
    {
        $productAttribute = ProductAttribute::where('product_id', $product_id);
        $productAttributeId = $productAttribute->get()->pluck('id')->toArray();

        //------ delete attribute term  ------------
        ProductAttributeTerm::where('product_id', $product_id)->whereIn('product_attribute_id', $productAttributeId)->delete();
        $productAttribute->delete();

        foreach ($input['option'] as $data) {

            $model = new ProductAttribute();
            $model->product_id = $product_id;
            $model->name = $data['attribute_name'];
            $model->save();

            $productAttributeTerm = new ProductAttributeTermRepository(new Container());
            $productAttributeTerm->createProductAttributeTerm($data, $model);
        }

    }

    public function deleteByProductId(int $product_id)
    {
        ProductAttribute::where('product_id', $product_id)->delete();
    }
}
