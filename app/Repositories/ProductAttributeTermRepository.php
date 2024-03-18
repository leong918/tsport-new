<?php

namespace App\Repositories;

use App\Models\ProductAttributeTerm;
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


    public function createProductAttributeTerm(array $input, $model)
    {
        $productAttributeRepository = new ProductAttributeRepository(new Container());
        $productAttribute = $productAttributeRepository->find($model->id);

        foreach ($input['variation'] as $term) {

            $term_model = new ProductAttributeTerm();
            $term_model->product_attribute_id = $productAttribute->id;
            $term_model->product_id = $productAttribute->product_id;
            $term_model->name = $term['term_name'];
            $term_model->sku = $term['term_sku'];

            //----------- check create/ update stock  ------------
            if (!isset($term['stock_amount'])) {
                $term_model->quantity = $term['term_qty'];
            } else {
                $this->calStockAmount($term_model, $term);
            }

            $term_model->save();

            $productBalanceLog = new ProductBalanceLogRepository(new Container());
            $productBalanceLog->createProductBalanceLog($term_model, $term);
        }
    }

    private function calStockAmount($term_model, $term)
    {
        if ($term['stock_option'] != 0) {
            $total = $term['term_qty'] - $term['stock_amount'];
            $term_model->quantity = $total;
        } else {
            $total = $term['stock_amount'] + $term['term_qty'];
            $term_model->quantity = $total;
        }

        return $term_model->quantity;
    }

    public function deleteByProductId(int $product_id)
    {
        ProductAttributeTerm::where('product_id', $product_id)->delete();
    }
}
