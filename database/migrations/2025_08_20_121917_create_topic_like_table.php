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
        Schema::create('topic_like', function (Blueprint $table) {
            $table->id();
            $table->unique(['user_id', 'topic_id']);
            $table->unique(['user_id', 'topic_comment_id']);
            $table->foreignId('user_id')->nullable()->constrained('user')->cascadeOnDelete();
            $table->foreignId('topic_id')->nullable()->constrained('topic')->cascadeOnDelete();
            $table->foreignId('topic_comment_id')->nullable()->constrained('topic')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topic_like');
    }
};
