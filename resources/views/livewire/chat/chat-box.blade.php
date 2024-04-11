<div>

    @if ($selectedConversation)

    <div class="chatbox_header">
        <div class="return">
            <i class="fa-solid fa-arrow-left"></i>
        </div>

        <div class="img_container">
            <img src="https://ui-avatars.com/api/?name={{$receiverInstance->name}}" alt="">
        </div>

        <div class="name">
            {{ $receiverInstance->name }}
        </div>

        <div class="info">

            <div class="info_item">
                <i class="fa-solid fa-phone"></i>
            </div>

            <div class="info_item">
                <i class="fa-solid fa-image"></i>
            </div>

            <div class="info_item">
                <i class="fa-solid fa-circle-info"></i>
            </div>
        </div>
    </div>

    <div class="chatbox_body">
        @foreach ($messages as $message )

        <div class="msg_body {{auth()->id() == $message->sender_id ? 'msg_body_me' : 'msg_body_receiver'}}" style="width:80%; max-width:max-content;">

                {{$message->text}}

            <div class="msg_body_footer">
                <div class="date">
                    {{$message->created_at->format('m: i a')}}
                </div>
                <div class="read">
                    
                    @php
                        if($message->user->id === auth()->id()){
                            if($message->read == 0){
                                echo '<i class="fa-solid fa-check status_tick"></i>';
                            } else {
                                echo '<i class="fa-solid fa-check-double status_tick" style="color: #0d6efd"></i>';
                            }
                        }
                    @endphp
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @script
    <script>
        $(document).ready(function(){
            $('.chatbox_body').on('scroll', function(){
            let top = $('.chatbox_body').scrollTop();
            if(top == 0){
                $wire.dispatch('loadmore');
            }
            })

        })

    </script>
    @endscript


    <div class="chatbox_footer">
        footer
    </div>


    @else
    <div class="fs-4 text-center text-primary my-5">
        No conversation Selected
    </div>
    @endif

    <script>
        window.addEventListener('rowChatToBottom', event => {
            $(document).ready(function(){
                $('.chatbox_body').scrollTop($('.chatbox_body')[0].scrollHeight);
            })
        });


        $(document).ready(function(){
            window.addEventListener('updatedHeight', event => {

                    let oldHeight = event.detail[0];
                    console.log(oldHeight)
                    let newHeight =$('.chatbox_body')[0].scrollHeight;
                    console.log(newHeight)
                    let myheight =  $('.chatbox_body').scrollTop(newHeight - oldHeight);
                    console.log(myheight[0]['offsetHeight'])

                    Livewire.dispatch('updateHeight', {height: myheight[0]['offsetHeight']});

            });
        })
    </script>

    <script>
        $(document).on('click', ".return", () => {
            window.Livewire.dispatch('resetComponent')
        })
    </script>


</div>
