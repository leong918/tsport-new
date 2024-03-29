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

    public function createLog($order, $table_id, $table, $status, $description)
    {
        $salesOrderLog = new SalesOrderLog();
        $salesOrderLog->sales_order_id = $order->id;
        if($table == 'user') {
            $salesOrderLog->user_id = $table_id;
        }else if ($table == 'admin') {
            $salesOrderLog->user_id = $order->user_id;
            $salesOrderLog->admin_id = $table_id;
        }
        $salesOrderLog->description = $description;
        $salesOrderLog->status = $status;
        $salesOrderLog->save();
    }
}
