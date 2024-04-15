<?php

namespace App\Plugins\SalesOrder\Repositories;

use App\Plugins\SalesOrder\Models\CartRule;
use App\Repositories\BaseRepository;
use App\Repositories\ReferralRepository;
use Carbon\Carbon;
use Illuminate\Container\Container;
use App\Repositories\UserRepository;

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

    public function calculatePriorityRule($cart, $couponList, $user_id, $is_upgrade_insider)
    {
        $referralRepository = new ReferralRepository(new Container());
        $userRepository = new UserRepository(new Container());
        $user = $userRepository->find($user_id);

        $cart_rule_array = array();
        $cart_rules = CartRule::where('status', 1)
            ->where(function ($query) use ($couponList) {
                $query->where('type', '<>', 'coupon')
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

        $total_discount_amount = 0;
        foreach ($cart_rules as $cart_rule) {
            $discount_amount = 0;
            $cart_rule_type = $cart_rule->type == 'coupon' ? 'coupon' : 'discount';

            if ($cart_rule->type == 'insider_discount' && ((!$user || $user->level_id != 2) && !$is_upgrade_insider)) {
                continue;
            } else if ($cart_rule->type == 'core_discount' && (!$user || $user->level_id != 3)) {
                continue;
            } else if ($cart_rule->type == 'referee_discount' && !$user) {
                continue;
            } else if ($cart_rule->type == 'referrer_discount' && !$user) {
                continue;
            }

            if ($cart_rule->type == 'referee_discount') {
                $refer_data = $referralRepository->getRefereeDiscount($user_id);
                if (!$refer_data) {
                    continue;
                }
            } else if ($cart_rule->type == 'referrer_discount') {
                $refer_data = $referralRepository->getReferrerDiscount($user_id);
                if (!$refer_data) {
                    continue;
                }
            }

            if ($cart_rule->target_table !== 'whole') {
                $cart = $cart->where($cart_rule->target_table . '_id', $cart_rule->table_id);
            }

            foreach ($cart as &$type_cart) {
                if ($cart_rule->discount_type == 'percentage') {
                    $single_discount = $type_cart->price * $cart_rule->value / 100;
                } else {
                    $single_discount = $cart_rule->value;
                }

                $type_cart->price -= round($single_discount, 2);
                $discount_amount += $single_discount * $type_cart->quantity;
            }

            if ($discount_amount > 0) {
                $cart_rule_array[$cart_rule_type][$cart_rule->id]['id'] = $cart_rule->id;
                $cart_rule_array[$cart_rule_type][$cart_rule->id]['name'] = $cart_rule_type == 'coupon' ? $cart_rule->coupon_code : $cart_rule->name;
                $cart_rule_array[$cart_rule_type][$cart_rule->id]['discount_amount'] = round($discount_amount, 2);

                $total_discount_amount += $discount_amount;
            }
        }

        $cart_rule_array['total_discount_amount'] = $total_discount_amount;
        if (isset($cart_rule_array['discount'])) {
            sort($cart_rule_array['discount']);
        }
        if (isset($cart_rule_array['coupon'])) {
            sort($cart_rule_array['coupon']);
        }

        return $cart_rule_array;
    }

    public function getReferrerVoucher()
    {
        return CartRule::where('type', 'referrer_discount')->where('status', 1)->first();
    }

    public function getRefereeVoucher()
    {
        return CartRule::where('type', 'referee_discount')->where('status', 1)->first();
    }
}
