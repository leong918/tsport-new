<?php

namespace App\Repositories;

use App\Models\ProductAttributeTerm;
use App\Plugins\SalesOrder\Repositories\UserCartRepository;
use App\Traits\FileUpload;
use Illuminate\Container\Container;

class ProductAttributeTermRepository extends BaseRepository
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
        return ProductAttributeTerm::class;
    }

    public function getListing()
    {
        return ProductAttributeTerm::query()->orderBy('created_at', 'desc');
    }

    public function dropdown(string $key = 'id')
    {
        return formalizeDropdown(ProductAttributeTerm::all(), $key, 'name');
    }

    public function getLowStockProductAttributeTerm()
    {
        return ProductAttributeTerm::leftjoin('product', 'product_attribute_term.product_id', '=', 'product.id')
            ->where('product_attribute_term.quantity', '<=', 2)
            ->selectRaw('product.name as product_name, product_attribute_term.*')
            ->get();
    }

    public function createProductAttributeTerm(array $input, $model)
    {
        $productAttributeRepository = new ProductAttributeRepository(new Container());
        $productAttribute = $productAttributeRepository->find($model->id);

        foreach ($input['variation'] as $term) {
            $term_model = new ProductAttributeTerm();
            $term_model->product_attribute_id = $productAttribute->id;
            $term_model->product_id = $productAttribute->product_id;
            $term_model->name = $term['term_name'];
            $term_model->point_value = $term['term_add_on_point'];
            $term_model->save();

            $productPrice = new ProductPriceRepository(new Container());
            $productPrice->createAttributeTermPrice($term, $term_model);
        }
    }

    public function updateProductAttributeTerm(array $input, $model, $product_id)
    {
        $productAttributeRepository = new ProductAttributeRepository(new Container());
        $productAttribute = $productAttributeRepository->find($model->id);

        foreach ($input['variation'] as $key => $term) {
            if (str_contains($key, 'old')) {
                $attribute_term_id = str_replace('old-', '', $key);
                $term_model = ProductAttributeTerm::find($attribute_term_id);
            } else {
                $term_model = new ProductAttributeTerm();
            }

            $term_model->product_attribute_id = $productAttribute->id;
            $term_model->product_id = $productAttribute->product_id;
            $term_model->name = $term['term_name'];
            $term_model->point_value = $term['term_add_on_point'];
            $term_model->save();

            $productPrice = new ProductPriceRepository(new Container());
            $productPrice->createAttributeTermPrice($term, $term_model);
        }
    }

    public function deleteByProductId(int $product_id)
    {
        ProductAttributeTerm::where('product_id', $product_id)->delete();
    }
}
