<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class SendMessage extends Component
{

    public $text ='';
    public $selectedConversation;
    public $receiverInstance;
    protected $listeners = ['updateSendMessage'];

    public function updateSendMessage(Conversation $conversation, User $receiver)
    {
        $this->selectedConversation = $conversation;
        $this->receiverInstance = $receiver;
    }

    public function sendMessage()
    {
        if($this->text == null){
            return null;
        }

        $createdMessage = Message::create([
            'conversation_id'=>$this->selectedConversation->id,
            'sender_id'=> auth()->id(),
            'receiver_id'=>$this->receiverInstance->id,
            'text'=>$this->text,
        ]);

        $this->selectedConversation->last_time_message = $createdMessage->created_at;
        $this->selectedConversation->save();

        $this->dispatch('pushMessage', $createdMessage->id)->to(ChatBox::class);
        $this->dispatch('refresh', $createdMessage->id)->to(ChatList::class);

        $this->reset('text');
    }

    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
