<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;

class WishlistController extends Controller
{
    public function wishlist()
    {
        $data = auth()->user()->wishlists;
        return response()->json([
            'status' => true,
            'data' => $data,
        ], 200);
    }

    public function addProductToWishlist($product_id)
    {
        $user = User::find(auth()->user()->id);
        $product = Product::find($product_id);

        $user->wishlists()->attach($product);

        return response()->json([
            'status'=>true,
            'message'=>"Product added to wishlist successfully"
        ],200);
    }

    public function removeProductFromWishlist($product_id)
    {
        $user = User::findOrFail(auth()->user()->id);
        $product = Product::findOrFail($product_id);
        $wishlist = $user->wishlists();

        if($wishlist){
            $wishlist->detach($product);
            return response()->json([
                'status'=>true,
                'message'=>"Product removed from wishlist successfully"
            ],200);
        }

        return response()->json([
            'status'=> false,
            'message' => 'Wishlist is empty.'
        ], 404);
    }
}
