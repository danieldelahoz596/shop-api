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
        try {
            $data = SellerShop::where('user_id', auth()->user()->id)->get();
        } catch (\Throwable $th) {
            Log::error("Failed to get the seller shop info: " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred getting the seller shop info'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function addSellerShop(Request $request)
    {
        try {
            $this->validate($request, [
                'shop_name' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 400,
                'message' => "Validation failed. Please try again"
            ], 400);
        }
        try {
            $slug = strtolower(str_replace(' ', '-', $request->shop_name));
            $data = SellerShop::create([
                'shop_name' => $request->shop_name,
                'slug' => $slug,
                'shop_tag' => $request->shop_tag,
                'shop_image' => $request->shop_image,
                'user_id' => auth()->user()->id
            ]);
        } catch (\Throwable $th) {
            Log::error('Failed to add seller shop: ' . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while adding seller shop'
            ], 500);
        }
        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }
}
