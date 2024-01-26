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
        Schema::create('product_description', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->string("language");
            $table->string("name");
            $table->longText("information");
            $table->longText("description");
            $table->longText("ingredient");
            $table->longText("usage");
            $table->longText("additional_information");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_description');
    }
};
