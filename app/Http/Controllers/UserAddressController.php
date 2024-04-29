<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserAddressController extends Controller
{

    public function getAddress(){

        try{
            $data = UserAddress::where('user_id', auth()->user()->id)
                            ->get();
        }catch(\Throwable $th){
            Log::error('Failed to get all address for user_id ' . auth()->id() . ": " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while getting all the address'
            ], 500);
        }

        return response()->json([
            'status'=> 200,
            'data'=> $data
        ], 200);
    }

    public function addAddress(Request $request)
    {
        try {
            $data = UserAddress::create([
                'user_id' => auth()->user()->id,
                'street' => $request->street,
                'city' => $request->city,
                'province' => $request->province,
                'region' => $request->region,
                'zip_code' => $request->zip_code
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 403,
                'message' => 'Validation failed. Please check input '
            ], 403);
        } catch (\Throwable $th) {
            Log::error('Failed addding address on user_id ' . auth()->id() . ": " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while adding address'
            ], 500);
        }

        return response()->json([
            'status' => 201,
            'data' => $data
        ], 201);
    }

    public function updateAddress(Request $request, UserAddress $userAddress)
    {
        try {
            $userAddress->update([
                'street' => $request->street,
                'city' => $request->city,
                'province' => $request->province,
                'region' => $request->region,
                'zip_code' => $request->zip_code,
            ]);
        } catch (\Throwable $th) {
            Log::error('Failed updating address on user_id ' . auth()->id() . ": " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while updating address'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $userAddress
        ], 200);
    }

    public function selectAddress(UserAddress $userAddress)
    {
        try {
            $prevDefault = UserAddress::where('user_id', auth()->user()->id)
                ->where('is_default', true)
                ->first();

            $prevDefault->update([
                'is_default' => false
            ]);

            $userAddress->update([
                'is_default' => true
            ]);
        } catch (\Throwable $th) {
            Log::error('Failed selecting address on user_id ' . auth()->id() . ": " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while selecting address'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $userAddress
        ], 200);
    }

    public function deleteAddress(UserAddress $userAddress)
    {
        try{
            $userAddress->delete();
        }catch(\Throwable $th){
            Log::error('Failed deleting address on user_id ' . auth()->id() . ": " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while deleting address'
            ], 500);
        }

        return response()->json([
            'status'=>200,
            'message'=> 'Address removed.'
        ], 200);
    }
}
