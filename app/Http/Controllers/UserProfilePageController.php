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
        $data = $user;

        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $user->update($request->all());


        return response()->json([
            'status' => 200,
            'message' => 'Profile updated successfully.'
        ]);
    }
}
