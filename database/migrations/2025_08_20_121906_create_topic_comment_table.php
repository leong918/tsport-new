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
        Schema::create('topic_comment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')->nullable()->constrained('topic')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('user')->cascadeOnDelete();
            $table->string('comment');
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
        Schema::dropIfExists('topic_comment');
    }
};
