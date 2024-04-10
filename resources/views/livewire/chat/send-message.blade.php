<div>

    @if ($selectedConversation)

    <form wire:submit='sendMessage' action="">
        <div class="chatbox_footer">
            <div class="custom_form_group">

                <input wire:model='text' type="text" class="control" placeholder="Write a message">
                <button type="submit" class="submit">Send</button>
            </div>
        </div>
    </form>
    @endif

</div>
