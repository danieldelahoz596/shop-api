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
            $table->text('shop_tag');
            $table->text('shop_image');
            $table->integer('rating');
            $table->integer('like')->default(0);
            $table->integer('share')->default(0);
            $table->integer('view_count');
            $table->integer('user_id');
            $table->boolean('status');
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
