<?php

namespace App\Plugins\SalesOrder\Repositories;

use App\Plugins\SalesOrder\Models\SalesOrderTotal;
use App\Repositories\BaseRepository;

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
                    $salesOrderLog->text = '$ '.$cart_rule['discount_amount'];
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
                $salesOrderLog->text = '$ '.$total;
                $salesOrderLog->sort = SalesOrderTotal::TOTAL_SORT[strtoupper($key)];
                $salesOrderLog->save();
            }
        }
    }
}
