<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class ProductDetailsContontroller extends Controller
{
    public function moreFromSeller(Request $request){
        $data = User::where('id', $request->user_id)
                        ->with('products')
                        ->get();

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'More Items Data Queried'
        ], 200);
    }

    public function relatedProducts(Request $request){
        $data = Product::where('product_code', $request->product_code)->first();

        
        $dataList = Product::whereJsonContains('keyword', $data->keyword)
                            ->take(4)
                            ->get();

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'More Items Data Queried'
        ], 200);
    }
}
