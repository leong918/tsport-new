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
                'parent_id' => null,
                'title' => 'Blog',
                'icon' => 'fa-solid fa-blog',
                'url' => null,
                'type' => 'shop',
                'sort' => 1,
                'status' => 1
            ],
            [
                'parent_id' => null,
                'title' => 'Currency',
                'icon' => 'fa-solid fa-dollar-sign',
                'url' => null,
                'type' => 'system_config',
                'sort' => 1,
                'status' => 1
            ],
            [
                'parent_id' => null,
                'title' => 'User',
                'icon' => 'fa-solid fa-user',
                'url' => null,
                'type' => 'marketing',
                'sort' => 1,
                'status' => 1
            ],
            [
                'parent_id' => null,
                'title' => 'Content Setting',
                'icon' => 'fa fa-cog',
                'url' => null,
                'type' => 'system_config',
                'sort' => 1,
                'status' => 1
            ],
            [
                'parent_id' => null,
                'title' => 'Cart Rule',
                'icon' => 'fa-solid fa-ticket',
                'url' => null,
                'type' => 'marketing',
                'sort' => 1,
                'status' => 1
            ],
            [
                'parent_id' => null,
                'title' => 'Country',
                'icon' => 'fa-solid fa-globe',
                'url' => null,
                'type' => 'system_config',
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
                'sort' => 2,
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
            [
                'parent_id' => 3,
                'title' => 'Blog List',
                'icon' => null,
                'url' => 'admin.blog.index',
                'type' => 'shop',
                'sort' => 1,
                'status' => 1
            ],
            [
                'parent_id' => 2,
                'title' => 'Tag List',
                'icon' => null,
                'url' => 'admin.tag.index',
                'type' => 'shop',
                'sort' => 1,
                'status' => 1
            ],
            [
                'parent_id' => 4,
                'title' => 'Currency List',
                'icon' => null,
                'url' => 'admin.currency.index',
                'type' => 'system_config',
                'sort' => 1,
                'status' => 1
            ],
            [
                'parent_id' => 5,
                'title' => 'User List',
                'icon' => null,
                'url' => 'admin.user.index',
                'type' => 'marketing',
                'sort' => 1,
                'status' => 1
            ],
            [
                'parent_id' => 6,
                'title' => 'Homepage Setting',
                'icon' => null,
                'url' => 'admin.setting.homepage_index',
                'type' => 'system_config',
                'sort' => 1,
                'status' => 1
            ],
            [
                'parent_id' => 6,
                'title' => 'Top Bar Setting',
                'icon' => null,
                'url' => 'admin.top_bar.index',
                'type' => 'system_config',
                'sort' => 1,
                'status' => 1
            ],
            [
                'parent_id' => 6,
                'title' => 'Global Setting',
                'icon' => null,
                'url' => 'admin.setting.global_index',
                'type' => 'system_config',
                'sort' => 1,
                'status' => 1
            ],
            [
                'parent_id' => 7,
                'title' => 'Cart Rule List',
                'icon' => null,
                'url' => 'admin.cart_rule.index',
                'type' => 'marketing',
                'sort' => 1,
                'status' => 1
            ],
            [
                'parent_id' => 8,
                'title' => 'Country List',
                'icon' => null,
                'url' => 'admin.country.index',
                'type' => 'system_config',
                'sort' => 1,
                'status' => 1
            ],
        ];

        foreach ($adminMenus as $adminMenu) {
            $adminMenuRepository->create($adminMenu);
        }
    }
}
