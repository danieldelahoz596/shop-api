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
                            ->get();

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'More Items Data Queried'
        ], 200);
    }
}
