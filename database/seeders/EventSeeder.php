<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate existing events
        Event::truncate();

        $events = [
            [
                'id' => 1,
                'title' => '世界杯预选赛开波',
                'image' => 'events/h0OMAUKSg3aBYq1cwpQbxSHSUZbNc09qLROibbR3.png',
                'status' => 'active',
                'start_time' => '2025-10-08 19:09:00',
                'end_time' => '2026-01-29 13:09:00',
                'is_active' => 1,
                'created_at' => '2025-10-08 19:21:56',
                'updated_at' => '2025-10-08 19:30:10',
            ],
            [
                'id' => 2,
                'title' => '波神来啦 - 季节赛',
                'image' => 'events/dm09jeT78LO6IVwtRF4qcGiJ4TPFCWVDtjIdTpRC.png',
                'status' => 'active',
                'start_time' => '2025-10-08 19:30:00',
                'end_time' => '2026-07-31 13:30:00',
                'is_active' => 1,
                'created_at' => '2025-10-08 19:31:03',
                'updated_at' => '2025-10-08 19:31:03',
            ],
            [
                'id' => 3,
                'title' => '猜积分 赢奖品',
                'image' => 'events/Gb3j4PjvZwoXcW0crcJcOK9eSvuM8SNx03cnBLpS.png',
                'status' => 'active',
                'start_time' => '2025-10-08 19:32:00',
                'end_time' => '2027-03-18 13:32:00',
                'is_active' => 1,
                'created_at' => '2025-10-08 19:32:30',
                'updated_at' => '2025-10-08 19:32:30',
            ],
        ];

        foreach ($events as $eventData) {
            Event::create($eventData);
        }
    }
}
