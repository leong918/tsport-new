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
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_category_id')->nullable();
            $table->string("name");
            $table->string("image")->nullable();
            $table->tinyInteger("status")->default(0);
            $table->integer("sort")->default(0);
            $table->tinyInteger("is_show_sidebar")->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category');
    }
};
