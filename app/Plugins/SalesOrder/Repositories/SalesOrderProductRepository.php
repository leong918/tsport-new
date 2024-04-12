<?php

namespace App\Plugins\SalesOrder\Repositories;

use App\Plugins\SalesOrder\Models\SalesOrderProduct;
use App\Repositories\BaseRepository;
use Illuminate\Container\Container;
use App\Repositories\ProductRepository;
use App\Repositories\ProductAttributeRepository;
use App\Repositories\ProductAttributeTermRepository;
use App\Repositories\ProductBalanceLogRepository;

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

    public function getSalesOrderProductBySalesOrderId(int $id)
    {
        return SalesOrderProduct::where('sales_order_id', $id);
    }

    public function createOrderProduct($order, $data)
    {
        $productRepository = new ProductRepository(new Container());
        $productAttributeRepository = new ProductAttributeRepository(new Container());
        $productAttributeTermRepository = new ProductAttributeTermRepository(new Container());
        $productBalanceLogRepository = new ProductBalanceLogRepository(new Container());

        foreach ($data as $cart) {
            $product = $productRepository->find($cart->product_id);
            $description = null;

            if ($cart->product_attribute_term) {
                foreach (json_decode($cart->product_attribute_term) as $key => $product_attribute_term) {
                    $productAttribute = $productAttributeRepository->find($key);
                    $productAttributeTerm = $productAttributeTermRepository->find($product_attribute_term);
                    $description .= '- ' . $productAttribute->name . ': ' . $productAttributeTerm->name . '</br>';

                    $productAttributeTerm->quantity -= $cart->quantity;
                    $productAttributeTerm->save();

                    $log_data['stock_option'] = 0;
                    $log_data['stock_amount'] = $cart->quantity;
                    $remark = 'Deduct product for Order: ' . $order->sales_order_id;
                    $productBalanceLogRepository->createProductBalanceLog($productAttributeTerm, $log_data, null, $remark);
                }
            } else {
                $product->quantity -= $cart->quantity;
                $product->save();

                $log_data['type'] = 'DEDUCT';
                $log_data['quantity'] = $cart->quantity;
                $remark = 'Deduct product for Order: ' . $order->sales_order_id;
                $productBalanceLogRepository->createProductBalanceLog($product, null, $log_data, $remark);
            }

            $orderProduct = new SalesOrderProduct();
            $orderProduct->sales_order_id = $order->id;
            $orderProduct->product_id = $cart->product_id;
            $orderProduct->product_attribute_term = $cart->product_attribute_term;
            $orderProduct->product_image = $product->getFirstProductImage()->url;
            $orderProduct->product_name = $product->name;
            $orderProduct->product_attribute_term_name = $description;
            $orderProduct->price = $cart->price;
            $orderProduct->quantity = $cart->quantity;
            $orderProduct->total_price = $cart->total_price;
            $orderProduct->save();
        }
    }

    public function createSalesOrderProduct(array $input, int $id)
    {
        $salesOrderRepository = new SalesOrderRepository(new Container());
        $salesOrderlogRepository = new SalesOrderLogRepository(new Container());
        $salesOrderTotalRepository = new SalesOrderTotalRepository(new Container());
        $productRepository = new ProductRepository(new Container());
        $productAttributeRepository = new ProductAttributeRepository(new Container());
        $productAttributeTermRepository = new ProductAttributeTermRepository(new Container());
        $sales_order = $salesOrderRepository->find($id);
        $sales_order_subtotal_price = $salesOrderTotalRepository->getOrderTotal($id, null ,'subtotal');
        $sales_order_total_price = $salesOrderTotalRepository->getOrderTotal($id, null ,'total');
        $admin_id = auth()->guard('admin')->user()->id;
        $total = 0;
        $product_list = "";
        foreach ($input as $sales_order_product) {
            $product = $productRepository->find($sales_order_product['product_id']);
            $description = null;
            if ($sales_order_product['attribute']) {
                foreach (json_decode($sales_order_product['attribute']) as $key => $product_attribute_term) {
                    $productAttribute = $productAttributeRepository->find($key);
                    $productAttributeTerm = $productAttributeTermRepository->find($product_attribute_term);
                    $description .= '- ' . $productAttribute->name . ': ' . $productAttributeTerm->name . '</br>';
                }
            }

            $salesOrderProduct = new SalesOrderProduct();
            $salesOrderProduct->sales_order_id = $id;
            $salesOrderProduct->product_id = $product->id;
            $salesOrderProduct->product_attribute_term = $sales_order_product['attribute'];
            $salesOrderProduct->product_image = $product->productImage->first()->url;
            $salesOrderProduct->product_name = $product->name;
            $salesOrderProduct->product_attribute_term_name = $description;
            $salesOrderProduct->price = $sales_order_product['price'];
            $salesOrderProduct->quantity = $sales_order_product['quantity'];
            $salesOrderProduct->total_price = $sales_order_product['total_price'];
            $salesOrderProduct->save();

            //return total price
            $total += $salesOrderProduct->total_price;

            // product list string
            $product_list .= $salesOrderProduct->product_name . " <br> ";
        }

        $description = "Add Product <br>" . $product_list;
        // create log
        $salesOrderlogRepository->createLog($sales_order, $admin_id, 'admin', 1, $description);

        $salesOrderTotalRepository->updateSubtotalAndTotal($id, $total, "add");
    }

    public function updateSalesOrderProduct(array $input, int $id, int $product_id, int $admin_id)
    {
        $salesOrderRepository = new SalesOrderRepository(new Container());
        $salesOrderTotalRepository = new SalesOrderTotalRepository(new Container());
        $salesOrderlogRepository = new SalesOrderLogRepository(new Container());
        $sales_order_product = SalesOrderProduct::find($product_id);
        $sales_order = $salesOrderRepository->find($id);
        $total = 0;

        foreach ($input as $key => $value) {
            $previousValue = $sales_order_product->price;
            $current_total_price = $sales_order_product->total_price;
            $sales_order_product->$key = $value;
            $sales_order_product->total_price = round($sales_order_product->price * $sales_order_product->quantity, 2);
            $sales_order_product->save();

            //calulate total price
            $total += $sales_order_product->total_price - $current_total_price;

            // create log
            if ($key == 'product_id') {
                $description = "Change product from <b>" . $previousValue->product_name . "</b> to " . $sales_order_product->product_name;
            } else {
                $description = "Update product " . $sales_order_product->product_name . " " . $key . " from " . number_format($previousValue, 2) . " to " . number_format($value, 2);
            }

            $salesOrderlogRepository->createLog($sales_order, $admin_id, 'admin', 1, $description);
        }
        $salesOrderTotalRepository->updateSubtotalAndTotal($id, $total, "add");
    }

    public function deleteProductBySalesOrderId(int $sales_order_id)
    {
        return SalesOrderProduct::where('sales_order_id', $sales_order_id)->delete();
    }
}
