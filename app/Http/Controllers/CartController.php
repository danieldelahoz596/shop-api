<?php

namespace App\Http\Controllers;

use App\Events\Notification;
use App\Models\CartItem;
use App\Models\Product;
use App\Traits\NotificationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    //Load the products to cart if has data
    public function cartItems()
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => 401,
                'message' => 'User not authenticated'
            ], 401);
        }

        try {
            $data = CartItem::with('product')
                ->where('user_id', auth()->user()->id)
                ->get();
        } catch (\Exception $e) {
            Log::error("Failed querying to get cart items: " . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Failed to load the cart.'
            ], 500);
        }
        if ($data->isEmpty()) {
            return response()->json([
                'status' => 204,
                'message' => 'Your bag is empty'
            ], 200);
        } else {
            return response()->json([
                'status' => 200,
                'data' => $data
            ], 200);
        }
    }

    //Add product to cart
    public function addToCart(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => 401,
                'message' => 'User not authenticated'
            ], 401);
        }
        try {
            $exists = CartItem::where('product_id', $request->product_id)
                ->exists();
            if ($exists) {
                CartItem::where('product_id', $request->product_id)
                    ->increment('quantity');
                return response()->json([
                    'status' => 200,
                    'message' => 'Item added'
                ], 200);
            } else {
                $data = CartItem::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Item added to cart.',
                    'data' => $data
                ], 201);
            }
        } catch (\Exception $e) {
            Log::error('Error to query add product to cart: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message' => 'Error adding product to cart'
            ], 500);
        }
    }

    //Get the count of product inside the cart
    public function cartCounter()
    {
        try {
            $userId = auth()->user()->id;
            $data = CartItem::where('user_id', $userId)->count();
        } catch(\Exception $e){
            Log::error("Failed querying cart counter for user {$userId}: {$e->getMessage()}");
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error while querying cart counter'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Cart count retrieved successfully',
            'data' => $data
        ], 200);
    }

    // Delete the cart item 
    public function deleteItem($itemId)
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => 401,
                'message' => 'User not authenticated'
            ], 401);
        }
        try{
            $item = CartItem::where('id', $itemId)
            ->where('user_id', auth()->user()->id)
            ->first();
        } catch(\Exception $e){
            Log::error('Failed querying delete cart item: ' . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error while querying delete cart item'
            ], 500);
        }

        if ($item) {
            $item->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Item removed from cart.'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Item not found.'
            ], 404);
        }
    }

}
