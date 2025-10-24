<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LiveMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    /**
     * DVR Upload Complete Webhook
     * Called by Python uploader after uploading to DigitalOcean Spaces
     */
    public function dvrUploadComplete(Request $request)
    {
        // Validate webhook secret
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
            // Extract timestamp from filename
            $filenameTimestamp = basename($validated['filename'], '.flv');
            $recordingStartedAt = date('Y-m-d H:i:s', intval($filenameTimestamp) / 1000);
            
            // Find live match by obs_stream_key
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
            
            // Add DVR recording
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
    }
}
