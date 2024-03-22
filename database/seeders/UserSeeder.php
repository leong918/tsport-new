<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
                'level_id' => '1',
                'first_name' => 'User',
                'last_name' => 'ABC',
                'username' => 'userABC',
                'email' => 'user@gmail.com',
                'phone_no' => '60123456789',
                'birth_month' => 'January',
                'password' => '123123',
                'status' => 1,
                'referral_email' => 'referral@gmail.com',
                'referral_phone_no' => '60112223333'
            ],
        ];

        foreach ($users as $user) {
            $userRepository->create($user);
        }
    }
}
