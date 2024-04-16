<?php

namespace Database\Seeders;

use App\Enum\ColorEnum;
use App\Enum\ConditionEnum;
use App\Enum\StyleEnum;
use App\Enum\TagEnum;
use App\Models\Brand;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubsubCategory;
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
        $subSubCategories = SubsubCategory::all()->pluck('id')->toArray();
        $brands = Brand::all()->pluck('name')->toArray();
        $images = [
            'brandimg1.jpg',
            'brandimg2.jpg',
            'brandimg3.jpg'
        ];
        $styles = StyleEnum::values();
        $colors = ColorEnum::values();
        $tags = TagEnum::values();
        $conditions = ConditionEnum::values();

        $products = [
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'sub_subcategory_id' => Arr::random($subSubCategories),
                'user_id' => 3,
                'product_code' => 'BU1001',
                'product_name' => 'Black Dress',
                'product_description' => 'A black dress',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Black Dress')),
                'price' => 1900,
                'quantity' => 100,
                'size' => ['XS', 'S', 'M', 'L', 'XL'],
                'style' => Arr::random($styles),
                'color' => Arr::random($colors),
                'condition' => Arr::random($conditions),
                'keyword' => [Arr::random($tags), Arr::random($tags), Arr::random($tags)],
                'status' => true,
                'image' => '/storage/product_image/product_1.png',
                'shipping_fee' => 35,
                'view_count' => 80,
                'is_featured' => true,
                'like'=> 10,
                'share'=>10,
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'sub_subcategory_id' => Arr::random($subSubCategories),
                'user_id' => 3,
                'product_code' => 'BU1002',
                'product_name' => 'Blue Dress',
                'product_description' => 'A blue dress',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Blue Dress')),
                'price' => 1800,
                'quantity' => 100,
                'size' => ['XS', 'S', 'M', 'L', 'XL'],
                'style' => Arr::random($styles),
                'color' => Arr::random($colors),
                'condition' => Arr::random($conditions),
                'keyword' => [Arr::random($tags), Arr::random($tags), Arr::random($tags)],
                'status' => true,
                'image' => '/storage/product_image/product_2.jpg',
                'shipping_fee' => 35,
                'view_count' => 100,
                'is_featured' => true,
                'like'=> 10,
                'share'=>10,
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'sub_subcategory_id' => Arr::random($subSubCategories),
                'user_id' => 3,
                'product_code' => 'BU1003',
                'product_name' => 'Black Tees',
                'product_description' => 'A black t-shirt',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Black Tees')),
                'price' => 1500,
                'quantity' => 100,
                'size' => ['XS', 'S', 'M', 'L', 'XL'],
                'style' => Arr::random($styles),
                'color' => Arr::random($colors),
                'condition' => Arr::random($conditions),
                'keyword' => [Arr::random($tags), Arr::random($tags), Arr::random($tags)],
                'status' => true,
                'image' => '/storage/product_image/product_3.jpg',
                'shipping_fee' => 35,
                'view_count' => 70,
                'is_featured' => true,
                'like'=> 10,
                'share'=>10,
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'sub_subcategory_id' => Arr::random($subSubCategories),
                'user_id' => 3,
                'product_code' => 'BU1004',
                'product_name' => 'Green Pants',
                'product_description' => 'A green pants',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Green Pants')),
                'price' => 1700,
                'quantity' => 100,
                'size' => ['XS', 'S', 'M', 'L', 'XL'],
                'style' => Arr::random($styles),
                'color' => Arr::random($colors),
                'condition' => Arr::random($conditions),
                'keyword' => [Arr::random($tags), Arr::random($tags), Arr::random($tags)],
                'status' => true,
                'image' => '/storage/product_image/product_4.jpg',
                'shipping_fee' => 35,
                'view_count' => 100,
                'is_featured' => true,
                'like'=> 10,
                'share'=>10,
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'sub_subcategory_id' => Arr::random($subSubCategories),
                'user_id' => 3,
                'product_code' => 'BU1005',
                'product_name' => 'Orange Jacket',
                'product_description' => 'An orange jacket',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Orange Jacket')),
                'price' => 2000,
                'quantity' => 100,
                'size' => ['XS', 'S', 'M', 'L', 'XL'],
                'style' => Arr::random($styles),
                'color' => Arr::random($colors),
                'condition' => Arr::random($conditions),
                'keyword' => [Arr::random($tags), Arr::random($tags), Arr::random($tags)],
                'status' => true,
                'image' => '/storage/product_image/product_5.jpg',
                'shipping_fee' => 35,
                'view_count' => 100,
                'is_featured' => true,
                'like'=> 10,
                'share'=>10,
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'sub_subcategory_id' => Arr::random($subSubCategories),
                'user_id' => 3,
                'product_code' => 'BU1006',
                'product_name' => 'Green Underwear',
                'product_description' => 'A green underwear',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Green Underwear')),
                'price' => 2100,
                'quantity' => 100,
                'size' => ['XS', 'S', 'M', 'L', 'XL'],
                'style' => Arr::random($styles),
                'color' => Arr::random($colors),
                'condition' => Arr::random($conditions),
                'keyword' => [Arr::random($tags), Arr::random($tags), Arr::random($tags)],
                'status' => true,
                'image' => '/storage/product_image/product_6.jpg',
                'shipping_fee' => 35,
                'view_count' => 100,
                'like'=> 10,
                'share'=>10,
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'sub_subcategory_id' => Arr::random($subSubCategories),
                'user_id' => 3,
                'product_code' => 'BU1007',
                'product_name' => 'Longsleeve',
                'product_description' => 'A longsleeve',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Longsleeve')),
                'price' => 2800,
                'quantity' => 100,
                'size' => ['XS', 'S', 'M', 'L', 'XL'],
                'style' => Arr::random($styles),
                'color' => Arr::random($colors),
                'condition' => Arr::random($conditions),
                'keyword' => [Arr::random($tags), Arr::random($tags), Arr::random($tags)],
                'status' => true,
                'image' => '/storage/product_image/product_7.jpg',
                'shipping_fee' => 35,
                'view_count' => 30,
                'like'=> 10,
                'share'=>10,
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'sub_subcategory_id' => Arr::random($subSubCategories),
                'user_id' => 3,
                'product_code' => 'BU1008',
                'product_name' => 'Shorts',
                'product_description' => 'A short',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Shorts')),
                'price' => 2500,
                'quantity' => 100,
                'size' => ['XS', 'S', 'M', 'L', 'XL'],
                'style' => Arr::random($styles),
                'color' => Arr::random($colors),
                'condition' => Arr::random($conditions),
                'keyword' => [Arr::random($tags), Arr::random($tags), Arr::random($tags)],
                'status' => true,
                'image' => '/storage/product_image/product_1.png',
                'shipping_fee' => 35,
                'view_count' => 20,
                'like'=> 10,
                'share'=>10,
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'sub_subcategory_id' => Arr::random($subSubCategories),
                'user_id' => 3,
                'product_code' => 'BU1009',
                'product_name' => 'Jeans',
                'product_description' => 'Jeans',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Jeans')),
                'price' => 2900,
                'quantity' => 100,
                'size' => ['XS', 'S', 'M', 'L', 'XL'],
                'style' => Arr::random($styles),
                'color' => Arr::random($colors),
                'condition' => Arr::random($conditions),
                'keyword' => [Arr::random($tags), Arr::random($tags), Arr::random($tags)],
                'status' => true,
                'image' => '/storage/product_image/product_1.png',
                'shipping_fee' => 35,
                'view_count' => 100,
                'like'=> 10,
                'share'=>10,
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'sub_subcategory_id' => Arr::random($subSubCategories),
                'user_id' => 3,
                'product_code' => 'BU1010',
                'product_name' => 'White Sweater',
                'product_description' => 'A white sweater',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'White Sweater')),
                'price' => 2400,
                'quantity' => 100,
                'size' => ['XS', 'S', 'M', 'L', 'XL'],
                'style' => Arr::random($styles),
                'color' => Arr::random($colors),
                'condition' => Arr::random($conditions),
                'keyword' => [Arr::random($tags), Arr::random($tags), Arr::random($tags)],
                'status' => true,
                'image' => '/storage/product_image/product_1.png',
                'shipping_fee' => 35,
                'view_count' => 40,
                'like'=> 10,
                'share'=>10,
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'sub_subcategory_id' => Arr::random($subSubCategories),
                'user_id' => 3,
                'product_code' => 'BU1011',
                'product_name' => 'Pink Hat',
                'product_description' => 'A pink hat',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Pink Hat')),
                'price' => 2100,
                'quantity' => 100,
                'size' => ['XS', 'S', 'M', 'L', 'XL'],
                'style' => Arr::random($styles),
                'color' => Arr::random($colors),
                'condition' => Arr::random($conditions),
                'keyword' => [Arr::random($tags), Arr::random($tags), Arr::random($tags)],
                'status' => true,
                'image' => '/storage/product_image/product_1.png',
                'shipping_fee' => 35,
                'view_count' => 100,
                'like'=> 10,
                'share'=>10,
            ],
            [
                'category_id' => Arr::random($categories),
                'subcategory_id' => Arr::random($subCategories),
                'sub_subcategory_id' => Arr::random($subSubCategories),
                'user_id' => 3,
                'product_code' => 'BU1012',
                'product_name' => 'Black Pants',
                'product_description' => 'A black pants',
                'product_brand' => Arr::random($brands),
                'slug' => strtolower(str_replace(' ', '-', 'Black Pants')),
                'price' => 1800,
                'quantity' => 100,
                'size' => ['XS', 'S', 'M', 'L', 'XL'],
                'style' => Arr::random($styles),
                'color' => Arr::random($colors),
                'condition' => Arr::random($conditions),
                'keyword' => [Arr::random($tags), Arr::random($tags), Arr::random($tags)],
                'status' => true,
                'image' => '/storage/product_image/product_1.png',
                'shipping_fee' => 35,
                'view_count' => 100,
                'like'=> 10,
                'share'=>10,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
