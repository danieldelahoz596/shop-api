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
        Schema::create('user_logs', function (Blueprint $table) {
            $table->id();
            $table->text('log_user_id')->nullable();
            $table->text('log_device_name')->nullable();
            $table->text('log_browser')->nullable();
            $table->text('log_ipaddress')->nullable();
            $table->text('log_page_visit')->nullable();
            $table->text('log_country')->nullable();
            $table->text('log_city')->nullable();
            $table->text('log_state')->nullable();
            $table->text('log_postal_code')->nullable();
            $table->text('log_type')->nullable();
            $table->text('log_description')->nullable();
            $table->text('log_name')->nullable();
            $table->boolean('is_deleted')->default(0)->nullable();
            $table->text('log_latitude')->nullable();
            $table->text('log_longitude')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_logs');
    }
};
