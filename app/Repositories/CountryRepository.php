<?php

namespace App\Repositories;

use App\Models\Country;

class CountryRepository extends BaseRepository
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
        return Country::class;
    }

    public function getListing()
    {
        return Country::where('status', 1)->orderBy('name')->get();
    }

    public function createCountry(array $input)
    {
        $model = new Country();
        $model->fill($input);
        $model->save();
    }

    public function updateCountry(array $input, int $id)
    {
        $model = Country::findOrFail($id);
        $model->fill($input);
        $model->save();
    }

    public function toggleStatus(int $id)
    {
        $model = Country::find($id);
        $model->status = !$model->status;
        $model->save();
    }

    public function calculateShippingFee($total_price, $country_id)
    {
        $country = Country::find($country_id);
        $data['shipping_fee'] = 0;
        $data['is_free_shipping'] = 0;
        $data['is_pay_later'] = 0;
        $data['delivery_partner'] = $country->delivery_partner;

        if ($country->min_spend_free_delivery && $total_price >= $country->min_spend_free_delivery) {
            $data['is_free_shipping'] = 1;
        } else {
            if (!$country->delivery_flat_rate) {
                $data['is_pay_later'] = 1;
            } else {
                $data['shipping_fee'] = round($country->delivery_flat_rate, 2);
            }
        }

        return $data;
    }
}
