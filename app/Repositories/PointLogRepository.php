<?php

namespace App\Repositories;

use App\Models\PointLog;
use Carbon\Carbon;

class PointLogRepository extends BaseRepository
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
        return PointLog::class;
    }

    public function getListing()
    {
        return PointLog::query()->orderBy('created_at', 'desc');
    }

    public function markPointUsed($order)
    {
        PointLog::where('user_id', $order->user_id)
            ->where('is_used', 0)
            ->where('is_expired', 0)
            ->where('type', 'IN')
            ->update([
                'used_sales_order_id' => $order->id,
                'used_at' => Carbon::now(),
                'is_used' => 1
            ]);
    }

    public function returnPointUsed($order)
    {
        PointLog::where('user_id', $order->user_id)
            ->where('used_sales_order_id', $order->id)
            ->where('is_used', 1)
            ->whereNotNull('used_at')
            ->where('type', 'IN')
            ->update([
                'used_sales_order_id' => null,
                'used_at' => null,
                'is_used' => 0
            ]);
    }

    public function getUnusedPoint()
    {
        return PointLog::where('is_used', 0)
            ->where('type', 'IN')
            ->whereNull('used_sales_order_id')
            ->whereNull('used_at')
            ->where('is_expired', 0)
            ->whereDate('expired_at', '<=', Carbon::now())
            ->get();
    }
}
