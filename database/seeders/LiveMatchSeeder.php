<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LiveMatch;
use App\Models\Matches;
use Carbon\Carbon;

class LiveMatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Create live matches based on existing match records
     */
    public function run(): void
    {
        // Get all active matches to create live matches for
        $matches = Matches::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($matches->isEmpty()) {
            $this->command->warn('No matches found. Please create some matches first.');
            return;
        }

        $obsStatuses = [0, 0, 0, 1, 2]; // Mostly stopped, some starting/live
        $count = 0;

        foreach ($matches as $match) {
            // Random OBS status (weighted towards stopped)
            $obsStatus = $obsStatuses[array_rand($obsStatuses)];
            
            // Create a live match for each match
            LiveMatch::create([
                'match_id' => $match->id,
                'thumbnail' => 'live/thumbnails/sample-' . $match->id . '.jpg',
                'rtmp_url' => 'rtmp://localhost:1935/live/stream_' . $match->id,
                'obs_stream_key' => 'stream_' . $match->id . '_' . uniqid(),
                'obs_server_url' => 'rtmp://localhost:1935/live',
                'obs_status' => $obsStatus,
                'viewer_count' => $obsStatus == 2 ? rand(100, 500) : rand(0, 50), // More viewers if live
                'start_at' => Carbon::parse($match->start_at)->subMinutes(30),
                'end_at' => Carbon::parse($match->start_at)->addHours(2),
                'status' => 1,
                'stream_started_at' => $obsStatus >= 2 ? Carbon::now()->subMinutes(rand(10, 60)) : null,
                'stream_ended_at' => null,
                'obs_error_log' => null,
            ]);
            
            $count++;
        }

        $this->command->info("Created {$count} live match records.");
    }
}
