<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfilePageController extends Controller
{
    public function getProfile()
    {
        $user = Auth::user();
        $userData = [
            'id' => $user->id,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'username' => $user->username,
            'address' => $user->address,
            'profile_picture' => $user->profile_picture ? Storage::url($user->profile_picture) : asset('assets/img/public_profile/Vector.jpg'),
        ];

        $profileData = [
            'reviews' => [
                'rating' => 4.8, // this should be rating in the db
                'count' => 4,    // this should be count in the db
            ],
            'followers' => 4,  // this should be followers in the db
            'following' => 8,  // this should be following in the db
        ];

        return response()->json([
            'user' => $userData,
            'profile' => $profileData
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $user->update($request->all());
        return response()->json(['message' => 'Profile updated successfully.']);
    }
}