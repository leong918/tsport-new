<?php

namespace App\Repositories;

use App\Models\EmailContent;

class EmailContentRepository extends BaseRepository
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
        return EmailContent::class;
    }

    public function getListing()
    {
        return EmailContent::query()->orderBy('created_at', 'desc');
    }

}
