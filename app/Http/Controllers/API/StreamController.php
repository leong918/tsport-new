<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LiveMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StreamController extends Controller
{
    /**
     * SRS HTTP Callback - automatically called by SRS server on stream events
     */
    public function srsCallback(Request $request)
    {
        $action = $request->input('action');
        $streamUrl = $request->input('stream_url');
        $app = $request->input('app');
        $stream = $request->input('stream');
        
        Log::info('SRS Callback received', [
            'action' => $action,
            'app' => $app,
            'stream' => $stream,
            'stream_url' => $streamUrl,
            'client_id' => $request->input('client_id'),
            'ip' => $request->input('ip')
        ]);
        
        if (!$stream) {
            Log::warning('SRS Callback: No stream key provided');
            return response()->json(['code' => 0]);
        }
        
        $liveMatch = LiveMatch::where('obs_stream_key', $stream)->first();
        
        if (!$liveMatch) {
            Log::warning('SRS Callback: Live match not found', ['stream' => $stream]);
            return response()->json(['code' => 0]);
        }
        
        switch ($action) {
            case 'on_publish':
                $liveMatch->obs_status = 2; // Live
                $liveMatch->stream_started_at = now();
                $liveMatch->save();
                
                Log::info('Stream started', [
                    'live_match_id' => $liveMatch->id,
                    'stream_key' => $stream
                ]);
                break;
                
            case 'on_unpublish':
                $liveMatch->obs_status = 0; // Offline
                $liveMatch->stream_ended_at = now();
                $liveMatch->save();
                
                Log::info('Stream ended', [
                    'live_match_id' => $liveMatch->id,
                    'stream_key' => $stream
                ]);
                break;
        }
        
        return response()->json(['code' => 0], 200, ['Content-Type' => 'application/json'], JSON_UNESCAPED_SLASHES);
    }

    /**
     * Stream status notification
     */
    public function updateStatus(Request $request)
    {
        $streamKey = $request->input('stream_key');
        $status = $request->input('status');
        
        if (!$streamKey || !$status) {
            return response()->json(['error' => 'Missing stream_key or status'], 400);
        }
        
        $liveMatch = LiveMatch::where('obs_stream_key', $streamKey)->first();
        
        if (!$liveMatch) {
            return response()->json(['error' => 'Live match not found'], 404);
        }
        
        switch ($status) {
            case 'live':
                $liveMatch->obs_status = 2;
                $liveMatch->stream_started_at = now();
                $liveMatch->save();
                break;
                
            case 'ended':
                $liveMatch->obs_status = 0;
                $liveMatch->stream_ended_at = now();
                $liveMatch->save();
                break;
        }
        
        return response()->json([
            'success' => true,
            'message' => "Stream {$streamKey} status updated to {$status}",
            'live_match_id' => $liveMatch->id
        ]);
    }

    /**
     * Get stream information
     */
    public function show($streamKey)
    {
        $liveMatch = LiveMatch::where('obs_stream_key', $streamKey)
            ->with('match')
            ->first();
            
        if (!$liveMatch) {
            return response()->json(['error' => 'Stream not found'], 404);
        }
        
        return response()->json([
            'stream_key' => $streamKey,
            'status' => $liveMatch->obs_status,
            'hls_url' => "http://localhost/live/{$streamKey}/index.m3u8",
            'rtmp_url' => $liveMatch->rtmp_url,
            'match' => $liveMatch->match,
            'viewer_count' => $liveMatch->viewer_count
        ]);
    }

    /**
     * Get DVR recordings for a live match
     */
    public function getDvrRecordings($liveMatchId)
    {
        $liveMatch = LiveMatch::find($liveMatchId);
        
        if (!$liveMatch) {
            return response()->json(['error' => 'Live match not found'], 404);
        }
        
        return response()->json([
            'success' => true,
            'live_match_id' => $liveMatch->id,
            'recordings' => $liveMatch->dvr_recordings ?? [],
            'total_recordings' => $liveMatch->dvr_recording_count,
            'total_size' => $liveMatch->total_dvr_size,
            'latest_recording' => $liveMatch->latest_dvr_recording,
            'last_uploaded_at' => $liveMatch->dvr_last_uploaded_at,
        ]);
    }
}
