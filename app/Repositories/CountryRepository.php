<?php

namespace App\Repositories;

use App\Models\Country;

class CountryRepository extends BaseRepository
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
        return Country::class;
    }

    public function getListing()
    {
        return Country::where('status', 1)->orderBy('name')->get();
    }
}
