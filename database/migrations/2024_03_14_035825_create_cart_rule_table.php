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
        Schema::create('cart_rule', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('table_id')->nullable();
            $table->string('name');
            $table->string('coupon_code')->nullable();
            $table->string('type');
            $table->string('target_table')->nullable();
            $table->string('discount_type');
            $table->decimal('value', 16, 2)->default(0);
            $table->integer('priority')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_rule');
    }
};
