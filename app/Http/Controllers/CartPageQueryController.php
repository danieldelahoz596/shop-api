<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;


class CartPageQueryController extends Controller
{

    public function loadCart()
    {
        $user = Auth::user();
        $cartItems = $user->cartItems()->with('product')->get();
        return response()->json([
            'status' => 200,
            'data' => $cartItems,
        ]);
    }

    public function deleteItem($itemId)
    {
        $item = CartItem::where('id', $itemId)
            ->where('user_id', Auth::id())->first();

        if ($item) {
            $item->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Item removed from cart.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Item not found.'
            ]);
        }
    }

    public function checkout()
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 401,
                'message' => 'You must be logged in to checkout.'
            ]);
        }

        $cartItems = Auth::user()->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['status' => 400, 'message' => 'Your cart is empty.'], 400);
        }

        return response()->json(['status' => 200, 'message' => 'Checkout successful.']);
    }
}
