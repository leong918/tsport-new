<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\LiveMatch;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Live Match Viewer Tracking API Routes
|--------------------------------------------------------------------------
*/

// User joins live stream
Route::post('/live/{id}/join', function (Request $request, $id) {
    try {
        $liveMatch = LiveMatch::find($id);
        
        if (!$liveMatch) {
            return response()->json(['error' => 'Live match not found'], 404);
        }
        
        // Generate unique viewer ID (use IP + User Agent hash, or user ID if authenticated)
        $viewerId = md5($request->ip() . $request->userAgent());
        if (auth('user')->check()) {
            $viewerId = 'user_' . auth('user')->id();
        }
        
        // Check if viewer already exists
        $cacheKey = "live_match_{$id}_viewer_{$viewerId}";
        $alreadyViewing = Cache::has($cacheKey);
        
        // Store viewer in cache with 5 minute expiration
        Cache::put($cacheKey, true, now()->addMinutes(5));
        
        // Only increment count if this is a new viewer
        if (!$alreadyViewing) {
            // Get all active viewers for accurate count
            $pattern = "live_match_{$id}_viewer_*";
            $activeViewers = collect(Cache::get($pattern, []))->count();
            
            // Update viewer count
            $viewerCount = Cache::get("live_match_{$id}_viewer_count", 0);
            $viewerCount++;
            Cache::put("live_match_{$id}_viewer_count", $viewerCount, now()->addMinutes(10));
            
            // Update database (use direct assignment since viewer_count is protected)
            $liveMatch->viewer_count = $viewerCount;
            $liveMatch->save();
            
            Log::info("New viewer joined live match {$id}: {$viewerId}, total: {$viewerCount}");
        } else {
            // Viewer already exists, just refresh their session
            $viewerCount = Cache::get("live_match_{$id}_viewer_count", $liveMatch->viewer_count);
            Log::info("Existing viewer refreshed live match {$id}: {$viewerId}");
        }
        
        return response()->json([
            'success' => true,
            'viewer_count' => $viewerCount,
            'is_new' => !$alreadyViewing
        ]);
    } catch (\Exception $e) {
        Log::error("Error joining live match: " . $e->getMessage());
        return response()->json(['error' => 'Server error'], 500);
    }
});

// User leaves live stream
Route::post('/live/{id}/leave', function (Request $request, $id) {
    try {
        $liveMatch = LiveMatch::find($id);
        
        if (!$liveMatch) {
            return response()->json(['error' => 'Live match not found'], 404);
        }
        
        // Get viewer ID (use IP + User Agent hash, or user ID if authenticated)
        $viewerId = md5($request->ip() . $request->userAgent());
        if (auth('user')->check()) {
            $viewerId = 'user_' . auth('user')->id();
        }
        
        // Remove viewer from cache
        $cacheKey = "live_match_{$id}_viewer_{$viewerId}";
        if (Cache::has($cacheKey)) {
            Cache::forget($cacheKey);
            
            // Decrease viewer count
            $viewerCount = Cache::get("live_match_{$id}_viewer_count", 1);
            $viewerCount = max(0, $viewerCount - 1);
            Cache::put("live_match_{$id}_viewer_count", $viewerCount, now()->addMinutes(10));
            
            // Update database
            $liveMatch->viewer_count = $viewerCount;
            $liveMatch->save();
            
            Log::info("Viewer left live match {$id}: {$viewerId}, total: {$viewerCount}");
        }
        
        return response()->json([
            'success' => true,
            'viewer_count' => $viewerCount ?? 0
        ]);
    } catch (\Exception $e) {
        Log::error("Error leaving live match: " . $e->getMessage());
        return response()->json(['error' => 'Server error'], 500);
    }
});

// Heartbeat to keep viewer alive
Route::post('/live/{id}/heartbeat', function (Request $request, $id) {
    try {
        // Get viewer ID (use IP + User Agent hash, or user ID if authenticated)
        $viewerId = md5($request->ip() . $request->userAgent());
        if (auth('user')->check()) {
            $viewerId = 'user_' . auth('user')->id();
        }
        
        // Extend viewer cache
        $cacheKey = "live_match_{$id}_viewer_{$viewerId}";
        if (Cache::has($cacheKey)) {
            Cache::put($cacheKey, true, now()->addMinutes(5));
        }
        
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        Log::error("Error in heartbeat: " . $e->getMessage());
        return response()->json(['error' => 'Server error'], 500);
    }
});

// Get active viewers count (real-time)
Route::get('/live/{id}/viewers', function ($id) {
    try {
        $liveMatch = LiveMatch::find($id);
        
        if (!$liveMatch) {
            return response()->json(['error' => 'Live match not found'], 404);
        }
        
        // Get cached viewer count
        $viewerCount = Cache::get("live_match_{$id}_viewer_count", $liveMatch->viewer_count);
        
        return response()->json([
            'success' => true,
            'viewer_count' => $viewerCount,
            'is_live' => $liveMatch->isLive()
        ]);
    } catch (\Exception $e) {
        Log::error("Error getting viewers: " . $e->getMessage());
        return response()->json(['error' => 'Server error'], 500);
    }
});
