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
        Schema::create('sales_order_product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sales_order_id');
            $table->bigInteger('product_id');
            $table->bigInteger('product_attribute_term_id')->nullable();
            $table->string('product_name');
            $table->decimal('price', 16, 2);
            $table->integer('quantity');
            $table->decimal('total_price', 16, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_order_product');
    }
};
