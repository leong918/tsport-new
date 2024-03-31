<?php

namespace App\Repositories;

use App\Models\ProductPrice;
use Illuminate\Container\Container;

class ProductPriceRepository extends BaseRepository
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
        return ProductPrice::class;
    }

    public function getListing()
    {
        return ProductPrice::query()->orderBy('created_at', 'desc');
    }

    public function createProductPrice(array $input, int $product_id)
    {
        ProductPrice::where(['product_id' => $product_id, 'product_attribute_term_id' => null])->delete();

        $productRepository = new ProductRepository(new Container());
        $product = $productRepository->find($product_id);

        $currencyRepository = new CurrencyRepository(new Container());
        $currency = $currencyRepository->getCurrencyByCode('HKD');

        $model = new ProductPrice();
        $model->product_id = $product->id;
        $model->currency_id = $currency->id;
        $model->code = $currency->code;
        $model->price = $input['product_price'];
        $model->save();
    }

    public function createAttributeTermPrice(array $input, $term_model)
    {
        $productRepository = new ProductRepository(new Container());
        $product = $productRepository->find($term_model->product_id);

        $currencyRepository = new CurrencyRepository(new Container());
        $currency = $currencyRepository->getCurrencyByCode('HKD');

        $model = new ProductPrice();
        $model->product_id = $product->id;
        $model->currency_id = $currency->id;
        $model->code = $currency->code;
        $model->product_attribute_term_id = $term_model->id;
        $model->price = $input['term_add_on_price'];
        $model->save();
    }
}
