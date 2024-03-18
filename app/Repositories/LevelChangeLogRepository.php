<?php

namespace App\Repositories;

use App\Models\LevelChangeLog;

class LevelChangeLogRepository extends BaseRepository
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
        return LevelChangeLog::class;
    }

    public function getListing()
    {
        return LevelChangeLog::query()->orderBy('created_at', 'desc');
    }

    public function createLevelLog(array $input)
    {
        $model = new LevelChangeLog();
        $model->fill($input);
        $model->save();
    }
}
