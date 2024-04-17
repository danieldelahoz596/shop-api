<?php

namespace App\Http\Controllers;

use App\Models\SellerShop;
use Illuminate\Http\Request;

class SellerShopController extends Controller
{
    public function getSellerShop()
    {
        $data = SellerShop::where('user_id', auth()->user()->id)->get();

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function addSellerShop(Request $request)
    {
        $this->validate($request, [
            'shop_name' => 'required',
        ]);

        $slug = strtolower(str_replace(' ', '-', $request->shop_name));
        $data = SellerShop::create([
            'shop_name' => $request->shop_name,
            'slug' => $slug,
            'shop_tag' => $request->shop_tag,
            'shop_image' => $request->shop_image,
            'user_id' => auth()->user()->id
        ]);

        return response()->json([
            'status' => 201,
            'data' => $data
        ], 201);
    }
}
