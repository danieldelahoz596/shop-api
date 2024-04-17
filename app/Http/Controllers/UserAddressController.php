<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function addAddress(Request $request)
    {
        $data = UserAddress::create([
            'user_id' => $request->user_id,
            'street' => $request->street,
            'city' => $request->city,
            'province' => $request->province,
            'region' => $request->region,
            'zip_code' => $request->zip_code
        ]);

        return response()->json([
            'status' => 201,
            'data' => $data
        ], 201);
    }

    public function updateAddress(Request $request, UserAddress $userAddress)
    {
        $userAddress->update([
            'street' => $request->street,
            'city' => $request->city,
            'province' => $request->province,
            'region' => $request->region,
            'zip_code' => $request->zip_code,
        ]);

        return response()->json([
            'status' => 200,
            'data' => $userAddress
        ], 200);
    }

    public function selectAddress(UserAddress $userAddress)
    {
        $prevDefault = UserAddress::where('user_id', auth()->user()->id)
            ->where('is_default', true)
            ->first();

        $prevDefault->update([
            'is_default' => false
        ]);

        $userAddress->update([
            'is_default' => true
        ]);

        return response()->json([
            'status' => 200,
            'data' => $userAddress
        ], 200);
    }
}
