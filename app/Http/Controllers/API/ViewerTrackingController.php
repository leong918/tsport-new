<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LiveMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ViewerTrackingController extends Controller
{
    /**
     * User joins live stream
     */
    public function join(Request $request, $id)
    {
        try {
            $liveMatch = LiveMatch::find($id);
            
            if (!$liveMatch) {
                return response()->json(['error' => 'Live match not found'], 404);
            }
            
            $viewerId = $this->getViewerId($request);
            $cacheKey = "live_match_{$id}_viewer_{$viewerId}";
            $alreadyViewing = Cache::has($cacheKey);
            
            Cache::put($cacheKey, true, now()->addMinutes(5));
            
            if (!$alreadyViewing) {
                $viewerCount = Cache::get("live_match_{$id}_viewer_count", 0);
                $viewerCount++;
                Cache::put("live_match_{$id}_viewer_count", $viewerCount, now()->addMinutes(10));
                
                $liveMatch->viewer_count = $viewerCount;
                $liveMatch->save();
                
                Log::info("New viewer joined live match {$id}: {$viewerId}, total: {$viewerCount}");
            } else {
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
    }

    /**
     * User leaves live stream
     */
    public function leave(Request $request, $id)
    {
        try {
            $liveMatch = LiveMatch::find($id);
            
            if (!$liveMatch) {
                return response()->json(['error' => 'Live match not found'], 404);
            }
            
            $viewerId = $this->getViewerId($request);
            $cacheKey = "live_match_{$id}_viewer_{$viewerId}";
            
            if (Cache::has($cacheKey)) {
                Cache::forget($cacheKey);
                
                $viewerCount = Cache::get("live_match_{$id}_viewer_count", 1);
                $viewerCount = max(0, $viewerCount - 1);
                Cache::put("live_match_{$id}_viewer_count", $viewerCount, now()->addMinutes(10));
                
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
    }

    /**
     * Heartbeat to keep viewer alive
     */
    public function heartbeat(Request $request, $id)
    {
        try {
            $viewerId = $this->getViewerId($request);
            $cacheKey = "live_match_{$id}_viewer_{$viewerId}";
            
            if (Cache::has($cacheKey)) {
                Cache::put($cacheKey, true, now()->addMinutes(5));
            }
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error("Error in heartbeat: " . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    /**
     * Get active viewers count
     */
    public function getViewers($id)
    {
        try {
            $liveMatch = LiveMatch::find($id);
            
            if (!$liveMatch) {
                return response()->json(['error' => 'Live match not found'], 404);
            }
            
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
    }

    /**
     * Generate unique viewer ID
     */
    private function getViewerId(Request $request)
    {
        if (auth('user')->check()) {
            return 'user_' . auth('user')->id();
        }
        
        return md5($request->ip() . $request->userAgent());
    }
}
