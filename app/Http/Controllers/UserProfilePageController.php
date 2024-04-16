<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfilePageController extends Controller
{
    public function getProfile()
    {
        $user = User::with('userAddress')->findOrFail(auth()->user()->id);
        $userData = [
            'id' => $user->id,
            'email' => $user->email,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'name' => $user->name,
            'gender' => $user->gender,
            'birthday' => $user->birthday,
            'phone_area_code' => $user->phone_area_code,
            'phone_number' => $user->phone_number,
            'address' => $user->userAddress,
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
        $user = User::findOrFail(auth()->user()->id);

        $name = $request->firstname .' '. $request->lastname;

        if ($request->hasFile('profile_picture')) {
            $profile =  $request->file('profile_picture');
            $profileName = $name . '_image.' . $profile->getClientOriginalExtension();
            $profilePath = $profile->storeAs('images/' . $user->id, $profileName, 'public');
        }

        $user->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'name' => $name,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'phone_number' => $request->phone_number,
            'profile_picture' => $profilePath ?? null
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully.',
            'data' => $user
        ]);
    }
}
