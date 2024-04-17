<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductDetailsContontroller extends Controller
{
    public function moreFromSeller(Request $request){
        try{
            $data = User::where('id', $request->user_id)
                        ->with('products')
                        ->get();
        }catch(\Throwable $th){
            Log::error("Failed to query to get moreFromSeller on user id " . auth()->id() . " : " . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message' => 'Internal server error failed to get the moreFromSeller' 
            ],500);
        }

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'More Items Data Queried'
        ], 200);
    }

    public function relatedProducts(Request $request){
        try{
            $data = Product::where('product_code', $request->product_code)->first();
    
            $dataList = Product::whereJsonContains('keyword', $data->keyword)
                                ->take(4)
                                ->get();
        }catch(\Throwable $th){
            Log::error("Failed to query to get relatedProducts on user id " . auth()->id() . " : " . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message' => 'Internal server error failed to get the relatedProducts' 
            ],500);
        }

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'More Items Data Queried'
        ], 200);
    }
}
