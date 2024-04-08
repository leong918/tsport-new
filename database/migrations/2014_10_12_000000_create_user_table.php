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
            $table->bigInteger('level_id');
            $table->bigInteger('country_id')->nullable();
            $table->bigInteger('referral_user_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username', 50);
            $table->string('email')->unique()->nullable();
            $table->string('phone_no');
            $table->timestamp('birth_month')->nullable();
            $table->string('password');
            $table->string('referral_email')->nullable();
            $table->string('referral_phone_no')->nullable();
            $table->integer("point")->default(0);
            $table->tinyInteger("status")->default(0);
            $table->string('address_first_name')->nullable();
            $table->string('address_last_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('address_phone_no')->nullable();
            $table->string('address_email')->nullable();
            $table->string('country')->nullable();
            $table->string('postcode')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->rememberToken();
            $table->timestamp('level_upgrade_at')->nullable();
            $table->timestamp('level_validity')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
