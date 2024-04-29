<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function searchHandle(Request $request){
        try{
            $data = Product::where('product_code', 'LIKE', "%$request->search_query%")
                            ->orWhere('product_name', 'LIKE', "%$request->search_query%")
                            ->orWhere('product_brand', 'LIKE', "%$request->search_query%")
                            ->orWhere(function($query) use ($request) {
                                $query->whereJsonContains('keyword', $request->search_query);
                            })
                            ->get();
        }catch(\Throwable $th){
            Log::error("Failed to query to get searchHandle on user id " . auth()->id() . " : " . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message' => 'Internal server error failed to get the searchHandle'
            ],500);
        }

        $searchData = [];
        $message = 'No Search Results For That Item Search';

        if(count($data) > 1){
            $message = 'Search Results Found';
            $searchData = $data;
        }

        return response()->json([
            'status' => 200,
            'data' => $searchData,
            'message' => $message
        ], 200);
    }
}
