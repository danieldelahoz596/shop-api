<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        // Iterate over each user
        $users->each(function ($user) {
            $wishlist = $user->wishlists()->first();

            if ($wishlist) {
                $products = Product::inRandomOrder()->take(rand(1, 10))->get();

                foreach ($products as $product) {
                    $wishlist->products()->attach($product->id, ['created_at' => now(), 'updated_at' => now()], $wishlist->id);
                }
            }
        });
    }
}
