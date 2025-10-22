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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('phone_no');
            $table->date('dob')->nullable();
            $table->string('status');
            $table->string('referral_code')->unique();
            $table->foreignId('referred_user_id')->nullable()->constrained('user')->nullOnDelete();
            
            // Jersey customization fields
            $table->string('jersey_name', 3)->nullable()->comment('Jersey name (max 3 characters)');
            $table->string('jersey_number', 2)->nullable()->comment('Jersey number (00-99, accepts zero leading)');
            $table->tinyInteger('jersey_main_color')->nullable()->default(10)->comment('Main color number (0-11)');
            $table->tinyInteger('jersey_sec_color')->nullable()->default(0)->comment('Secondary color number (0-11)');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
