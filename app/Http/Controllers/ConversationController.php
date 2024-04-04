<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    //Display a listing of the conversations for the authenticated user.
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $conversations = Conversation::where('user_one', $userId)
                                     ->orWhere('user_two', $userId)
                                     ->with(['userOne', 'userTwo'])
                                     ->get();

        return response()->json([
            'status'=>true,
            'data'=>$conversations
        ],200);
    }

    //Store a newly created conversation in storage.
    public function store(Request $request)
    {


        $userId = $request->user()->id;

        // Prevent a user from creating a conversation with themselves
        if ($request->user_two == $userId) {
            return response()->json(['status'=>false,'message' => 'Cannot create a conversation with yourself'], 422);
        }

        // Check if the conversation already exists
        $conversation = Conversation::where(function ($query) use ($userId, $request) {
            $query->where('user_one', $userId)
                  ->where('user_two', $request->user_two);
        })->orWhere(function ($query) use ($userId, $request) {
            $query->where('user_one', $request->user_two)
                  ->where('user_two', $userId);
        })->first();

        if ($conversation) {
            return response()->json(['message' => 'Conversation already exists', 'conversation' => $conversation], 409);
        }
        $conversation = new Conversation([
            'user_one' => $userId,
            'user_two' => $request->user_two,
        ]);

        $conversation->save();

        return response()->json([
            'status'=>true,
            'data'=>$conversation
        ], 201);
    }

    public function show(Request $request, $id)
    {
        $conversation = Conversation::with(['messages', 'userOne', 'userTwo'])->findOrFail($id);

        // Ensure the authenticated user is part of the conversation
        if (!$request->user()->isPartOfConversation($conversation)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($conversation);
    }

}
