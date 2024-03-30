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
            $table->id();
            $table->integer('role_id')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('name')->nullable();
            $table->enum('gender', array('male', 'female', 'prefer not to say'));
            $table->date('birthday')->nullable();
            $table->integer('phone_area_code')->nullable();
            $table->bigInteger('phone_number')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('address')->nullable();
            $table->boolean('is_deleted')->default(0)->nullable();
            $table->text('email_verify_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('forgot_password_token')->nullable();
            $table->integer('otp_code')->nullable();
            $table->text('style_id')->nullable();
            $table->text('category_id')->nullable();
            $table->timestamp('otp_sent_time')->nullable();
            $table->text('username')->nullable();
            $table->boolean('ftl')->default(1)->nullable();
            $table->text('profile_picture')->nullable();
            $table->timestamp('lastlogin')->nullable();
            $table->string('password');
            $table->integer('is_online')->default(1)->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
