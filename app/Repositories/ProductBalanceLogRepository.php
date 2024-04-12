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

    public function createProductBalanceLog($model, $termArr = null, $stockInput = null, $remark)
    {
        $log_model = new ProductBalanceLog();

        //------------  check is product/ prod attr term model ----------------------
        if ($model instanceof Product) {
            
            $log_model->product_id = $model->id;
            if ($stockInput) {
                $log_model->type = ($stockInput['type'] != 'ADD') ? 'OUT' : 'IN';
                $log_model->quantity = $stockInput['quantity'];
            } else {
                $log_model->type = 'IN';
                $log_model->quantity = $model->quantity;
            }
        } else {
            $log_model->product_id = $model->product_id;
            $log_model->product_attribute_term_id = $model->id;

            if (isset($termArr['stock_amount'])) {
                $log_model->type = ($termArr['stock_option'] != 1) ? 'IN' : 'OUT';
                $log_model->quantity = $termArr['stock_amount'];
            } else {
                $log_model->type = 'IN';
                $log_model->quantity = $model->quantity;
            }
        }

        $log_model->remark = $remark;
        $log_model->save();
    }
}
