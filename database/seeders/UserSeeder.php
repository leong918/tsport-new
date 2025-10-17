<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Users data
        $users = [
            [
                'name' => 'Test User',
                'username' => 'testuser',
                'email' => 'test@example.com',
                'password' => '123123',
                'phone_no' => '+1234567890',
                'status' => User::STATUS['ACTIVE'],
                'referral_code' => 'TEST001',
                'referred_user_id' => null,
            ],
            [
                'name' => 'Alex',
                'username' => 'alex',
                'email' => 'alex@example.com',
                'password' => '123123',
                'phone_no' => '+1234567891',
                'status' => User::STATUS['ACTIVE'],
                'referral_code' => 'ALEX001',
                'referred_user_id' => null,
            ],
            [
                'name' => 'Mei',
                'username' => 'mei',
                'email' => 'mei@example.com',
                'password' => '123123',
                'phone_no' => '+1234567892',
                'status' => User::STATUS['ACTIVE'],
                'referral_code' => 'MEI001',
                'referred_user_id' => null,
            ],
            [
                'name' => 'Jason',
                'username' => 'jason',
                'email' => 'jason@example.com',
                'password' => '123123',
                'phone_no' => '+1234567893',
                'status' => User::STATUS['ACTIVE'],
                'referral_code' => 'JASON001',
                'referred_user_id' => null,
            ],
            [
                'name' => 'fquinf',
                'username' => 'fquinf',
                'email' => 'fquinf@example.com',
                'password' => '123123',
                'phone_no' => '+1234567894',
                'status' => User::STATUS['ACTIVE'],
                'referral_code' => 'FQUINF001',
                'referred_user_id' => null,
            ],
            [
                'name' => 'ahbengg',
                'username' => 'ahbengg',
                'email' => 'ahbengg@example.com',
                'password' => '123123',
                'phone_no' => '+1234567895',
                'status' => User::STATUS['ACTIVE'],
                'referral_code' => 'AHBENGG001',
                'referred_user_id' => null,
            ],
        ];

        // Create users only if they don't exist
        foreach ($users as $userData) {
            $existingUser = User::where('username', $userData['username'])
                               ->orWhere('email', $userData['email'])
                               ->first();

            if (!$existingUser) {
                User::create($userData);
                echo "Created user: " . $userData['username'] . "\n";
            } else {
                echo "User already exists: " . $userData['username'] . "\n";
            }
        }
    }
}
