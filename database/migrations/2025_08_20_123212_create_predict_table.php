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
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('predict');
    }
};
