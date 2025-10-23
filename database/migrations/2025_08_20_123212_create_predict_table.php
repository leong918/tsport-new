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
        Schema::create('predict', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->nullable()->constrained('match')->cascadeOnDelete();
            $table->string('character_name');
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger("status")->default(1);
            $table->unsignedInteger('like_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('like_count');
            // Unique index: one match can only have one prediction per character
            $table->unique(['match_id', 'character_name'], 'predict_match_character_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predict');
    }
};
