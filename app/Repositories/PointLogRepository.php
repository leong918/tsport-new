<?php

namespace App\Repositories;

use App\Models\PointLog;

class PointLogRepository extends BaseRepository
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
        return PointLog::class;
    }

    public function getListing()
    {
        return PointLog::query()->orderBy('created_at', 'desc');
    }
}
