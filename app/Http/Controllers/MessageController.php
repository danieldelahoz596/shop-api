<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    //Sending a message
    public function store(Request $request, $conversationId)
    {
        $conversation = Conversation::findOrFail($conversationId);
        $image = null;

        if (!$request->user()->isPartOfConversation($conversation)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        
        if($request->hasFile('image')){
            $image = $request->file('image')->store('messages/images', 'public');
        }

        $message = $conversation->messages()->create([
            'text' => $request->text,
            'sender_id' => Auth::id(),
            'receiver_id'=> $conversation->receiver_id,
            'read' => false,
            'image'=>$image,
        ]);

        //TODO: For realtime
        event(new MessageSent(auth()->user(), $message, $conversation, auth()->user()));


        return response()->json([
            'status'=>true,
            'data'=>$message
        ], 200);
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



}
