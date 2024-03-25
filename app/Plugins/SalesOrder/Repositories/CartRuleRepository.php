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
        $input['start_date'] = Carbon::parse($input['start_date'])->format('Y-m-d H:i:s');
        $input['end_date'] = Carbon::parse($input['end_date'])->format('Y-m-d H:i:s');

        $model = new CartRule();
        $model->fill($input);
        $model->coupon_code = isset($input['coupon_code']) ? $input['coupon_code'] : null;
        $model->save();
    }

    public function updateCartRule(array $input, int $id)
    {
        $input['start_date'] = Carbon::parse($input['start_date'])->format('Y-m-d H:i:s');
        $input['end_date'] = Carbon::parse($input['end_date'])->format('Y-m-d H:i:s');

        $model = CartRule::findOrFail($id);
        $model->fill($input); 
        $model->coupon_code = isset($input['coupon_code']) ? $input['coupon_code'] : null;
        $model->save();
    }

    public function toggleStatus(int $id)
    {
        $model = CartRule::find($id);
        $model->status = !$model->status;
        $model->save();
    }

}
