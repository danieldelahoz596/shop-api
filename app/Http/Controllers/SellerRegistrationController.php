<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class SellerRegistrationController extends Controller
{
    // Inside SellerRegistrationController.php
    public function getSellerProfile(Request $request)
    {
        $user = Auth::user();

        $profileData = [
            'id' => $user->id,
            'shop_name' => $user->name,
            'email' => $user->email,
            'is_seller' => $user->is_seller,

        ];

        return response()->json($profileData, 200);
    }

    public function getSellerProducts(Request $request)
    {
        $seller = Auth::user();


        if ($seller->role_id != 4 || !$seller->is_seller) {
            return Response::json(['error' => 'Unauthorized - User is not a verified seller'], 403);
        }


        $products = $seller->products()->get();


        return Response::json($products, 200);
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
        $user->save();

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
        $user->save();

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


        $user->save();
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