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

    public function getSellerProfile(Request $request)
    {
        try{
            $user = Auth::user();
            if(!$user){
                return response()->json([
                    'status'=> 204,
                    'message'=>'No content'
                ], 200);
            }
        }catch(\Throwable $th){
            Log::error('Failed to get the user ' . $th->getMessage());
            return response()->json([
                'status'=>500,
                'message'=>'An error occurred to get user information'
            ], 500);
        }

        if ($user->role_id == 4 && $user->is_seller == 1) {
            $profileData = [
                'id' => $user->id,
                'shop_name' => $user->name,
                'email' => $user->email,
                'is_seller' => $user->is_seller,
            ];

            return response()->json([
                'status'=>200,
                'data'=>$profileData
            ], 200);
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

    public function getSellerProducts(Request $request)
    {
        $seller = Auth::user();
        if(!$seller){
            return response()->json([
                'status'=> 204,
                'message'=>'No content'
            ], 200);
        }

        if ($seller->role_id != 4 || !$seller->is_seller) {
            return Response::json(['error' => 'Unauthorized'], 403);
        }


        $products = $seller->products()->get();
        if(!$products){
            return response()->json([
                'status'=> 204,
                'message'=>'No content'
            ], 200);
        }


        return response()->json([
            'status'=>200,
            'data'=>$products
        ], 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'seller_type' => 'required|in:individual,business',
            'shop_name' => 'required_if:seller_type,individual|max:255',
            'registered_name' => 'required_if:seller_type,business|max:255',
            'tin' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = Auth::user();
        $user->fill($request->only('seller_type', 'shop_name', 'registered_name', 'tin'));
        $user->role_id = 4;
        $user->save();

        return response()->json(['message' => 'Seller registration successful.']);
    }


    public function verifyIdentity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'date_of_birth' => 'required|date',
            'email' => 'required|email',
            'address' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = Auth::user();
        try {
            $user->save();
        } catch (\Exception $e) {
            Log::error('Failed to save seller info: ' . $e->getMessage());
            return response()->json([
                'status'=>500,
                'message' => 'Unable to register seller at this time.'
            ], 500);
        }

        return response()->json(['message' => 'Identity verified']);
    }


    public function submitId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_type' => 'required',
            'front_id' => 'required|image',
            'back_id' => 'required|image',
            'selfie' => 'required|image', // selfie for ID verification
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = Auth::user();
        // this should be saved in the database
        $user->front_id_path = $request->front_id->store('public/ids');
        $user->back_id_path = $request->back_id->store('public/ids');
        $user->selfie_path = $request->selfie->store('public/selfies');
        try {
            $user->save();
        } catch (\Exception $e) {
            Log::error('Failed to submit Id: ' . $e->getMessage());
            return response()->json([
                'status'=>500,
                'message' => 'Unable process submitting Id at this time.'
            ], 500);
        }

        return response()->json(['message' => 'ID submitted']);
    }


    public function reviewApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'date_of_birth' => 'required|date',
            'email' => 'required|email',
            'address' => 'required|max:255',
            'id_type' => 'required',
            'front_id' => 'required|image',
            'back_id' => 'required|image',
            'selfie' => 'required|image',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = Auth::user();

        // file uploads for id and selfie
        if ($request->hasFile('id_photo')) {
            $idPhotoPath = $request->file('id_photo')->store('public/identity_verification');
            // Store $idPhotoPath in the database
        }

        if ($request->hasFile('selfie')) {
            $selfiePath = $request->file('selfie')->store('public/identity_verification');
            // Store $selfiePath in the database
        }

        try {
            $user->save();
        } catch (\Exception $e) {
            Log::error('Failed to save the process for review: ' . $e->getMessage());
            return response()->json([
                'status'=>500,
                'message' => 'Unable to process the submitting of application.'
            ], 500);
        }
        return response()->json(['message' => 'Your application is under review.']);
    }


    public function completeVerification(Request $request)
    {
        $user = Auth::user();
        $user->is_seller = true; // is_verified should be in the database
        $user->save();

        return response()->json(['message' => 'Verification complete']);
    }
}
