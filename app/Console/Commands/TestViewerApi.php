<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestViewerApi extends Command
{
    protected $signature = 'test:viewer-api';
    protected $description = 'Test viewer tracking API endpoints';

    public function handle()
    {
        $this->info('🧪 Testing Viewer Tracking API...');
        $this->newLine();
        
        $baseUrl = config('app.url');
        $matchId = 7; // Use match ID from the screenshot
        
        // Test 1: Join
        $this->info("1️⃣  Testing POST {$baseUrl}/api/live/{$matchId}/join");
        try {
            $response = Http::post("{$baseUrl}/api/live/{$matchId}/join");
            
            $this->line("   Status: {$response->status()}");
            
            if ($response->successful()) {
                $data = $response->json();
                $this->info("   ✅ Success!");
                $this->line("   Viewer Count: " . ($data['viewer_count'] ?? 'N/A'));
            } else {
                $this->error("   ❌ Failed!");
                $this->line("   Response: " . $response->body());
            }
        } catch (\Exception $e) {
            $this->error("   ❌ Exception: " . $e->getMessage());
        }
        
        $this->newLine();
        
        // Test 2: Get Viewers
        $this->info("2️⃣  Testing GET {$baseUrl}/api/live/{$matchId}/viewers");
        try {
            $response = Http::get("{$baseUrl}/api/live/{$matchId}/viewers");
            
            $this->line("   Status: {$response->status()}");
            
            if ($response->successful()) {
                $data = $response->json();
                $this->info("   ✅ Success!");
                $this->line("   Viewer Count: " . ($data['viewer_count'] ?? 'N/A'));
                $this->line("   Is Live: " . ($data['is_live'] ? 'Yes' : 'No'));
            } else {
                $this->error("   ❌ Failed!");
                $this->line("   Response: " . $response->body());
            }
        } catch (\Exception $e) {
            $this->error("   ❌ Exception: " . $e->getMessage());
        }
        
        $this->newLine();
        
        // Test 3: Heartbeat
        $this->info("3️⃣  Testing POST {$baseUrl}/api/live/{$matchId}/heartbeat");
        try {
            $response = Http::post("{$baseUrl}/api/live/{$matchId}/heartbeat");
            
            $this->line("   Status: {$response->status()}");
            
            if ($response->successful()) {
                $this->info("   ✅ Success!");
            } else {
                $this->error("   ❌ Failed!");
                $this->line("   Response: " . $response->body());
            }
        } catch (\Exception $e) {
            $this->error("   ❌ Exception: " . $e->getMessage());
        }
        
        $this->newLine();
        
        // Test 4: Leave
        $this->info("4️⃣  Testing POST {$baseUrl}/api/live/{$matchId}/leave");
        try {
            $response = Http::post("{$baseUrl}/api/live/{$matchId}/leave");
            
            $this->line("   Status: {$response->status()}");
            
            if ($response->successful()) {
                $data = $response->json();
                $this->info("   ✅ Success!");
                $this->line("   Viewer Count: " . ($data['viewer_count'] ?? 'N/A'));
            } else {
                $this->error("   ❌ Failed!");
                $this->line("   Response: " . $response->body());
            }
        } catch (\Exception $e) {
            $this->error("   ❌ Exception: " . $e->getMessage());
        }
        
        $this->newLine();
        $this->info('✅ Tests completed!');
        
        return 0;
    }
}
