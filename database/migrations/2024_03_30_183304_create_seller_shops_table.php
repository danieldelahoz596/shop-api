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
        Schema::create('seller_shops', function (Blueprint $table) {
            $table->id();
            $table->text('shop_name');
            $table->text('slug');
            $table->text('shop_tag')->nullable();
            $table->text('shop_image')->nullable();
            $table->integer('rating')->default(0);
            $table->integer('like')->default(0);
            $table->integer('share')->default(0);
            $table->integer('view_count')->default(0);
            $table->integer('user_id');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_shops');
    }
};
