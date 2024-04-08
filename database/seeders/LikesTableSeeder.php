<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        $users->each(function ($user) use ($products) {
            $productsToLike = $products->random(rand(1, 5));

            $productsToLike->each(function ($products) use ($user) {
                // Prevent duplicate likes for the same products
                if (!$user->likedproducts()->find($products->id)) {
                    $user->likedproducts()->attach($products->id);
                }
            });
        });
    }
}
