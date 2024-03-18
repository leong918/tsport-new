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
        Schema::create('level_change_log', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('level_id');
            $table->bigInteger('new_level_id');
            $table->bigInteger('sales_order_id')->nullable();
            $table->string("remark")->nullable();
            $table->timestamp('previous_validity')->nullable();
            $table->timestamp('current_validity')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upgrade_level_log');
    }
};
