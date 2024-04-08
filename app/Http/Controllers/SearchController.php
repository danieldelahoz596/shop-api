<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function searchHandle(Request $request){

        $data = Product::where('product_code', 'LIKE', "%$request->search_query%")
                            ->orWhere('product_name', 'LIKE', "%$request->search_query%")
                            ->orWhere('product_brand', 'LIKE', "%$request->search_query%")
                            ->orWhere(function($query) use ($request) {
                                $query->whereJsonContains('keyword', $request->search_query);
                            })
                            ->get();

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
