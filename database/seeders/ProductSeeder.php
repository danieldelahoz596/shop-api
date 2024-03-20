<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = SubCategory::all()->pluck('category_id')->toArray();
        $subCategories = SubCategory::all()->pluck('id')->toArray();
        $brands = Brand::all()->pluck('name')->toArray();
        $images = [
            'brandimg1.jpg',
            'brandimg2.jpg',
            'brandimg3.jpg'
        ];

        $products = [
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'user_id' => 3,
                'product_code' => 'BU1001',
                'product_name' => 'Black Dress',
                'product_description' => 'A black dress',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Black Dress')),
                'price' => 1900,
                'quantity' => 100,
                'keyword' => ['dress', 'tops', 'sportswear'],
                'status' => true,
                'image' => Arr::random($images),
                'is_featured' => true,
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'user_id' => 3,
                'product_code' => 'BU1002',
                'product_name' => 'Blue Dress',
                'product_description' => 'A blue dress',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Blue Dress')),
                'price' => 1800,
                'quantity' => 100,
                'keyword' => ['dress', 'tops', 'bottom'],
                'status' => true,
                'image' => Arr::random($images),
                'is_featured' => true
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'user_id' => 3,
                'product_code' => 'BU1003',
                'product_name' => 'Black Tees',
                'product_description' => 'A black t-shirt',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Black Tees')),
                'price' => 1500,
                'quantity' => 100,
                'keyword' => ['dress', 'tops', 'garments'],
                'status' => true,
                'image' => Arr::random($images),
                'is_featured' => true
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'user_id' => 3,
                'product_code' => 'BU1004',
                'product_name' => 'Green Pants',
                'product_description' => 'A green pants',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Green Pants')),
                'price' => 1700,
                'quantity' => 100,
                'keyword' => ['dress', 'tops', 'sportswear'],
                'status' => true,
                'image' => Arr::random($images),
                'is_featured' => true
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'user_id' => 3,
                'product_code' => 'BU1005',
                'product_name' => 'Orange Jacket',
                'product_description' => 'An orange jacket',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Orange Jacket')),
                'price' => 2000,
                'quantity' => 100,
                'keyword' => ['dress', 'tops', 'garments'],
                'status' => true,
                'image' => Arr::random($images),
                'is_featured' => true
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'user_id' => 3,
                'product_code' => 'BU1006',
                'product_name' => 'Green Underwear',
                'product_description' => 'A green underwear',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Green Underwear')),
                'price' => 2100,
                'quantity' => 100,
                'keyword' => ['dress', 'tops', 'bottom'],
                'status' => true,
                'image' => Arr::random($images),
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'user_id' => 3,
                'product_code' => 'BU1007',
                'product_name' => 'Longsleeve',
                'product_description' => 'A longsleeve',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Longsleeve')),
                'price' => 2800,
                'quantity' => 100,
                'keyword' => ['dress', 'tops', 'sportswear'],
                'status' => true,
                'image' => Arr::random($images),
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'user_id' => 3,
                'product_code' => 'BU1008',
                'product_name' => 'Shorts',
                'product_description' => 'A short',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Shorts')),
                'price' => 2500,
                'quantity' => 100,
                'keyword' => ['dress', 'tops', 'bottom'],
                'status' => true,
                'image' => Arr::random($images),
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'user_id' => 3,
                'product_code' => 'BU1009',
                'product_name' => 'Jeans',
                'product_description' => 'Jeans',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Jeans')),
                'price' => 2900,
                'quantity' => 100,
                'keyword' => ['dress', 'tops', 'garments'],
                'status' => true,
                'image' => Arr::random($images),
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'user_id' => 3,
                'product_code' => 'BU1010',
                'product_name' => 'White Sweater',
                'product_description' => 'A white sweater',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'White Sweater')),
                'price' => 2400,
                'quantity' => 100,
                'keyword' => ['dress', 'tops', 'bottom'],
                'status' => true,
                'image' => Arr::random($images),
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
