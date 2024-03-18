<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\CurrencyRepository;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(CurrencyRepository $currrencyRepository): void
    {
        // import base module
        $currencies = [
            [
                'name' => 'Hong Kong Dollar',
                'code' => 'HKD',
                'status' => 1,
            ]
        ];

        foreach ($currencies as $currency) {
            $currrencyRepository->create($currency);
        }
    }
}
