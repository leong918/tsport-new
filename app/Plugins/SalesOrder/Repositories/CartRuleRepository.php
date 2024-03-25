<?php

namespace App\Plugins\SalesOrder\Repositories;

use App\Plugins\SalesOrder\Models\CartRule;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class CartRuleRepository extends BaseRepository
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
        return CartRule::class;
    }

    public function getListing()
    {
        return CartRule::query()->orderBy('created_at', 'desc');
    }

    public function createCartRule(array $input)
    {
        $input['start_date'] = $input['start_date'] ? Carbon::parse($input['start_date'])->format('Y-m-d H:i:s') : null;
        $input['end_date'] = $input['end_date'] ? Carbon::parse($input['end_date'])->format('Y-m-d H:i:s') : null;

        $model = new CartRule();
        $model->fill($input);
        $model->save();
    }

    public function updateCartRule(array $input, int $id)
    {
        $input['start_date'] = $input['start_date'] ? Carbon::parse($input['start_date'])->format('Y-m-d H:i:s') : null;
        $input['end_date'] = $input['end_date'] ? Carbon::parse($input['end_date'])->format('Y-m-d H:i:s') : null;

        $model = CartRule::findOrFail($id);
        $model->fill($input);
        $model->save();
    }

    public function toggleStatus(int $id)
    {
        $model = CartRule::find($id);
        $model->status = !$model->status;
        $model->save();
    }

    public function getCouponByCode($coupon_code)
    {
        return CartRule::where('coupon_code', $coupon_code)->where('status', 1)->first();
    }

    public function calculatePriorityRule(object $cart, array $couponList)
    {
        $cart_rule_array = array();
        $cart_rules = CartRule::where('status', 1)
            ->where(function ($query) use ($couponList) {
                $query->where('type', 'discount')
                    ->orWhere(function ($subquery) use ($couponList) {
                        $subquery->where('type', 'coupon')
                            ->whereIn('id', $couponList);
                    });
            })->where(function ($query) {
                $query->where(function ($subquery) {
                    $subquery->whereNull('start_date')
                        ->whereNull('end_date');
                })->orWhere(function ($subquery) {
                    $subquery->where('start_date', '<=', Carbon::now())
                        ->where('end_date', '>=', Carbon::now());
                });
            })
            ->orderBy('priority', 'desc')->orderBy('created_at', 'desc')->get();

        foreach ($cart_rules as $cart_rule) {
            if ($cart_rule->target_table !== 'whole') {
                if ($cart_rule->discount_type == 'percentage') {
                    $total_type_cart = $cart->where($cart_rule->target_table . '_id', $cart_rule->table_id)->sum('total_price');
                    $discount_amount = $total_type_cart > 0 ? $total_type_cart * $cart_rule->value / 100 : 0;
                } else {
                    $count_type_cart = $cart->where($cart_rule->target_table . '_id', $cart_rule->table_id)->sum('quantity');
                    $discount_amount = $count_type_cart > 0 ? $count_type_cart * $cart_rule->value : 0;
                }
            } else {
                if ($cart_rule->discount_type == 'percentage') {
                    $total_type_cart = $cart->sum('total_price');
                    $discount_amount = $total_type_cart > 0 ? $total_type_cart * $cart_rule->value / 100 : 0;
                } else {
                    $count_type_cart = $cart->sum('quantity');
                    $discount_amount = $count_type_cart > 0 ? $count_type_cart * $cart_rule->value : 0;
                }
            }

            if ($discount_amount > 0) {
                $cart_rule_array['discount'][$cart_rule->id]['name'] = $cart_rule->name;
                $cart_rule_array['discount'][$cart_rule->id]['discount_amount'] = $discount_amount;
            }
        }

        return $cart_rule_array;
    }
}
