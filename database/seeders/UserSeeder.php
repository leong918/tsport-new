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
        // Create a test user
        User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => '123123', // This will be automatically hashed by the model's mutator
            'phone_no' => '+1234567890',
            'status' => User::STATUS['ACTIVE'],
            'referral_code' => 'TEST001',
            'referred_user_id' => null,
        ]);
    }
}
