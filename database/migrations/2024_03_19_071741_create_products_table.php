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
            $table->foreignId('user_id')->constrained();
            $table->string('product_code')->unique();
            $table->string('product_name');
            $table->text('product_description')->nullable();
            $table->string('product_brand')->nullable();
            $table->string('slug');
            $table->integer('price');
            $table->integer('quantity');
            $table->jsonb('keyword');
            $table->boolean('status');
            $table->string('image')->nullable();
            $table->boolean('is_featured')->default(0)->nullable();
            $table->string('keyword_index')->virtualAs('json_unquote(json_extract(keyword, "$.yourKey"))')->index('keyword_index');
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
