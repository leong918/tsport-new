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
            $table->dropColumn([
                'dvr_recordings',
                'dvr_last_uploaded_at',
            ]);
        });
    }
};
