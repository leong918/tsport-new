<?php

namespace App\Repositories;

use App\Models\ProductAttribute;
use App\Plugins\SalesOrder\Repositories\UserCartRepository;
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
        foreach ($input['option'] as $data) {

            $model = new ProductAttribute();
            $model->product_id = $product_id;
            $model->name = $data['attribute_name'];
            $model->status = isset($data['attribute_status']) ? 1 : 0;
            $model->is_variation = isset($data['is_variation']) ? 1 : 0;
            $model->save();

            $productAttributeTerm = new ProductAttributeTermRepository(new Container());
            $productAttributeTerm->createProductAttributeTerm($data, $model);
        }
    }

    public function updateProductAttribute(array $input, int $product_id)
    {
        $this->deleteUnusedAttribute($input, $product_id);

        foreach ($input['option'] as $key => $data) {
            if (str_contains($key, 'old')) {
                $attribute_id = str_replace('old-', '', $key);
                $model = ProductAttribute::find($attribute_id);
            } else {
                $model = new ProductAttribute();
            }

            $model->product_id = $product_id;
            $model->name = $data['attribute_name'];
            $model->status = isset($data['attribute_status']) ? 1 : 0;
            $model->is_variation = isset($data['is_variation']) ? 1 : 0;
            $model->save();

            $productAttributeTerm = new ProductAttributeTermRepository(new Container());
            $productAttributeTerm->updateProductAttributeTerm($data, $model, $product_id);
        }
    }

    public function deleteUnusedAttribute($input, $product_id)
    {
        // Delete unused product attribute
        $resultKeys = array_map(function ($key) {
            return str_replace('old-', '', $key);
        }, array_keys(array_filter($input['option'], function ($key) {
            return strpos($key, 'old') !== false;
        }, ARRAY_FILTER_USE_KEY)));

        $productAttributeDelete = ProductAttribute::whereNotIn('id', $resultKeys);

        $userCartRepository = new UserCartRepository(new Container());
        $userCartRepository->removeDeletedProductCart($productAttributeDelete, $product_id, 'attribute');
        $productAttributeDelete->delete();

        // Delete unused product attribute term
        $variationKeys = array();
        foreach ($input['option'] as $item) {
            if (isset($item['variation']) && is_array($item['variation'])) {
                $variationKeys = array_merge($variationKeys, array_keys($item['variation']));
            }
        }

        $resultKeys = array_map(function ($key) {
            return str_replace('old-', '', $key);
        }, $variationKeys);

        $productAttributeTermRepository = new ProductAttributeTermRepository(new Container());
        $productAttributeTermDelete = $productAttributeTermRepository->makeModel()->whereNotIn('id', $resultKeys);

        $userCartRepository = new UserCartRepository(new Container());
        $userCartRepository->removeDeletedProductCart($productAttributeTermDelete, $product_id, 'term');
        $productAttributeTermDelete->delete();
    }

    public function deleteByProductId(int $product_id)
    {
        ProductAttribute::where('product_id', $product_id)->delete();
    }
}
