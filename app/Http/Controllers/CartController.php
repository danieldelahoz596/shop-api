<?php

namespace App\Http\Controllers;

use App\Events\Notification;
use App\Models\CartItem;
use App\Models\Product;
use App\Traits\NotificationTrait;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartItems()
    {
        $data = CartItem::with('product')
            ->where('user_id', auth()->user()->id)
            ->get()
            ->groupBy('product.user_id');

        return response()->json([
            'status' => $data ? 200 : 404,
            'data' => $data
        ], $data ? 200 : 404);
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
            'status' => 201,
            'message' => 'Item added to cart.',
            'data' => $data
        ], 201);
    }

    public function cartCounter(Request $request)
    {
        $data = CartItem::where('user_id', auth()->user()->id)->count();

        return response()->json([
            'status' => 201,
            'message' => 'Item added to cart.',
            'data' => $data
        ], 201);
    }

    public function cartData()
    {
        $cartData = CartItem::where('user_id', auth()->user()->id)->with('product')->get();

        return response()->json([
            'status' => 200,
            'data' => $cartData,
            'message' => 'Found Data'
        ], 200);
    }
}
