<?php

namespace App\Livewire\Chat;

use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SendMessage extends Component
{

    public $text ='';
    public $selectedConversation;
    public $receiverInstance;
    public $createdMessage;
    protected $listeners = ['updateSendMessage', 'dispatchMessageSent'];

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

        

        $this->createdMessage = Message::create([
            'conversation_id'=>$this->selectedConversation->id,
            'sender_id'=> auth()->id(),
            'receiver_id'=>$this->receiverInstance->id,
            'text'=>$this->text,
        ]);

        $this->selectedConversation->last_time_message =$this->createdMessage->created_at;
        $this->selectedConversation->save();

        $this->dispatch('pushMessage',$this->createdMessage->id)->to(ChatBox::class);
        $this->dispatch('refresh',$this->createdMessage->id)->to(ChatList::class);

        $this->reset('text');

        $this->dispatch('dispatchMessageSent')->self();
    }

    public function dispatchMessageSent()
    {   
        broadcast(new MessageSent(Auth()->user(), $this->createdMessage, $this->selectedConversation, $this->receiverInstance));
    }



    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
