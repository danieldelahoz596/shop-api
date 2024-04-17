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
        $user = Auth::user();
        $data = $user;

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
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
            'status' => 200,
            'message' => 'Profile updated successfully.',
            'data' => $user
        ], 200);
    }
}
