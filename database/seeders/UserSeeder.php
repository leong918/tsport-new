<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\UserRepository;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(UserRepository $userRepository): void
    {
        $users = [
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => '123123',
                'status' => 1
            ],
        ];

        foreach ($users as $user) {
            $userRepository->create($user);
        }
    }
}
