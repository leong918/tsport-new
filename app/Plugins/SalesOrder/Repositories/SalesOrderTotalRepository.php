<?php

namespace App\Plugins\SalesOrder\Repositories;

use App\Plugins\SalesOrder\Models\SalesOrderTotal;
use App\Repositories\BaseRepository;
use Illuminate\Container\Container;
class SalesOrderTotalRepository extends BaseRepository
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
        return SalesOrderTotal::class;
    }

    public function getOrderTotal($sales_order_id, $id = null, $code = null)
    {
        if($id)
        {
            return SalesOrderTotal::where(['id' => $id, 'sales_order_id'=>$sales_order_id])->first();
        }elseif($code)
        {   
            if($code == "discount" || $code == "coupon"){
                return SalesOrderTotal::where(['sales_order_id' => $sales_order_id, 'code' => $code])->get();
            }else{
                return SalesOrderTotal::where(['sales_order_id' => $sales_order_id, 'code' => $code])->first();
            }
        }

    }

    public function createOrderTotal($order, $cartTotal)
    {
        foreach ($cartTotal as $key => $total) {
            if ($key == 'discount' || $key == 'coupon') {
                foreach ($total as $cart_rule) {
                    $salesOrderLog = new SalesOrderTotal();
                    $salesOrderLog->sales_order_id = $order->id;
                    $salesOrderLog->user_id = $order->user_id;
                    $salesOrderLog->cart_rule_id = $cart_rule['id'];
                    $salesOrderLog->title = $cart_rule['name'];
                    $salesOrderLog->code = $key;
                    $salesOrderLog->value = $cart_rule['discount_amount'];
                    $salesOrderLog->text = '$' . $cart_rule['discount_amount'];
                    $salesOrderLog->sort = SalesOrderTotal::TOTAL_SORT[strtoupper($key)];
                    $salesOrderLog->save();
                }
            } elseif ($key == 'subtotal' || $key == 'shipping_fee' || $key == 'point_redemption' || $key == 'total') {
                $salesOrderLog = new SalesOrderTotal();
                $salesOrderLog->sales_order_id = $order->id;
                $salesOrderLog->user_id = $order->user_id;
                $salesOrderLog->title = ucfirst(str_replace('_', ' ', $key));
                $salesOrderLog->code = $key;
                $salesOrderLog->value = $total;
                $salesOrderLog->text = '$' . $total;
                $salesOrderLog->sort = SalesOrderTotal::TOTAL_SORT[strtoupper($key)];
                $salesOrderLog->save();
            }
        }
    }

    public function updateOrderTotal($sales_order_id, $code = null, $order_total_id = null, $value = null)
    {
        $salesOrderRepository = new SalesOrderRepository(new Container());
        $sales_order_total = null;
        $previousValue = null;
        if($order_total_id)
        {
            $sales_order_total = $this->getOrderTotal($sales_order_id, $order_total_id);
            $sales_order_total_price = $this->getOrderTotal($sales_order_id, null, 'total');
            $previousValue = $sales_order_total->value;
                if($value > $sales_order_total->value)
                {
                    $sales_order_total->code != "shipping_fee" ?  $sales_order_total_price->value -= ($value - $sales_order_total->value) : $sales_order_total_price->value += ($value - $sales_order_total->value);
                }else{
                    $sales_order_total->code != "shipping_fee" ? $sales_order_total_price->value += ($sales_order_total->value - $value) : $sales_order_total_price->value -= ($sales_order_total->value - $value);
                }

                $sales_order_total_price->save();
    
                $sales_order_total->value = $value;
                $sales_order_total->text = '$ ' . $sales_order_total->value;
                $sales_order_total->save();
                
        }elseif($code){
            if($code != "discount" && $code != "coupon"){
                $sales_order_total = $this->getOrderTotal($sales_order_id, null, $code);
                $sales_order_total->value = $value;
                $sales_order_total->save();
            }
        }
        
        //update sales order total
        if($sales_order_total){
            $sales_order = $salesOrderRepository->find($sales_order_id);
            $sales_order_total_price = $this->getOrderTotal($sales_order_id, null, 'total');

            if($sales_order_total->code == "discount" || $sales_order_total->code == "coupon")
            {
                //add discount
                $discount_list = $this->getOrderTotal($sales_order_id, null, 'discount');
                $total_discount = 0;
                foreach($discount_list as $discount)
                {
                    $total_discount += $discount->value;
                }

                //add coupon
                $coupon_list = $this->getOrderTotal($sales_order_id, null, 'coupon');
                foreach($coupon_list as $coupon)
                {
                    $total_discount += $coupon->value;
                }

                $sales_order->discount = $total_discount;
            }
            else{
                $column = $sales_order_total->code;
                $sales_order_total->code == 'shipping_fee' ? $sales_order->shipping : $sales_order->$column = $sales_order_total->value;
            }

            $sales_order->total = $sales_order_total_price->value;
            $sales_order->save();
        }

        //return for log purpose
        if($order_total_id)
        {
            return ['title' => $sales_order_total->title, "previousValue" => $previousValue];
        }
    }

    public function updateSubtotalAndTotal($sales_order_id, $amount, $action)
    {
        $salesOrderRepository = new SalesOrderRepository(new Container());
        $sales_order = $salesOrderRepository->find($sales_order_id);
        $sales_order_subtotal_price = $this->getOrderTotal($sales_order_id, null ,'subtotal');
        $sales_order_total_price = $this->getOrderTotal($sales_order_id, null ,'total');

        //update subtotal (sales order and sales order total)
        $action == "add" ? $sales_order_subtotal_price->value += $amount : $sales_order_subtotal_price->value -= $amount;
        $sales_order_subtotal_price->save();

        $sales_order->subtotal = $sales_order_subtotal_price->value;
        $sales_order->save();

        //update total (sales order and sales order total)
        $action == "add" ?  $sales_order_total_price->value += $amount: $sales_order_total_price->value -= $amount;
        $sales_order_total_price->save();

        $sales_order->total = $sales_order_total_price->value;
        $sales_order->save();
    }
}
