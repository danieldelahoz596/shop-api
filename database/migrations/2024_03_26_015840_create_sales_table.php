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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('seller_id')->constrained('users');
            $table->foreignId('buyer_id')->constrained('users');
            $table->foreignId('address_id')->constrained('user_addresses');
            $table->string('transaction_id')->unique()->nullable();
            $table->decimal('item_price', 8, 2);
            $table->integer('item_quantity');
            $table->string('voucher_code')->nullable();
            $table->decimal('voucher_amount', 8, 2)->nullable();
            $table->decimal('shipping_fee', 8, 2)->nullable();
            $table->decimal('total', 8, 2)->nullable();
            $table->string('payment_status')->nullable();
            $table->string('status')->nullable();
            $table->string('mode_of_payment')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
