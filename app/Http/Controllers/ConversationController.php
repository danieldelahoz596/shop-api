<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConversationController extends Controller
{
    //Display a listing of the conversations for the authenticated user.
    public function getAllConversation(Request $request)
    {
        try{
            $userId = $request->user()->id;
            $conversations = Conversation::where('sender_id', $userId)
                                        ->orWhere('receiver_id', $userId)
                                        ->with(['sender', 'receiver'])
                                        ->get();

            return response()->json([
                'status'=>true,
                'data'=>$conversations
            ],200);
        }catch (\Throwable $th) {
            Log::error('Failed to fetch conversations: ' . $th->getMessage());
            return response()->json(['status' => 500, 'message' => 'Failed to fetch conversations'], 500);
        }
    }

    //Store a newly created conversation in storage.
    public function createNewConversation(Request $request)
    {
        $userId = $request->user()->id;

        // Prevent a user from creating a conversation with themselves
        if ($request->receiver_id == $userId) {
            return response()->json(['status'=>false,'message' => 'Cannot create a conversation with yourself'], 422);
        }

        // try{
            // Check if the conversation already exists
            $conversation = Conversation::where(function ($query) use ($userId, $request) {
                $query->where('sender_id', $userId)
                    ->where('receiver_id', $request->receiver_id);
            })->orWhere(function ($query) use ($userId, $request) {
                $query->where('sender_id', $request->receiver_id)
                    ->where('receiver_id', $userId);
            })->first();

            if ($conversation) {
                $message = new Message();
                $message->sender_id = $userId;
                $message->receiver_id = $request->receiver_id;
                $message->text = $request->text;
                $message->type = $request->type;
                $message->conversation_id = $conversation->id;
                if ($request->has('image')) {
                    $files = $request->image;
                    $file_name_original =  $files->getClientOriginalName();
                    $file_name = $file_name_original . "." . $files->getClientOriginalExtension();
                    $files->move('storage/images/', $file_name);
                    $image = url('/') . '/' . 'storage/images/' . $file_name;
                    $message->image = $image;

                }
                $message->save();
                return response()->json(['message' => 'Conversation already exists', 'conversation' => $conversation], 409);
            }
            $conversation = new Conversation([
                'sender_id' => $userId,
                'receiver_id' => $request->receiver_id,
            ]);

            $conversation->save();
            $message = new Message([
                'sender_id' => $userId,
                'receiver_id' => $request->receiver_id,
                'text' => $request->text,
                'type' => $request->type,
                'conversation_id' => $conversation->id,
            ]);
            if ($request->has('image')) {
                $files = $request->image;
                $file_name_original =  $files->getClientOriginalName();
                $file_name = $file_name_original . "." . $files->getClientOriginalExtension();
                $files->move('storage/images/', $file_name);
                $image = url('/') . '/' . 'storage/images/' . $file_name;

                $message->image = $image;
            }
            $message->save();

            return response()->json([
                'status'=>true,
                'message'=>'Conversation Successfully created'
            ], 200);
        // }catch (\Throwable $th) {
        //     Log::error('Failed to create conversations: ' . $th->getMessage());
        //     return response()->json(['status' => 500, 'message' => 'Failed to create conversations'], 500);
        // }
    }

    public function getSpecificConversation(Request $request, $id)
    {
        try{
            $conversation = Conversation::with(['messages', 'sender', 'receiver'])->findOrFail($id);
            // Ensure the authenticated user is part of the conversation
            if (!$request->user()->isPartOfConversation($conversation)) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            return response()->json([
                'status'=>200,
                'data'=>$conversation
            ],200);
        }catch (\Throwable $th) {
            Log::error('Failed to fetch specific conversation: ' . $th->getMessage());
            return response()->json(['status' => 500, 'message' => 'Failed to fetch specific conversation'], 500);
        }
    }

}
