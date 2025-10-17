<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LiveMatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TestStreamStatusApi extends Command
{
    protected $signature = 'test:stream-status-api';
    protected $description = 'Test the /api/streams/status endpoint';

    public function handle()
    {
        $this->info('🧪 Testing /api/streams/status API endpoint...');
        
        // Get first live match
        $liveMatch = LiveMatch::first();
        
        if (!$liveMatch) {
            $this->error('❌ No LiveMatch found in database!');
            return 1;
        }
        
        $this->info("📺 Using LiveMatch ID: {$liveMatch->id}");
        $this->info("🔑 Stream Key: {$liveMatch->obs_stream_key}");
        $this->info("📊 Current obs_status: {$liveMatch->obs_status}");
        $this->newLine();
        
        // Test 1: Set stream to LIVE
        $this->info('▶️  Test 1: Setting stream status to LIVE...');
        $response = Http::post('http://localhost:8000/api/streams/status', [
            'stream_key' => $liveMatch->obs_stream_key,
            'status' => 'live'
        ]);
        
        $this->info("Response Status: {$response->status()}");
        $this->info("Response Body: " . $response->body());
        
        // Check database
        $dbStatus = DB::table('live_match')->where('id', $liveMatch->id)->value('obs_status');
        $this->info("Database obs_status after 'live': {$dbStatus}");
        
        if ($dbStatus == 2) {
            $this->info("✅ Status correctly updated to LIVE (2)");
        } else {
            $this->error("❌ Status NOT updated! Still: {$dbStatus}");
        }
        
        $this->newLine();
        
        // Test 2: Set stream to ENDED
        $this->info('⏹️  Test 2: Setting stream status to ENDED...');
        $response = Http::post('http://localhost:8000/api/streams/status', [
            'stream_key' => $liveMatch->obs_stream_key,
            'status' => 'ended'
        ]);
        
        $this->info("Response Status: {$response->status()}");
        $this->info("Response Body: " . $response->body());
        
        // Check database
        $dbStatus = DB::table('live_match')->where('id', $liveMatch->id)->value('obs_status');
        $this->info("Database obs_status after 'ended': {$dbStatus}");
        
        if ($dbStatus == 0) {
            $this->info("✅ Status correctly updated to OFFLINE (0)");
        } else {
            $this->error("❌ Status NOT updated! Still: {$dbStatus}");
        }
        
        $this->newLine();
        $this->info('✅ All API tests completed!');
        
        return 0;
    }
}
