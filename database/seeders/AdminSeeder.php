<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\AdminRepository;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(AdminRepository $adminRepository): void
    {
        $admins = [
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => '123123',
                'status' => 1
            ],
        ];

        foreach ($admins as $admin) {
            $adminRepository->create($admin);
        }
    }
}
