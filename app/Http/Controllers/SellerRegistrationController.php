<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class SellerRegistrationController extends Controller
{

    public function getSellerProfile()
    {
        try{
            $user = User::findOrFail(auth()->user()->id);
            if(!$user){
                return response()->json([
                    'status'=> 204,
                    'message'=>'No content'
                ], 200);
            }

            if ($user->role_id == 4 && $user->is_seller == 1) {
                $profileData = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'shop_name' => $user->sellerShop->shop_name,
                    'email' => $user->email,
                    'is_seller' => $user->is_seller,
                ];

                return response()->json([
                    'status' => 200,
                    'data' => $profileData
                ], 200);
            }
        }catch(\Throwable $th){
            Log::error('Failed to get the user ' . $th->getMessage());
            return response()->json([
                'status'=>500,
                'message'=>'An error occurred to get user information'
            ], 500);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function getSellerOrders(Request $request)
    {
        try{
            $user = Auth::user();

            if ($user->role_id !== 4 || !$user->is_seller) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            $productIds = Product::where('user_id', $user->id)->pluck('id');

            $orders = Order::whereHas('orderItems', function ($query) use ($productIds) {
                $query->whereIn('product_id', $productIds);
            })
                ->with(['orderItems' => function ($query) use ($productIds) {
                    $query->whereIn('product_id', $productIds)
                        ->with('product');
                }])
                ->get();
        }catch(\Throwable $th){
            Log::error('Failed to get seller orders due to server error. ' . $th->getMessage());
            return response()->json([
                'status'=>500,
                'message'=>'Failed to get seller orders due to server error'
            ], 500);
        }

        $ordersData = $orders->map(function ($order) {
            return [
                'order_id' => $order->id,
                'total' => $order->total,
                'created_at' => $order->created_at->toDateTimeString(),
                'items' => $order->orderItems->map(function ($item) {
                    return [
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                    ];
                }),
            ];
        });

        return response()->json([
            'status'=>200,
            'data'=>$ordersData
        ], 200);
    }

    public function completeVerification(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        $user->is_verified = true; // is_verified should be in the database
        $user->save();

        return response()->json(['message' => 'Verification complete']);
    }
}
