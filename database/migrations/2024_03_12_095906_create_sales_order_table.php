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
        Schema::create('sales_order', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('address_id');
            $table->string('sales_order_id');
            $table->decimal('subtotal', 16, 2)->default(0);
            $table->decimal('shipping', 16, 2)->default(0);
            $table->decimal('discount', 16, 2)->default(0);
            $table->decimal('total', 16, 2)->default(0);
            $table->integer('point');
            $table->tinyInteger('status');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name')->nullable();
            $table->string('phone_no');
            $table->string('email');
            $table->string('country');
            $table->string('postcode');
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_order');
    }
};
