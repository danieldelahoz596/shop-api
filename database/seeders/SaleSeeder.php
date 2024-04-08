<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            $quantity = rand(1, 100);
            Sale::create([
                'product_id' => $product->id,
                'seller_id' => $product->user->id,
                'buyer_id' => 4,
                'address_id' => 1,
                'item_price' => $product->price,
                'item_quantity' => $quantity,
                'voucher_code' => null,
                'voucher_amount' => null,
                'shipping_fee' => $product->shipping_fee,
                'total' => $quantity * $product->price,
                'status' => 'Delivered',
                'payment_status' => 'Paid',
                'mode_of_payment' => 'Gcash'
            ]);
        }
    }
}
