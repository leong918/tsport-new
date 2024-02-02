<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\AdminMenuRepository;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(AdminMenuRepository $adminMenuRepository): void
    {
        // import base module
        $adminMenus = [
            [
                'parent_id' => null,
                'title' => 'Admin',
                'icon' => 'fa-solid fa-user-gear',
                'url' => null,
                'type' => 'system_config',
                'sort' => 1,
                'status' => 1
            ],
            [
                'parent_id' => null,
                'title' => 'Product & Category',
                'icon' => 'fa-solid fa-folder-open',
                'url' => null,
                'type' => 'shop',
                'sort' => 1,
                'status' => 1
            ],
            [
                'parent_id' => 1,
                'title' => 'Admin List',
                'icon' => null,
                'url' => 'admin.admin.index',
                'type' => 'system_config',
                'sort' => 1,
                'status' => 1
            ],
            [
                'parent_id' => 2,
                'title' => 'Product List',
                'icon' => null,
                'url' => 'admin.product.index',
                'type' => 'shop',
                'sort' => 1,
                'status' => 1
            ],
            [
                'parent_id' => 2,
                'title' => 'Category List',
                'icon' => null,
                'url' => 'admin.category.index',
                'type' => 'shop',
                'sort' => 1,
                'status' => 1
            ],
            [
                'parent_id' => 2,
                'title' => 'Brand List',
                'icon' => null,
                'url' => 'admin.brand.index',
                'type' => 'shop',
                'sort' => 1,
                'status' => 1
            ],
        ];

        foreach ($adminMenus as $adminMenu) {
            $adminMenuRepository->create($adminMenu);
        }
    }
}
