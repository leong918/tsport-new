<?php

namespace App\Console\Commands;

use App\Models\LiveMatch;
use Illuminate\Console\Command;

class TestStreamApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:stream-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the streaming API functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧪 Testing Streaming API...');
        
        // 创建或获取测试记录
        $liveMatch = LiveMatch::first();
        if (!$liveMatch) {
            $liveMatch = LiveMatch::create([
                'match_id' => 1,
                'obs_stream_key' => 'test_stream_key_' . time(),
                'obs_server_url' => 'rtmp://localhost:1936/live',
                'obs_status' => 0,
                'status' => 1
            ]);
            $this->info("✅ Created new LiveMatch with ID: {$liveMatch->id}");
        }

        $this->line("📊 Current Status: {$liveMatch->obs_status}");

        // 测试 startStream
        $this->info('🚀 Testing startStream()...');
        $result = $liveMatch->startStream();
        $liveMatch->refresh();
        $this->line("Result: " . ($result ? 'SUCCESS' : 'FAILED'));
        $this->line("New status: {$liveMatch->obs_status}");
        $this->line("Stream started at: {$liveMatch->stream_started_at}");

        // 测试 markAsLive
        $this->info('🔴 Testing markAsLive()...');
        $result = $liveMatch->markAsLive();
        $liveMatch->refresh();
        $this->line("Result: " . ($result ? 'SUCCESS' : 'FAILED'));
        $this->line("New status: {$liveMatch->obs_status}");
        $this->line("RTMP URL: {$liveMatch->rtmp_url}");

        // 测试 stopStream
        $this->info('⏹️  Testing stopStream()...');
        $result = $liveMatch->stopStream();
        $liveMatch->refresh();
        $this->line("Result: " . ($result ? 'SUCCESS' : 'FAILED'));
        $this->line("New status: {$liveMatch->obs_status}");
        $this->line("Stream ended at: {$liveMatch->stream_ended_at}");

        $this->info('✅ All tests completed!');
        
        return 0;
    }
}
