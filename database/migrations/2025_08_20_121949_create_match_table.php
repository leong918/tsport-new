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
        Schema::create('match', function (Blueprint $table) {
            $table->id();
            $table->string('match_title');
            $table->text('short_content')->nullable();
            $table->string('banner');
            $table->tinyInteger("status")->default(1);
            $table->boolean('is_top')->default(false);
            $table->timestamp('start_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match');
    }
};
