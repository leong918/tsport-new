<?php

namespace App\Repositories;

use App\Models\ProductBalanceLog;
use Illuminate\Container\Container;

class ProductBalanceLogRepository extends BaseRepository
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
        return ProductBalanceLog::class;
    }

    public function getListing()
    {
        return ProductBalanceLog::query()->orderBy('created_at', 'desc');
    }

    // public function createProductBalanceLog(array $input, int $product_id)
    // {
    //     ProductBalanceLog::where('product_id', $product_id)->delete();

    //     $productRepository = new ProductRepository(new Container());
    //     $product = $productRepository->find($product_id);

    //     foreach($input['product_price'] as $data){
    //         $currencyRepository = new CurrencyRepository(new Container());
    //         $currency = $currencyRepository->find($data['currency_id']);

    //         $model = new ProductBalanceLog();
    //         $model->product_id = $product->id;
    //         $model->currency_id = $currency->id;
    //         $model->code = $currency->code;
    //         $model->price = $data['price'];
    //         $model->save();
    //     }
    // }
}
