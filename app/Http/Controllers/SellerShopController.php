<?php

namespace App\Http\Controllers;

use App\Models\SellerShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class SellerShopController extends Controller
{
    public function getSellerShop()
    {
        $data = SellerShop::where('user_id', auth()->user()->id)
            ->where('status', 1)
            ->get();

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
            'user_id' => auth()->user()->id,
        ]);

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function updateRating()
    {
        $data = SellerShop::where('user_id', auth()->user()->id)->first();

        $data->increment('rating');

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function updateLike()
    {
        $data = SellerShop::where('user_id', auth()->user()->id)->first();

        $data->increment('like');

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function updateShare()
    {
        $data = SellerShop::where('user_id', auth()->user()->id)->first();

        $data->increment('share');

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function updateViewCount()
    {
        $data = SellerShop::where('user_id', auth()->user()->id)->first();

        $data->increment('view_count');

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }
}
