<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SellerShop;
use App\Enum\TagEnum;
use App\Models\Brand;
use Illuminate\Support\Arr;

class SellerShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = TagEnum::values();
        $brands = Brand::all()->pluck('name')->toArray();

        $styles = [
            [
                'shop_name' => Arr::random($brands),
                'slug' => Arr::random($brands),
                'shop_tag' => Arr::random($tags),
                'shop_image' => '/storage/shop_image/shop_1.png',
                'view_count' => 100,
                'user_id' => 4,
                'rating' => 32,
                'status' => 1,
            ],
            [
                'shop_name' => Arr::random($brands),
                'slug' => Arr::random($brands),
                'shop_tag' => Arr::random($tags),
                'shop_image' => '/storage/shop_image/shop_2.png',
                'view_count' => 100,
                'user_id' => 5,
                'rating' => 126,
                'status' => 1,
            ],
            [
                'shop_name' => Arr::random($brands),
                'slug' => Arr::random($brands),
                'shop_tag' => Arr::random($tags),
                'shop_image' => '/storage/shop_image/shop_3.png',
                'view_count' => 100,
                'user_id' => 6,
                'rating' => 45,
                'status' => 1,
            ],
            [
                'shop_name' => Arr::random($brands),
                'slug' => Arr::random($brands),
                'shop_tag' => Arr::random($tags),
                'shop_image' => '/storage/shop_image/shop_4.png',
                'view_count' => 100,
                'user_id' => 7,
                'rating' => 97,
                'status' => 1,
            ],
        ];

        foreach ($styles as $value) {
            SellerShop::create($value);
        }
    }
}
