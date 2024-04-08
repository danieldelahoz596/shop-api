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
        Schema::create('shop_performances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('sales_total', 20, 2);
            $table->unsignedInteger('orders_count');
            $table->unsignedInteger('engagements_likes');
            $table->unsignedInteger('engagements_shares');
            $table->unsignedInteger('visitors');
            $table->float('conversion_rate', 8, 2);
            $table->float('return_rate', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_performances');
    }
};
