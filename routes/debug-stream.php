<?php

use Illuminate\Support\Facades\Route;
use App\Models\LiveMatch;
use App\Models\Matches;

// Create a quick live match for current stream
Route::get('/create-stream/{streamKey}', function ($streamKey) {
    try {
        // Find a match to use
        $match = Matches::where('status', 1)->first();
        if (!$match) {
            return response()->json(['error' => 'No active matches found'], 404);
        }
        
        // Create or update live match
        $liveMatch = LiveMatch::updateOrCreate(
            ['obs_stream_key' => $streamKey],
            [
                'match_id' => $match->id,
                'obs_server_url' => 'rtmp://localhost:1936/live',
                'obs_stream_key' => $streamKey,
                'rtmp_url' => "rtmp://localhost:1936/live/{$streamKey}",
                'obs_status' => 2, // Live
                'status' => 1, // Active
                'viewer_count' => 0,
                'stream_started_at' => now(),
            ]
        );
        
        return response()->json([
            'success' => true,
            'live_match' => $liveMatch,
            'flv_url' => "http://localhost:8080/live/{$streamKey}.flv",
            'view_url' => "http://127.0.0.1:8000/live/{$liveMatch->id}"
        ], 200, [], JSON_PRETTY_PRINT);
        
    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
