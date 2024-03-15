<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\LevelRepository;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(LevelRepository $levelRepository): void
    {
        // import base module
        $levels = [
            [
                'name' => 'Just Member',
                'leveling' => 1,
                'target_amount' => 0,
                'extend_amount' => 0,
            ],
            [
                'name' => 'Insider',
                'leveling' => 2,
                'target_amount' => 1000,
                'extend_amount' => 5000,
            ],
            [
                'name' => 'Core',
                'leveling' => 3,
                'target_amount' => 15000,
                'extend_amount' => 8000,
            ],
        ];

        foreach ($levels as $level) {
            $levelRepository->create($level);
        }
    }
}
