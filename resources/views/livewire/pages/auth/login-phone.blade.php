<section class="min-vh-100 " style="background-image: url('{{ asset('assets/img/LoginBg.png') }}'); background-position:center; background-repeat:no-repeat;">
  <div class="container">
    <div class="row justify-content-end">
      <div class="col-12 col-md-8 col-lg-6 justify-content-center">
        <div class="card shadow-soft border-light py-4 px-5 bg-transparent border-0">
          @if(!$isVerificationCodeSent)
          <div class="text-center pb-0">
            <h2 class="h2" style="font-weight: 600;">Hello, We're happy to have you here again!</h2>
          </div>
          <div class="card-body">
            <form class="mt-4">
              <!-- Form -->
              <div class="form-group">
                <div class="d-flex flex-column mb-2">
                  <div class="numberContainer d-flex align-items-center" style="column-gap: 10px;">
                    <div class="philCode w-25 bg-white text-center" style="padding:0.375rem 0.75rem; border-radius: 0.375rem;">+63</div>
                    <input class="form-control @error('number') is-invalid @enderror" id="number" name="phone_number" placeholder="Phone Number" type="number" wire:model="phone_number" wire:keydown.enter="sendCode">
                  </div>
                  @error('number')
                  <small><span class="text-danger error">{{ $message }}</span></small>
                  @enderror
                  <a href="{{ route('login') }}" class="text-dark"><u>Log in with Email/Username</u></a>
                </div>

              </div>
              <!-- End of Form -->
              <div class="form-group">
                <div class="d-block d-sm-flex justify-content-between align-items-center mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="remember_me" name="remember_me" wire:model="remember_me">
                    <label class="form-check-label" for="remember_me">
                      Remember me
                    </label>
                  </div>
                </div>
              </div>
              <button wire:click.prevent="sendCode" type="button" class="btn btn-block btn-primary w-100 text-white">
                    <span wire:loading>
                      <span class="spinner-border" role="status">
                        <span class="visually-hidden"></span>
                      </span>
                    </span>
                    <span wire:loading.remove>Send Code</span>
                  </button>
              @endif

              @if($isVerificationCodeSent)
              <div class="text-center pb-0">
                <h2 class="h2" style="font-weight: 600;">Enter Code</h2>
              </div>
              <div class="text-center pb-0">
                <p class="h4">Your verification code is sent by SMS to</p>
                <p class="h4 "><strong>(+63){{ $phone_number }}</strong></p>
              </div>
              <div class="card-body">
                <form method="POST" class="mt-4">
                  <!-- Form -->
                  <div class="form-group">
                    <div class="d-flex flex-column mb-4">
                      <div class="digit-group">
                        <input type="number" pattern="[0-9]*" value="" inputtype="numeric" autocomplete="one-time-code" id="otc-1" wire.model.defer="otc-1" class="codeDanger" required>
                        <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" value="" inputtype="numeric" id="otc-2" wire.model.defer="otc-2" class="codeDanger" required>
                        <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" value="" inputtype="numeric" id="otc-3" wire.model.defer="otc-3" class="codeDanger" required>
                        <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" value="" inputtype="numeric" id="otc-4" wire.model.defer="otc-4" class="codeDanger" required>
                        <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" value="" inputtype="numeric" id="otc-5" wire.model.defer="otc-5" class="codeDanger" required>
                        <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" value="" inputtype="numeric" id="otc-6" wire.model.defer="otc-6" class="codeDanger" required>
                      </div>
                      @error('number')
                      <small><span class="text-danger error">{{ $message }}</span></small>
                      @enderror
                    </div>
                  </div>
                  <!-- End of Form -->
                  <button wire:click.prevent="verifyCode" type="button" class="btn btn-block btn-primary w-100 text-white">
                    <span wire:loading>
                      <span class="spinner-border" role="status">
                        <span class="visually-hidden"></span>
                      </span>
                    </span>
                    {{ $inputCode }}
                    <span wire:loading.remove>Log In</span>
                  </button>
                  @endif
                  
                </form>
              </div>
          </div>
        </div>
      </div>
    </div>
</section>