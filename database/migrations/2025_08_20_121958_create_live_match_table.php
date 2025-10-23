<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('live_match', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->nullable()->constrained('match')->cascadeOnDelete();
            $table->string('thumbnail')->nullable()->comment('Thumbnail image for live match before streaming');
            $table->string('obs_stream_key')->nullable();
            $table->string('obs_server_url')->nullable();
            $table->tinyInteger('obs_status')->default(0)->comment('0=stopped, 1=starting, 2=live, 3=stopping');
            $table->string('rtmp_url')->nullable()->comment('Generated RTMP URL for OBS');
            $table->integer('viewer_count')->default(0);
            $table->timestamp('start_at')->nullable()->comment('Scheduled start time for live match');
            $table->timestamp('end_at')->nullable()->comment('Scheduled end time for live match');
            $table->timestamp('stream_started_at')->nullable();
            $table->timestamp('stream_ended_at')->nullable();
            $table->text('obs_error_log')->nullable()->comment('OBS error messages');
            $table->tinyInteger("status")->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_match');
    }
};
