<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class ChatBox extends Component
{
    public $selectedConversation;
    public $receiver;
    public $messages_count;
    public $receiverInstance;
    public $messages;
    public $height;
    public $paginateVar = 10;
    protected $listeners=['loadConversation', 'pushMessage', 'loadmore', 'updateHeight'];

    public function pushMessage($messageId)
    {
        $newMessage = Message::find($messageId);
        $this->messages->push($newMessage);

        $this->dispatch('rowChatToBottom');
    }

    public function loadmore()
    {
        $this->paginateVar= $this->paginateVar + 10;
        $this->messages_count = Message::where('conversation_id', $this->selectedConversation->id)->count();
        $this->messages =Message::where('conversation_id', $this->selectedConversation->id)
                        ->skip($this->messages_count - $this->paginateVar)
                        ->take($this->paginateVar)
                        ->get();
        $height = $this->height;
        $this->dispatch('updatedHeight', ($height));
    }

    public function updateHeight($height)
    {
        $this->height = $height;
    }

    public function loadConversation(Conversation $conversation, User $receiver)
    {
        // dd($conversation, $receiver);
        $this->selectedConversation=$conversation;
        $this->receiverInstance=$receiver;

        $this->messages_count = Message::where('conversation_id', $this->selectedConversation->id)->count();
        $this->messages =Message::where('conversation_id', $this->selectedConversation->id)
                        ->skip($this->messages_count - $this->paginateVar)
                        ->take($this->paginateVar)
                        ->get();

        $this->dispatch('chatSelected');
    }

    public function render()
    {
        return view('livewire.chat.chat-box');
    }
}
