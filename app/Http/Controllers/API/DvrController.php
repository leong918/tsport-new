<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Models\LiveMatch;

class DvrController extends Controller
{
    /**
     * Handle DVR upload completion notification from rtmp-server
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadComplete(Request $request): JsonResponse
    {
        try {
            // Log the incoming request
            Log::info('DVR upload notification received', [
                'request_data' => $request->all(),
                'headers' => $request->headers->all()
            ]);

            // Validate webhook secret if configured
            $webhookSecret = config('streaming.dvr_webhook_secret');
            if ($webhookSecret) {
                $providedSecret = $request->header('X-Webhook-Secret');
                if ($providedSecret !== $webhookSecret) {
                    Log::warning('DVR webhook unauthorized - invalid secret');
                    return response()->json(['error' => 'Unauthorized'], 401);
                }
            }

            // Get file information from request
            $filename = $request->input('filename');
            $fileUrl = $request->input('file_url');
            $fileSize = $request->input('file_size');
            $streamName = $request->input('stream_name');
            $uploadTime = $request->input('upload_time');

            // Validate required fields
            if (!$filename || !$fileUrl || !$streamName) {
                Log::error('DVR webhook missing required fields', [
                    'filename' => $filename,
                    'file_url' => $fileUrl,
                    'stream_name' => $streamName
                ]);
                return response()->json(['error' => 'Missing required fields'], 400);
            }

            // Find the live match by stream key
            $liveMatch = LiveMatch::where('obs_stream_key', $streamName)->first();

            if (!$liveMatch) {
                Log::warning('DVR upload for unknown stream', [
                    'stream_name' => $streamName,
                    'filename' => $filename
                ]);
                // Still return success to avoid retries
                return response()->json(['status' => 'success', 'message' => 'Stream not found']);
            }

            // Update or create DVR record
            // You might want to create a separate DVR recordings table
            // For now, we'll just log it and maybe store in a JSON field
            
            Log::info('DVR upload completed for live match', [
                'live_match_id' => $liveMatch->id,
                'stream_name' => $streamName,
                'filename' => $filename,
                'file_url' => $fileUrl,
                'file_size' => $fileSize,
                'upload_time' => $uploadTime
            ]);

            // Here you could:
            // 1. Store DVR recording info in database
            // 2. Update live match with recording status
            // 3. Send notifications to users
            // 4. Generate thumbnails/previews
            
            return response()->json([
                'status' => 'success',
                'message' => 'DVR upload processed successfully',
                'live_match_id' => $liveMatch->id
            ]);

        } catch (\Exception $e) {
            Log::error('Error processing DVR upload notification', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process DVR upload'
            ], 500);
        }
    }
}
