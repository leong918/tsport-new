<?php

namespace App\Repositories;

use App\Models\Referral;

class ReferralRepository extends BaseRepository
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
        return Referral::class;
    }

    public function releaseReferCoupon($referrer_user_id, $referee_user_id)
    {
        $model = new Referral();
        $model->referrer_user_id = $referrer_user_id;
        $model->referee_user_id = $referee_user_id;
        $model->save();
    }

    public function getRefereeDiscount($user_id, $sales_order_id = null)
    {
        $voucher = Referral::where('referee_user_id', $user_id);

        if ($sales_order_id) {
            $voucher->where('referee_sales_order_id', $sales_order_id);
        } else {
            $voucher->whereNull('referee_sales_order_id');
        }

        return $voucher->first();
    }

    public function getReferrerDiscount($user_id, $sales_order_id = null)
    {
        $voucher = Referral::where('referrer_user_id', $user_id);

        if ($sales_order_id) {
            $voucher->where('referrer_sales_order_id', $sales_order_id);
        } else {
            $voucher->whereNull('referrer_sales_order_id');
        }

        return $voucher->first();
    }

    public function updateReferrerVoucher($user_id, $order_id)
    {
        $voucher = Referral::where('referrer_user_id', $user_id)
            ->whereNull('referrer_sales_order_id')
            ->whereNull('referrer_voucher_used_at')
            ->first();

        if (!$voucher) {
            throw new \Exception('Referrer Voucher Not Found!');
        }

        $voucher->referrer_sales_order_id = $order_id;
        $voucher->save();
    }

    public function updateRefereeVoucher($user_id, $order_id)
    {
        $voucher = Referral::where('referee_user_id', $user_id)
            ->whereNull('referee_sales_order_id')
            ->whereNull('referee_voucher_used_at')
            ->first();

        if (!$voucher) {
            throw new \Exception('Referee Voucher Not Found!');
        }

        $voucher->referee_sales_order_id = $order_id;
        $voucher->save();
    }
}
