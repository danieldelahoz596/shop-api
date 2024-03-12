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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid();
            $table->integer('user_role_id')->nullable();
            $table->string('user_firstname')->nullable();
            $table->string('user_lastname')->nullable();
            $table->string('user_name')->nullable();
            $table->date('user_birthday')->nullable();
            $table->integer('user_area_code')->nullable();
            $table->integer('user_phone_number')->unique()->nullable();
            $table->string('user_email')->unique()->nullable();
            $table->int('user_address')->nullable();
            $table->int('is_deleted')->nullable();
            $table->text('user_email_verify_token')->nullable();+
            $table->timestamp('email_verified_at')->nullable();
            $table->text('user_forgot_password_token')->nullable();
            $table->text('user_username')->nullable();
            $table->integer('user_ftl')->default(1)->nullable();
            $table->text('user_profile_picture')->nullable();
            $table->timestamp('user_lastlogin')->nullable();
            $table->string('password');
            $table->integer('is_online')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
