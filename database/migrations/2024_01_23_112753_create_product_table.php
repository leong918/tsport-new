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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('brand_id');
            $table->bigInteger('category_id');
            $table->string("name");
            $table->string("sku")->unique();
            $table->string("alias")->unique();
            $table->integer("quantity")->default(0);
            $table->integer("point_value")->default(0);
            $table->tinyInteger("status")->default(0);
            $table->integer("sort")->default(0);
            $table->tinyInteger("is_best_seller")->default(0);
            $table->tinyInteger("is_new")->default(0);
            $table->tinyInteger("is_backorder")->default(0);
            $table->tinyInteger("is_attribute")->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
