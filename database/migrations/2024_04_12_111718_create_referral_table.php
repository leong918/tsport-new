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
        Schema::create('referral', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('referrer_user_id');
            $table->bigInteger('referee_user_id');
            $table->bigInteger('referrer_sales_order_id')->nullable();
            $table->bigInteger('referee_sales_order_id')->nullable();
            $table->timestamp('referrer_voucher_used_at')->nullable();
            $table->timestamp('referee_voucher_used_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral');
    }
};
