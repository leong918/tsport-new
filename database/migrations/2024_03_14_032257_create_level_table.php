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
        Schema::create('level', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("leveling");
            $table->decimal('extend_amount', 16, 2);
            $table->decimal('target_amount', 16, 2);
            $table->tinyInteger('can_earn_point')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level');
    }
};
