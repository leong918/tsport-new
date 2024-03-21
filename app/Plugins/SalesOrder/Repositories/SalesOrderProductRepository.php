<?php

namespace App\Plugins\SalesOrder\Repositories;

use App\Plugins\SalesOrder\Models\SalesOrderProduct;
use App\Repositories\BaseRepository;
use Illuminate\Container\Container;
use App\Repositories\ProductRepository;
use App\Repositories\ProductAttributeTermRepository;

class SalesOrderProductRepository extends BaseRepository
{
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
        return SalesOrderProduct::class;
    }

    public function createOrderProduct($order, $data)
    {
        $productRepository = new ProductRepository(new Container());
        $productAttributeTermRepository = new ProductAttributeTermRepository(new Container());

        foreach ($data as $cart) {
            $product = $productRepository->find($cart->product_id);
            $productAttributeTerm = $productAttributeTermRepository->find($cart->product_attribute_term_id);

            $price = $product->getCurrencyParameters()->price;

            $orderProduct = new SalesOrderProduct();
            $orderProduct->sales_order_id = $order->id;
            $orderProduct->product_id = $cart->product_id;
            $orderProduct->product_attribute_term_id = $cart->product_attribute_term_id;
            $orderProduct->product_name = $product->name;
            $orderProduct->product_attribute_term_name = $productAttributeTerm->name;
            $orderProduct->price = $price;
            $orderProduct->quantity = $cart->quantity;
            $orderProduct->total_price = $cart->quantity * $price;
            $orderProduct->save();
        }
    }
}
