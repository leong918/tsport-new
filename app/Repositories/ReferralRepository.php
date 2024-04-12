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

    public function getRefereeDiscount($user_id)
    {
        return Referral::where('referee_user_id', $user_id)->first();
    }

    public function getReferrerDiscount($user_id)
    {
        return Referral::where('referrer_user_id', $user_id)->first();
    }
}
