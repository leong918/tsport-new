<?php

namespace App\Repositories;

use App\Models\AdminMenu;

class AdminMenuRepository extends BaseRepository
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
        return AdminMenu::class;
    }

    public function getMenuByType()
    {
        $parent_menus = AdminMenu::whereNull('parent_id')->get()->groupBy('type')->sortBy('sort');
        foreach ($parent_menus as $parent_type_menu) {
            foreach ($parent_type_menu as $parent_menu) {
                $parent_menu->child_item = AdminMenu::where('parent_id', $parent_menu->id)->orderBy('sort')->get();
            }
        }
        
        return $parent_menus;
    }

    public function getMenuByKey($key)
    {
        return AdminMenu::where('key', $key)->first();
    }
}
