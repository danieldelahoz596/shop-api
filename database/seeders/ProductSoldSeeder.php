<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductSold;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSoldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            $quantity = rand(1, 100);
            $total = $quantity * $product['price'];
            ProductSold::create([
                'product_id' => $product['id'],
                'user_id' => $product['user_id'],
                'item_price' => $product['price'],
                'item_quantity' => $quantity,
                'discount' => 0,
                'total' => $total,
                'mode_of_payment' => 'Gcash'
            ]);
        }
    }
}
