<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\LiveMatch;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('get_captcha', function (\Mews\Captcha\Captcha $captcha) {
    return $captcha->src('flat');
})->name('captcha');

// SRS Callback for IP-based access (without domain restriction)
Route::post('/srs-callback', function (Request $request) {
    $action = $request->input('action');
    $stream = $request->input('stream');
    
    Log::info('SRS Callback (web route) received', [
        'action' => $action,
        'stream' => $stream,
        'client_id' => $request->input('client_id'),
        'ip' => $request->input('ip')
    ]);
    
    if (!$stream) {
        return response()->json(['code' => 0]);
    }
    
    $liveMatch = LiveMatch::where('obs_stream_key', $stream)->first();
    
    if (!$liveMatch) {
        Log::warning('SRS Callback (web): Live match not found', ['stream' => $stream]);
        return response()->json(['code' => 0]);
    }
    
    switch ($action) {
        case 'on_publish':
            $liveMatch->obs_status = 2; // Live
            $liveMatch->stream_started_at = now();
            $liveMatch->save();
            
            Log::info('Stream started (web callback)', [
                'live_match_id' => $liveMatch->id,
                'stream_key' => $stream
            ]);
            break;
            
        case 'on_unpublish':
            $liveMatch->obs_status = 0; // Offline  
            $liveMatch->stream_ended_at = now();
            $liveMatch->save();
            
            Log::info('Stream ended (web callback)', [
                'live_match_id' => $liveMatch->id,
                'stream_key' => $stream
            ]);
            break;
    }
    
    return response()->json(['code' => 0]);
});

// Live streaming helper routes
require_once 'debug-stream.php';

// Main application routes
require_once 'web/app.php';
require_once 'admin/app.php';
