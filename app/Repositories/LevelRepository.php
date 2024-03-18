<?php

namespace App\Repositories;

use App\Models\Level;

class LevelRepository extends BaseRepository
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
        return Level::class;
    }

    public function getListing()
    {
        return Level::query()->orderBy('created_at', 'desc');
    }

    public function dropdown(string $key = 'id')
    {
        return formalizeDropdown(Level::all(), $key, 'name');
    }

    public function getLowestLeveling(){
        return Level::where('leveling',1)->first();
    }

}
