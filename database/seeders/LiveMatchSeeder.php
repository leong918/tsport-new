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

        foreach ($matches as $index => $match) {
            // For first 3 matches, set them as upcoming (future dates)
            // For the rest, use random status
            if ($index < 3) {
                $obsStatus = 0; // Not started yet
                // Set match start time to future (1-7 days from now)
                $futureStartAt = Carbon::now()->addDays(rand(1, 7))->setHour(rand(15, 22))->setMinute([0, 15, 30, 45][rand(0, 3)]);
                $startAt = $futureStartAt->copy()->subMinutes(30);
                $endAt = $futureStartAt->copy()->addHours(2);
                
                // Update the match table start_at to future date
                $match->update(['start_at' => $futureStartAt]);
            } else {
                // Random OBS status (weighted towards stopped)
                $obsStatus = $obsStatuses[array_rand($obsStatuses)];
                $startAt = Carbon::parse($match->start_at)->subMinutes(30);
                $endAt = Carbon::parse($match->start_at)->addHours(2);
            }
            
            // Create a live match for each match
            LiveMatch::create([
                'match_id' => $match->id,
                'thumbnail' => 'sample-' . $match->id . '.jpg',
                'fixture_image' => $index < 3 ? 'fixture-' . $match->id . '.jpg' : null,
                'rtmp_url' => 'rtmp://localhost:1935/live/stream_' . $match->id,
                'obs_stream_key' => 'stream_' . $match->id . '_' . uniqid(),
                'obs_server_url' => 'rtmp://localhost:1935/live',
                'obs_status' => $obsStatus,
                'viewer_count' => $obsStatus == 2 ? rand(100, 500) : rand(0, 50), // More viewers if live
                'start_at' => $startAt,
                'end_at' => $endAt,
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
