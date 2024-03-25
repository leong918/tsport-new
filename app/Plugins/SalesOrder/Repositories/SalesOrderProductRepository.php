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

            $price = $product->getCurrencyParameters('HKD')->price;

            $orderProduct = new SalesOrderProduct();
            $orderProduct->sales_order_id = $order->id;
            $orderProduct->product_id = $cart->product_id;
            $orderProduct->product_attribute_term_id = $cart->product_attribute_term_id;
            $orderProduct->product_image = $product->getFirstProductImage()->url;
            $orderProduct->product_name = $product->name;
            $orderProduct->product_attribute_term_name = $productAttributeTerm ? $productAttributeTerm->name : null;
            $orderProduct->price = $price;
            $orderProduct->quantity = $cart->quantity;
            $orderProduct->total_price = $cart->quantity * $price;
            $orderProduct->save();
        }
    }

    public function createSalesOrderProduct(array $input, int $id)
    {
        $salesOrderRepository = new SalesOrderRepository(new Container());
        $salesOrderlogRepository = new SalesOrderLogRepository(new Container());
        $productRepository = new ProductRepository(new Container());
        $sales_order = $salesOrderRepository->find($id);
        $admin_id = auth()->guard('admin')->user()->id;
        $total = 0;
        $product_list = "";
        foreach ($input as $sales_order_product) {
            $product = $productRepository->find($sales_order_product['product_id']);
            $salesOrderProduct = new SalesOrderProduct();
            $salesOrderProduct->sales_order_id = $id;
            $salesOrderProduct->product_id = $product->id;
            $salesOrderProduct->product_image = $product->productImage->first()->url;
            $salesOrderProduct->product_name = $product->name;
            $salesOrderProduct->price = $sales_order_product['price'];
            $salesOrderProduct->quantity = $sales_order_product['quantity'];
            $salesOrderProduct->total_price = $sales_order_product['total_price'];
            $salesOrderProduct->save();

            //return total price
            $total += $salesOrderProduct->total_price;

            // product list string
            $product_list .= $salesOrderProduct->product_name . " <br> ";
        }

        $description = "Add Product <br>".$product_list;
        // create log
        $salesOrderlogRepository->createLog($sales_order, $admin_id,'admin', 1, $description);

        return $total;
    }

    public function updateSalesOrderProduct(array $input, int $id, int $product_id)
    {
        $salesOrderRepository = new SalesOrderRepository(new Container());
        $salesOrderlogRepository = new SalesOrderLogRepository(new Container());
        $sales_order_product = SalesOrderProduct::find($product_id);
        $sales_order = $salesOrderRepository->find($id);
        $admin_id = auth()->guard('admin')->user()->id;
        $total = 0;

        foreach ($input as $key => $value) {
            $previousValue = $sales_order_product;
            $current_total_price = $sales_order_product->total_price;
            $sales_order_product->$key = $value;
            $sales_order_product->total_price = round($sales_order_product->price * $sales_order_product->quantity, 2);
            $sales_order_product->save();

            //return total price
            $total += $sales_order_product->total_price - $current_total_price;

            // create log
            if ($key == 'product_id') {
                $description = "Change product from " . $previousValue->product_name . " to " . $sales_order_product->product_name;
            } else {
                $description = "Update product " . $sales_order_product->product_name . $key . " from " . $previousValue->$key . " to " . $value;
            }

            $salesOrderlogRepository->createLog($sales_order, $admin_id,'admin', 1, $description);
        }
        return $total;
    }

    public function deleteProductBySalesOrderId(int $sales_order_id)
    {
        return SalesOrderProduct::where('sales_order_id',$sales_order_id)->delete();
    }
}
