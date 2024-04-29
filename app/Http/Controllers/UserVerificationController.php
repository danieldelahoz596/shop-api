<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerification;
use Illuminate\Http\Request;

class UserVerificationController extends Controller
{
    public function addSellerVerification(Request $request, User $user)
    {
        $photoFront =  $request->file('photoFront');
        $photoFrontFileName = $request->identification_type . '_front_image.' . $photoFront->getClientOriginalExtension();
        $photoFrontPath = $photoFront->storeAs('images/' . $user->id, $photoFrontFileName, 'public');
        $photoFrontFullPath = asset('storage/' . $photoFrontPath);

        $photoBack =  $request->file('photoBack');
        $photoBackFileName = $request->identification_type . '_back_image.' . $photoBack->getClientOriginalExtension();
        $photoBackPath = $photoBack->storeAs('images/' . $user->id, $photoBackFileName, 'public');
        $photoBackFullPath = asset('storage/' . $photoBackPath);

        $selfiePhoto =  $request->file('selfiePhoto');
        $selfiePhotoFileName = $user->name . '_selfie_image.' . $selfiePhoto->getClientOriginalExtension();
        $selfiePhotoPath = $selfiePhoto->storeAs('images/' . $user->id, $selfiePhotoFileName, 'public');
        $selfiePhotoFullPath = asset('storage/' . $selfiePhotoPath);

        $data = UserVerification::create([
            'user_id' => $user->id,
            'identification_type' => $request->identification_type,
            'photo_front' => $photoFrontFullPath,
            'photo_back' => $photoBackFullPath,
            'selfie_photo' => $selfiePhotoFullPath,
            'video' => null,
            'status' => 'Pending'
        ]);

        return response()->json([
            'status' => true,
            'data' => $data
        ], 201);
    }
}
