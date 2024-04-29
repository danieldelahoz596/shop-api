<?php

namespace App\Http\Controllers;

use App\Models\BlockedUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlockedUserController extends Controller
{
    public function getBlockedUsers()
    {
        try{
            $data = BlockedUser::where('user_id', auth()->user()->id)->with('blockedUsers')->paginate(10);
            if($data->isEmpty()){
                return response()->json([
                    'status'=> 204,
                    'message'=> 'No blocked user'
                ], 200);
            }
        }catch(\Throwable $th){
            Log::error('Failed to get blocked users in user_id ' . auth()->id() . ": " . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=>'An error occurred getting blocked users'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function addBlockedUser(Request $request)
    {
        try{
            $data = BlockedUser::create([
                'user_id' => auth()->user()->id,
                'blocked_user_id' => $request->blocked_user_id
            ]);
        }catch(\Throwable $th){
            Log::error('Failed to add blocked users in user_id ' . auth()->id() . ": " . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=>'An error occurred add blocked users'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }
}
