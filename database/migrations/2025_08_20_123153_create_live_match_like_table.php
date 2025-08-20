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
        Schema::create('live_match_like', function (Blueprint $table) {
            $table->id();
            $table->unique(['user_id', 'live_match_comment_id']);
            $table->foreignId('user_id')->nullable()->constrained('user')->cascadeOnDelete();
            $table->foreignId('live_match_comment_id')->nullable()->constrained('live_match_comment')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_match_like');
    }
};
