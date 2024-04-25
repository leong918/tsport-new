<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductBalanceLog;

class ProductBalanceLogRepository extends BaseRepository
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
        return ProductBalanceLog::class;
    }

    public function getListing()
    {
        return ProductBalanceLog::query()->orderBy('created_at', 'desc');
    }

    public function createProductBalanceLog($model, $stockInput, $remark)
    {
        $log_model = new ProductBalanceLog();

        if ($model instanceof Product) {
            $log_model->product_id = $model->id;
        } else {
            $log_model->product_id = $model->product_id;
            $log_model->product_attribute_term_id = $model->id;
        }

        $log_model->type = $stockInput['type'];
        $log_model->quantity = $stockInput['quantity'];
        $log_model->remark = $remark;
        $log_model->save();
    }
}
