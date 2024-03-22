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
        Schema::create('product_solds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->integer('item_price');
            $table->integer('item_quantity');
            $table->string('item_size')->nullable();
            $table->decimal('discount', 8, 2)->nullable();
            $table->string('voucher_code')->nullable();
            $table->decimal('voucher_amount', 8, 2)->nullable();
            $table->decimal('total', 8, 2);
            $table->string('mode_of_payment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_solds');
    }
};
