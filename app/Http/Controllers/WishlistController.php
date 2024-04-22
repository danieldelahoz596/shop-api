<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{
    //Get all wishlist of a user
    public function wishlist()
    {
        try{
            $data = Wishlist::with('product')->where('user_id', auth()->user()->id)->paginate(10);
        } catch(\Exception $e){
            //For logging
            Log::error('Error getting all product to wishlist: ' . $e->getMessage());

            return response()->json([
                'status'=>500,
                'message'=>'Failed getting all wishlist'
            ], 500);
        }
        if($data->isEmpty()){
            return response()->json([
                'status' => 200,
                'message'=> 'Wishlist is empty'
            ], 200);
        }

        return response()->json([
            'status' => 200,
            'data' => $data,
        ], 200);
    }

    //adding a product to a user by clicking like button
    public function addProductToWishlist(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => 401,
                'message' => 'User not authenticated'
            ], 401);
        }
        try{
            $exists = Wishlist::where('user_id', auth()->user()->id)
                                ->where('product_id', $request->product_id)
                                ->exists();
            if($exists){
                return response()->json([
                    'status'=>409,
                    'message'=>'Product already in wishlist'
                ], 409);
            }

            $data = Wishlist::create([
                'user_id' => auth()->user()->id,
                'product_id' => $request->product_id,
            ]);
    
            Product::where('id', $request->product_id)->increment('like');
    
            return response()->json([
                'status' => 200,
                'message' => 'Product added to wishlist successfully',
                'data' => $data
            ], 200);
        } catch(\Exception $e) {

            //For logging
            Log::error('Error adding product to wishlist: ' . $e->getMessage());

            return response()->json([
                'status'=>500,
                'message'=> 'Failed to add the product to the wishlist.'
            ], 500);
        }
    }

    //Remove a produt on the wishlist
    public function removeProductFromWishlist(Request $request)
    {
        try{
            $user = User::findOrFail(auth()->user()->id);
            $product = Product::findOrFail($request->product_id);
            $wishlist = $user->wishlists();
    
            if($wishlist){
                $wishlist->detach($product);
                $product->decrement('like');
                return response()->json([
                    'status'=>true,
                    'message'=>"Product removed from wishlist successfully"
                ],200);
            }
    
            return response()->json([
                'status'=> false,
                'message' => 'Wishlist is empty.'
            ], 404);
        } catch(\Exception $e){
            //For logging
            Log::error('Error deleting product to wishlist: ' . $e->getMessage());

            return response()->json([
                'status'=>500,
                'message'=>'Failed to remove a product'
            ], 500);
        }
    }
}
