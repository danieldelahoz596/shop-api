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
            $table->integer('role_id')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('name')->nullable();
            $table->date('birthday')->nullable();
            $table->integer('phone_number')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->integer('address')->nullable();
            $table->boolean('is_deleted')->default(0)->nullable();
            $table->text('email_verify_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('forgot_password_token')->nullable();
            $table->text('uusername')->nullable();
            $table->boolean('ftl')->default(1)->nullable();
            $table->text('profile_picture')->nullable();
            $table->timestamp('lastlogin')->nullable();
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
