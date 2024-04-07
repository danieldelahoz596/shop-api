<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartItems()
    {
        $data = CartItem::with('product')
            ->where('user_id', 2)
            ->get()
            ->groupBy('product.user_id');

        return response()->json([
            'status' => $data ? true : false,
            'data' => $data
        ], 200);
    }

    public function addToCart(Request $request, $product_id)
    {
        $data = CartItem::create([
            'user_id' => auth()->user()->id,
            'product_id' => $product_id,
            'quantity' => $request->quantity,
            'price' => $request->price
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Item added to cart.',
            'data' => $data
        ], 201);
    }

    public function cartCounter(Request $request)
    {
        $data = CartItem::where('user_id', auth()->user()->id)->get();

        return response()->json([
            'status' => true,
            'message' => 'Item added to cart.',
            'data' => count($data)
        ], 201);
    }
}
