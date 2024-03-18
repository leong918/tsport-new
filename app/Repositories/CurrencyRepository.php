<?php

namespace App\Repositories;

use App\Models\Currency;
use Illuminate\Container\Container;

class CurrencyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
    ];

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
        return Currency::class;
    }

    public function getListing()
    {
        return Currency::query()->orderBy('created_at', 'desc');
    }

    public function dropdown(string $key = 'id')
    {
        return formalizeDropdown(Currency::all(), $key, 'name');
    }

    public function getCurrencyByCode(string $currency_code)
    {
        return Currency::where(['code' => $currency_code, 'status' => 1])->first();
    }

    public function createCurrency(array $input)
    {
        $model = new Currency();
        $model->fill($input);
        $model->save();
    }

    public function updateCurrency(array $input, int $id)
    {
        $model = Currency::findOrFail($id);
        $model->fill($input);
        $model->save();
    }

    public function toggleStatus(int $id)
    {
        $model = Currency::find($id);
        $model->status = !$model->status;
        $model->save();
    }
}
