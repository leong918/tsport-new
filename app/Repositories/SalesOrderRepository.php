<?php

namespace App\Repositories;

use App\Models\SalesOrder;


class SalesOrderRepository extends BaseRepository
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
        return SalesOrder::class;
    }

    public function getListing()
    {
        return SalesOrder::query()->orderBy('created_at', 'desc');
    }

    public function getSalesOrderByDateRange($from, $to, $user_id)
    {
        return SalesOrder::where(['user_id' => $user_id, 'status' => 1])
                            ->whereBetween('created_at',[$from, $to])
                            ->selectRaw('SUM(total) as total_amount')
                            ->get();
    }

}
