<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\SellerShop;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 50; $i++){
            $user_id = User::inRandomOrder()->first()->id;
            $product_id = Product::inRandomOrder()->first()->id;
            Review::create([
                'comment'=>fake()->text(50),
                'rating'=>fake()->numberBetween(1,5),
                'user_id'=> $user_id,
                'reviewable_id'=>$product_id,
                'reviewable_type'=>Product::class,
            ]);
        }
        for($i = 0; $i < 50; $i++){
            $user_id = User::inRandomOrder()->first()->id;
            $seller_id = SellerShop::inRandomOrder()->first()->id;
            Review::create([
                'comment'=>fake()->text(50),
                'rating'=>fake()->numberBetween(1,5),
                'user_id'=> $user_id,
                'reviewable_id'=>$seller_id,
                'reviewable_type'=>SellerShop::class,
            ]);
        }
    }
}
