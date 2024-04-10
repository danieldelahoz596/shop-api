<div>

    <div class="chatlist_header">

        <div class="title">
            chat
        </div>

        <div class="img_container">
            <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{auth()->user()->name}}" alt="">
        </div>

    </div>

    <div class="chatlist_body">

        @if (count($conversations) > 0)

        @foreach ($conversations as $conversation )

        <div class="chatlist_item" wire:key='{{$conversation->id}}' wire:click="$dispatch('chatUserSelected', {'conversation': {{ $conversation }}, 'receiverId' : {{$this->getChatuserInstance($conversation, $name='id')}}})">
            <div class="chatlist_img_container">
                <img src="https://ui-avatars.com/api/?name={{$this->getChatuserInstance($conversation, $name='name')}}" alt="">
            </div>
            <div class="chatlist_info">
                <div class="top_row">
                    <div class="list_username">{{ $this->getChatuserInstance($conversation, $name='name') }}</div>
                    <span class="date">{{ $conversation->messages->last()->created_at->shortAbsoluteDiffForHumans() }}</span>
                </div>

                <div class="bottom_row">
                    <div class="message_body text-truncate">
                        {{ $conversation->messages->last()->text }}
                    </div>
                    <div class="unread_count">
                        56
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        @else
        You have no conversations
        @endif


    </div>
</div>
