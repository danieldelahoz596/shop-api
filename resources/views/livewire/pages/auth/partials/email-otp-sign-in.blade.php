<div>
    <div class="text-center pb-0">
        <h2 class="h2" style="font-weight: 600;">Enter Code</h2>
        </div>
        <div class="text-center pb-0">
        <p class="h4">Your verification code is sent by Email to</p>
        <p class="h4 "><strong>{{ $email }}</strong></p>
        </div>
        <div class="form-group">
        <div class="d-flex flex-column mb-4">
            <div class="digit-group">
            <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" inputtype="numeric" id="otc-1" wire:model="otc1" class="codeDanger otpNumber">
            <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" inputtype="numeric" id="otc-2" wire:model="otc2" class="codeDanger otpNumber">
            <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" inputtype="numeric" id="otc-3" wire:model="otc3" class="codeDanger otpNumber">
            <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" inputtype="numeric" id="otc-4" wire:model="otc4" class="codeDanger otpNumber">
            <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" inputtype="numeric" id="otc-5" wire:model="otc5" class="codeDanger otpNumber">
            <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" inputtype="numeric" id="otc-6" wire:model="otc6" class="codeDanger otpNumber">
            </div>
            @if (session('otp_error'))
            <small><span class="text-danger error">{{ session('otp_error') }}</span></small>
            @endif
        </div>
        </div>
        <!-- End of Form -->
        <button wire:click.prevent="verifyCode" type="button" class="btn btn-block btn-primary w-100 text-white">
        <span>Log In</span>
        </span>
        </button>
</div>
