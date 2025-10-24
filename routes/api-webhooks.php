<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\LiveMatch;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Public Webhook API Routes
|--------------------------------------------------------------------------
| These routes are accessible without authentication for external webhooks
*/

// DVR Upload Complete Webhook - called by rtmp-server after uploading to Spaces
Route::post('/dvr/upload-complete', function (Request $request) {
    // Validate webhook secret if configured
    $webhookSecret = env('DVR_WEBHOOK_SECRET');
    if ($webhookSecret) {
        $providedSecret = $request->header('X-Webhook-Secret');
        if ($providedSecret !== $webhookSecret) {
            Log::warning('DVR webhook invalid secret', [
                'ip' => $request->ip(),
                'provided' => $providedSecret
            ]);
            return response()->json(['error' => 'Invalid webhook secret'], 401);
        }
    }
    
    // Validate required fields
    $validated = $request->validate([
        'filename' => 'required|string',
        'file_url' => 'required|url',
        'file_size' => 'required|integer',
        'upload_time' => 'required|string',
        'stream_app' => 'required|string',
        'stream_name' => 'required|string',
        'timestamp' => 'required|string',
        'format' => 'nullable|string|in:mp4,flv'
    ]);
    
    try {
        // Extract timestamp from filename (format: timestamp.flv)
        $filenameTimestamp = basename($validated['filename'], '.flv');
        $recordingStartedAt = date('Y-m-d H:i:s', intval($filenameTimestamp) / 1000);
        
        // Find live match by obs_stream_key (exact match with stream_name)
        // Example: stream_name = "stream_8_68fa0d1b398c8"
        $liveMatch = LiveMatch::where('obs_stream_key', $validated['stream_name'])->first();
        
        if (!$liveMatch) {
            Log::warning('DVR webhook: live match not found', [
                'obs_stream_key' => $validated['stream_name']
            ]);
            return response()->json([
                'success' => false,
                'error' => 'Live match not found'
            ], 404);
        }
        
        // Add DVR recording to live match
        $recordingData = [
            'filename' => $validated['filename'],
            'file_url' => $validated['file_url'],
            'file_size' => $validated['file_size'],
            'recording_started_at' => $recordingStartedAt,
        ];
        
        $success = $liveMatch->addDvrRecording($recordingData);
        
        if ($success) {
            Log::info('DVR recording added to live match', [
                'live_match_id' => $liveMatch->id,
                'filename' => $validated['filename']
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'DVR recording added successfully'
            ]);
        } else {
            Log::error('Failed to add DVR recording', [
                'live_match_id' => $liveMatch->id,
                'recording_data' => $recordingData
            ]);
            
            return response()->json([
                'success' => false,
                'error' => 'Failed to add DVR recording'
            ], 500);
        }
        
    } catch (\Exception $e) {
        Log::error('DVR webhook exception', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return response()->json([
            'success' => false,
            'error' => 'Internal server error'
        ], 500);
    }
});
