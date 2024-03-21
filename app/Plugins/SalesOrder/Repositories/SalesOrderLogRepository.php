<?php

namespace App\Plugins\SalesOrder\Repositories;

use App\Plugins\SalesOrder\Models\SalesOrderLog;
use App\Repositories\BaseRepository;
use Illuminate\Container\Container;

class SalesOrderLogRepository extends BaseRepository
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
        return SalesOrderLog::class;
    }

    public function createLog($order, $table_id, $table, $status)
    {
        $salesOrderLog = new SalesOrderLog();
        $salesOrderLog->sales_order_id = $order->id;
        $salesOrderLog->user_id = ($table === 'user' ? $table_id : null);
        $salesOrderLog->admin_id = ($table === 'admin' ? $table_id : null);
        $salesOrderLog->status = $status;
        $salesOrderLog->save();
    }
}
