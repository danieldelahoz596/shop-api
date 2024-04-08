<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Wishlist;

class WishlistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        foreach($users as $user)
        {
            $randomProduct = $products->random(6);

            foreach($randomProduct as $product)
            {

                Wishlist::create([
                    'user_id'=> $user->id,
                    'product_id'=>$product->id,
                ]);
            }
        }
    }
}
