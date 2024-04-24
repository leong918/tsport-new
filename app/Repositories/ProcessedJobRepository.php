<?php

namespace App\Repositories;

use App\Models\ProcessedJob;

class ProcessedJobRepository extends BaseRepository
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
        return ProcessedJob::class;
    }

    public function getListing()
    {
        return ProcessedJob::query()->orderBy('created_at', 'desc');
    }

    public function getLatestJobByName(string $jobName)
    {
        return ProcessedJob::where('name', $jobName)->orderBy('id','desc')->first();
    }

    public function getLastRunningJobByName(string $jobName)
    {
        return ProcessedJob::where('name', $jobName)->whereNotNull('end_at')->orderBy('id','desc')->first();
    }
}
