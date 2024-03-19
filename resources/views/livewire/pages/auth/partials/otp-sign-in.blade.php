<div wire:listen="refreshComponent" wire:action="refresh">
    <div class="text-center pb-0">
        <h2 class="h2" style="font-weight: 600;">Enter Code</h2>
        </div>
        <div class="text-center pb-0">
        <p class="h4">Your verification code is sent by {{ $sentViaEmail ? 'Email' : 'SMS' }} to</p>
        <p class="h4 ">
            <strong>
                {{ $sentViaEmail ? $email : '(+63)'.$phone_number }}
            </strong>
        </p>
        </div>
        <div class="form-group">
        <div class="d-flex flex-column mb-4">
            <div class="digit-group" x-data="{
                                    handleInput(input, index) {
                                        let value = input.value;
                                        input.value = value.replace(/[^0-9]/g, ''); // Allow only numbers

                                        if (event.inputType === 'deleteContentBackward' && index !== 0 && !value) {
                                            input.previousElementSibling.focus(); // Move to previous field on backspace
                                        } else if (index < 5 && value) {
                                            input.nextElementSibling.focus(); // Move to next field if not last
                                        }
                                    }
                                }">
            @foreach (['otc1', 'otc2', 'otc3', 'otc4', 'otc5', 'otc6'] as $otc)
            <input type="text" inputmode="numeric" maxlength="1" x-ref="{{ $otc }}" wire:model.defer="{{ $otc }}" class="otp-input" @input="handleInput($event.target, '{{ $loop->index }}')">
            @endforeach
            </div>
            <div class="d-flex justify-content-between pt-2" x-data="{ countdown: 120,
                                    isDisabled: true,
                                    timer: null,
                                    startTimer() {
                                        this.isDisabled = true;
                                        this.countdown = 120;
                                        this.timer = setInterval(() => {
                                            if (this.countdown > 0) {
                                                this.countdown--;
                                            } else {
                                                clearInterval(this.timer);
                                                this.isDisabled = false;
                                            }
                                        }, 1000);
                                    },
                                    resetTimer() {
                                        clearInterval(this.timer);
                                        this.startTimer();
                                    }
                                }" x-init="startTimer()">

            <button wire:click.prevent="emailSend" id="emailSendButton" value="1" wire:loading.attr="disabled">Send OTP via email</button>
            <button id="resendButton" wire:click.prevent="resendCode" x-show="! isDisabled" :class="{ 'disabled-link': isDisabled }" @click="isDisabled ? $event.preventDefault() : resetTimer()" x-bind:aria-disabled="isDisabled.toString()"> Resend Code</button>
            <span x-show="isDisabled" x-text="'Please wait ' + countdown + ' seconds...'"></span>
            </div>

            @if (session('otp_error'))
            <small><span class="text-danger error">{{ session('otp_error') }}</span></small>
            @endif
        </div>
        </div>
        <!-- End of Form -->
        <button wire:click="verifyCode" type="button" class="btn btn-block btn-primary w-100 text-white">
            <div wire:ignore>
                <span wire:loading wire:target="emailSend" class="spinner-border" role="status">
                    <span class="visually-hidden"></span>
                </span>
                <span wire:loading wire:target="verifyCode" class="spinner-border" role="status">
                    <span class="visually-hidden"></span>
                </span>
            </div>
            <span wire:loading.remove class="text-white">Log In</span>
        </button>
        @if (session('message'))
            <div class="pt-2 alert alert-success mt-2">
            {{ session('message') }}
            </div>
        @elseif(session('error'))
            <div class="pt-2 alert alert-success">
            {{ session('error') }}
            </div>
        @endif
</div>
