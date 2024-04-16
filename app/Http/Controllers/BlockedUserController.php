<?php

namespace App\Http\Controllers;

use App\Models\BlockedUser;
use Illuminate\Http\Request;

class BlockedUserController extends Controller
{
    public function getBlockedUsers()
    {
        $data = BlockedUser::where('user_id', auth()->user()->id)->with('blockedUsers')->paginate(10);

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function addBlockedUser(Request $request)
    {
        $data = BlockedUser::create([
            'user_id' => auth()->user()->id,
            'blocked_user_id' => $request->blocked_user_id
        ]);

        return response()->json([
            'status' => true,
            'data' => $data
        ], 201);
    }
}
