<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function wishlist($user_id)
    {

        $user = User::findOrFail($user_id);

        $wishlist= $user->wishlists()->with('products')->first();

        if(!$wishlist){
            return response()->json([
                'status'=>false,
                'message'=> 'Wishlist is empty'
            ], 200);
        }

        $data = [];

        foreach($wishlist->products as $product)
        {
            $data[] = [
                'product_name' => $product->product_name,
                'product_price' => $product->price,
                'product_image'=>$product->image,
                'product_view_count'=>$product->view_count,
                'product_quantity'=>$product->quantity,
                'product_description'=>$product->product_description,
            ];
        }

        return response()->json([
            'status' => true,
            'data' => $data,
        ], 200);
    }

    public function addProductToWishlist(Request $request)
    {
        $userId = $request->user_id;
        $productId = $request->product_id;

        $user = User::findOrFail($userId);
        $wishlist = $user->wishlists()->firstOrCreate([]);
        $product = Product::findOrFail($productId);

        $wishlist->products()->syncWithoutDetaching([$product->id]);

        return response()->json([
            'status'=>true,
            'message'=>"Product added to wishlist successfully"
        ]);
    }

    public function removeProductFromWishlist($userId, $productId)
    {

        $user = User::findOrFail($userId);
        $wishlist = $user->wishlists()->first();
        if($wishlist){
            $wishlist->products()->detach($productId);
            return response()->json([
                'status'=>200,
                'message'=>"Product removed from wishlist successfully"
            ],200);
        }

        return response()->json([
            'status'=> false,
            'message' => 'Wishlist is empty.'
        ], 404);
    }
}
