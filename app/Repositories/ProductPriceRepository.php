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
        ProductPrice::where('product_id', $product_id)->delete();

        $productRepository = new ProductRepository(new Container());
        $product = $productRepository->find($product_id);

        foreach($input['product_price'] as $data){
            $currencyRepository = new CurrencyRepository(new Container());
            $currency = $currencyRepository->find($data['currency_id']);

            $model = new ProductPrice();
            $model->product_id = $product->id;
            $model->currency_id = $currency->id;
            $model->code = $currency->code;
            $model->price = $data['price'];
            $model->save();
        }
    }
}
