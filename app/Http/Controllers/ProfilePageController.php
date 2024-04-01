<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class ProfilePageController extends Controller
{
    public function wishlist($user_id)
    {
        $userWishlistItems = Wishlist::with('product')->where('user_id', $user_id)->get();
        
        $data = [];

        foreach($userWishlistItems as $item)
        {
            $data[] = [
                'product_name' => $item->product->product_name,
                'product_price' => $item->product->price,
                'like' => $item->like,
            ];
        }

        return response()->json([
            'status' => true,
            'data' => $data,
        ], 200);
    }
}
