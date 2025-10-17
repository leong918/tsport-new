<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\LiveMatch;

/*
|--------------------------------------------------------------------------
| API Routes for Streaming
|--------------------------------------------------------------------------
*/

// Stream status notification from RTMP server
Route::post('/streams/status', function (Request $request) {
    $streamKey = $request->input('stream_key');
    $status = $request->input('status');
    
    if (!$streamKey || !$status) {
        return response()->json(['error' => 'Missing stream_key or status'], 400);
    }
    
    // Find live match by stream key
    $liveMatch = LiveMatch::where('obs_stream_key', $streamKey)->first();
    
    if (!$liveMatch) {
        return response()->json(['error' => 'Live match not found'], 404);
    }
    
    // Update status based on stream event
    switch ($status) {
        case 'live':
            // Use direct assignment instead of update() since obs_status and timestamps are not fillable
            $liveMatch->obs_status = 2; // Live
            $liveMatch->stream_started_at = now();
            $liveMatch->save();
            break;
            
        case 'ended':
            // Use direct assignment instead of update() since obs_status and timestamps are not fillable
            $liveMatch->obs_status = 0; // Offline
            $liveMatch->stream_ended_at = now();
            $liveMatch->save();
            break;
    }
    
    return response()->json([
        'success' => true,
        'message' => "Stream {$streamKey} status updated to {$status}",
        'live_match_id' => $liveMatch->id
    ]);
});

// Get stream information
Route::get('/streams/{streamKey}', function ($streamKey) {
    $liveMatch = LiveMatch::where('obs_stream_key', $streamKey)
        ->with('match')
        ->first();
        
    if (!$liveMatch) {
        return response()->json(['error' => 'Stream not found'], 404);
    }
    
    return response()->json([
        'stream_key' => $streamKey,
        'status' => $liveMatch->obs_status,
        'hls_url' => "http://localhost:8889/live/{$streamKey}/index.m3u8",
        'rtmp_url' => $liveMatch->rtmp_url,
        'match' => $liveMatch->match,
        'viewer_count' => $liveMatch->viewer_count
    ]);
});
