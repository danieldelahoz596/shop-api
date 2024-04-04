<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request, $conversationId)
    {
        $conversation = Conversation::findOrFail($conversationId);

        if (!$request->user()->isPartOfConversation($conversation)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $message = $conversation->messages()->create([
            'text' => $request->text,
            'user_id' => Auth::id(),
            'read' => false,
        ]);

        //TODO: For realtime



        return response()->json([
            'status'=>true,
            'message'=>$message
        ], 201);
    }

    // Retrieve messages from a conversation
    public function index(Request $request, $conversationId)
    {
        $conversation = Conversation::findOrFail($conversationId);

        if (!$request->user()->isPartOfConversation($conversation)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $messages = $conversation->messages()
                                ->with('user')
                                ->get();

        return response()->json([
            'status'=>true,
            'messages'=>$messages
        ], 200);
    }

    // Show a specific message
    public function show(Request $request,$conversationId, $messageId)
    {
        $message = Message::where('conversation_id', $conversationId)
                            ->findOrFail($messageId);

        if (!$request->user()->isPartOfConversation($message->conversation)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json([
            'status'=>true,
            'message'=>$message
        ], 201);
    }


}
