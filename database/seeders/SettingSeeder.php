<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Repositories\SettingRepository;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(SettingRepository $settingRepository): void
    {
        $settings = [
            [
                'key' => 'sub_slider_title',
                'value' => 'Double 11 Promotion',
            ],
            [
                'key' => 'section_right_title',
                'value' => 'Wellness | Hello | Guga',
            ],
            [
                'key' => 'product_right_select',
                'value' => '["1","2","3","4"]',
            ],
            [
                'key' => 'product_center_select',
                'value' => '["1","2","3","4"]',
            ],
            [
                'key' => 'product_recommended_select',
                'value' => '["1","2","3","4"]',
            ],
            [
                'key' => 'section_left_title',
                'value' => 'Superstar of Cruela',
            ],
            [
                'key' => 'product_left_select',
                'value' => '["1","2","3","4"]',
            ],
            [
                'key' => 'section_center_title',
                'value' => 'New launches of Lovinah are here demonstrating what innovative and unique truely means',
            ],
            [
                'key' => 'recommended_title',
                'value' => 'A Few Things We Think You Like',
            ],
        ];

        foreach ($settings as $setting) {
            $settingRepository->create($setting);
        }
    }
}
