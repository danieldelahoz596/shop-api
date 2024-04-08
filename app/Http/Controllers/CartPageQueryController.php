<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartPageQueryController extends Controller
{
    public function loadCart(Request $request)
    {

        if (Auth::check()) {
            $cartItems = Auth::user()->cartItems()->with('product')->get();
            $cartItemsGroupedBySeller = $cartItems->groupBy('product.user_id')->map(function ($group) {
                return collect($group)->map(function ($item) {
                    return [
                        'item_id' => $item->id,
                        'product_name' => $item->product->name,
                        'quantity' => $item->quantity, //idk if the size is included
                        'price' => $item->product->price,
                    ];
                });
            });

            $totalsPerSeller = $cartItemsGroupedBySeller->mapWithKeys(function ($items, $sellerId) {
                $total = $items->reduce(function ($carry, $item) {
                    return $carry + ($item['quantity'] * $item['price']);
                }, 0);
                return [$sellerId => $total];
            });

            $total = $totalsPerSeller->sum();

            return response()->json([
                'status' => 200,
                'cartItems' => $cartItemsGroupedBySeller,
                'totalsPerSeller' => $totalsPerSeller,
                'total' => $total
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'User not authenticated'
            ], 401);
        }
    }

    public function deleteItem(Request $request, $itemId)
    {
        $item = CartItem::where('id', $itemId)
            ->where('user_id', Auth::id())->first();

        if ($item) {
            $item->delete();
            return response()->json(['status' => 200, 'message' => 'Item removed from cart.']);
        } else {
            return response()->json(['status' => 404, 'message' => 'Item not found.'], 404);
        }
    }

    public function checkout()
    {
        if (!Auth::check()) {
            return response()->json(['status' => 401, 'message' => 'You must be logged in to checkout.'], 401);
        }

        $cartItems = Auth::user()->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['status' => 400, 'message' => 'Your cart is empty.'], 400);
        }

        return response()->json(['status' => 200, 'message' => 'Checkout successful.']);
    }
}