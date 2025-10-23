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
        Schema::table('live_match', function (Blueprint $table) {
            // Drop old individual DVR fields
            $table->dropColumn([
                'dvr_filename',
                'dvr_file_url',
                'dvr_file_size',
                'dvr_recording_started_at',
                'dvr_recording_ended_at',
                'dvr_uploaded_at',
            ]);
            
            // Add new JSON field for multiple recordings
            $table->json('dvr_recordings')->nullable()->comment('Array of all DVR recording files with metadata');
            $table->timestamp('dvr_last_uploaded_at')->nullable()->comment('When last recording was uploaded');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('live_match', function (Blueprint $table) {
            // Drop new JSON fields
            $table->dropColumn([
                'dvr_recordings',
                'dvr_last_uploaded_at',
            ]);
            
            // Restore old individual DVR fields
            $table->string('dvr_filename')->nullable()->comment('Latest DVR recording filename');
            $table->string('dvr_file_url')->nullable()->comment('DigitalOcean Spaces URL for latest recording');
            $table->bigInteger('dvr_file_size')->nullable()->comment('File size in bytes');
            $table->timestamp('dvr_recording_started_at')->nullable()->comment('When DVR recording started');
            $table->timestamp('dvr_recording_ended_at')->nullable()->comment('When DVR recording ended');
            $table->timestamp('dvr_uploaded_at')->nullable()->comment('When uploaded to DigitalOcean Spaces');
        });
    }
};
