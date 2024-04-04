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
        Schema::create('point_log', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('sales_order_id')->nullable();
            $table->bigInteger('used_sales_order_id')->nullable();
            $table->integer("point")->default(0);
            $table->string("type");
            $table->string("remark")->nullable();
            $table->tinyInteger("is_used")->default(0);
            $table->tinyInteger("is_expired")->default(0);
            $table->timestamp("used_at")->nullable();
            $table->timestamp("expired_at")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_log');
    }
};
