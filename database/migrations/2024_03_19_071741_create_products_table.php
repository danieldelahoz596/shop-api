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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('subcategory_id')->constrained('sub_categories');
            $table->foreignId('sub_subcategory_id')->constrained('sub_subcategories');
            $table->foreignId('user_id')->constrained();
            $table->integer('shop_id')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_name');
            $table->text('product_description')->nullable();
            $table->string('product_brand')->nullable();
            $table->string('slug');
            $table->decimal('price', 8, 2);
            $table->integer('quantity');
            $table->jsonb('size')->nullable();
            $table->string('style')->nullable();
            $table->string('color')->nullable();
            $table->string('condition')->nullable();
            $table->jsonb('keyword')->nullable();
            $table->boolean('status')->default(1);
            $table->string('image')->nullable();
            $table->boolean('listings')->default(0)->nullable();
            $table->integer('like')->default(0);
            $table->integer('view_count')->default(0)->nullable();
            $table->boolean('is_featured')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
