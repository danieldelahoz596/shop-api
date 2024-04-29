<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = Product::all()->pluck('id')->toArray();
        $user = User::all()->pluck('id')->toArray();

        $carts = [
            [
                'user_id' => Arr::random($user),
                'product_id' => Arr::random($product),
                'quantity' => random_int(0, 100),
                'price' => random_int(100, 200),
            ],
            [
                'user_id' => Arr::random($user),
                'product_id' => Arr::random($product),
                'quantity' => random_int(0, 100),
                'price' => random_int(100, 200),
            ],
            [
                'user_id' => Arr::random($user),
                'product_id' => Arr::random($product),
                'quantity' => random_int(0, 100),
                'price' => random_int(100, 200),
            ],
            [
                'user_id' => Arr::random($user),
                'product_id' => Arr::random($product),
                'quantity' => random_int(0, 100),
                'price' => random_int(100, 200),
            ],
            [
                'user_id' => Arr::random($user),
                'product_id' => Arr::random($product),
                'quantity' => random_int(0, 100),
                'price' => random_int(100, 200),
            ],
        ];

        foreach($carts as $cart){
            CartItem::create($cart);
        }
    }
}
