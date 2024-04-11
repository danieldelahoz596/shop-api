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

    public $text = '';
    public $selectedConversation;
    public $receiverInstance;
    public $createdMessage;
    protected $listeners = ['updateSendMessage', 'dispatchMessageSent', 'resetComponent'];


    public function resetComponent()
    {
        $this->selectedConversation = null;
        $this->receiverInstance = null;

    } 

    public function updateSendMessage(Conversation $conversation, User $receiver)
    {
        $this->selectedConversation = $conversation;
        $this->receiverInstance = $receiver;
    }

    public function sendMessage()
    {
        if ($this->text === null || $this->text === '') {
            // You could also consider giving the user feedback that their message cannot be empty.
            return;
        }

        $this->createdMessage = Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiverInstance->id,
            'text' => $this->text,
        ]);

        $this->selectedConversation->last_time_message = $this->createdMessage->created_at;
        $this->selectedConversation->save();

        $this->dispatch('pushMessage', $this->createdMessage->id); // Emit to ChatBox.
        $this->dispatch('refresh', $this->createdMessage->id); // Emit to ChatList.

        // Use emitUp if the SendMessage component is nested within ChatBox.
        $this->dispatch('dispatchMessageSent');

        $this->text = ''; // Manually clear the text property.

        // If you have a listener for `messageSent` event in your component, you can dispatch it here.
        // This should ensure the message list is updated before the input is cleared.
        $this->dispatch('messageSent');
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
