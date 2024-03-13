<section class="min-vh-100 " style="background-image: url('{{ asset('assets/img/LoginBg.png') }}'); background-position:center; background-repeat:no-repeat;">
  <div class="container">
    <div class="row justify-content-end">
      <div class="col-12 col-md-8 col-lg-6 justify-content-center">
        <div class="card shadow-soft border-light py-4 px-5 bg-transparent border-0">
          <div class="text-center pb-0">
            <h2 class="h2" style="font-weight: 600;">Hello, We're happy to have you here again!</h2>
          </div>
          <div class="card-body pt-0">
            @if($phone_otp)
                <div class="text-center pb-0">
                  <h2 class="h2" style="font-weight: 600;">Enter Code</h2>
                </div>
                <div class="text-center pb-0">
                  <p class="h4">Your verification code is sent by SMS to</p>
                  <p class="h4 "><strong>(+63){{ $phone_number }}</strong></p>
                </div>
                <div class="form-group">
                  <div class="d-flex flex-column mb-4">
                    <div class="digit-group">
                      <input type="number" pattern="[0-9]*" value="" inputtype="numeric" autocomplete="one-time-code" id="otc-1" wire.model.defer="otc-1" class="codeDanger" >
                      <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" value="" inputtype="numeric" id="otc-2" wire.model.defer="otc-2" class="codeDanger" >
                      <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" value="" inputtype="numeric" id="otc-3" wire.model.defer="otc-3" class="codeDanger" >
                      <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" value="" inputtype="numeric" id="otc-4" wire.model.defer="otc-4" class="codeDanger" >
                      <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" value="" inputtype="numeric" id="otc-5" wire.model.defer="otc-5" class="codeDanger" >
                      <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" value="" inputtype="numeric" id="otc-6" wire.model.defer="otc-6" class="codeDanger" >
                    </div>
                    @error('number')
                    <small><span class="text-danger error">{{ $message }}</span></small>
                    @enderror
                  </div>
                </div>
                <button wire:click.prevent="emailSend" value="1">Send OTP via email</button>
                <!-- End of Form -->
                <button wire:click.prevent="verifyCode" type="button" class="btn btn-block btn-primary w-100 text-white">
                  <span wire:loading>
                    <span class="spinner-border" role="status">
                      <span class="visually-hidden"></span>
                    </span>
                  </span>
                  <span wire:loading.remove>Log In</span>
                </button>
            @elseif($email_otp)
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
                      <input type="number" pattern="[0-9]*" value="" inputtype="numeric" autocomplete="one-time-code" id="otc-1" wire.model.defer="otc-1" class="codeDanger" >
                      <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" value="" inputtype="numeric" id="otc-2" wire.model.defer="otc-2" class="codeDanger" >
                      <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" value="" inputtype="numeric" id="otc-3" wire.model.defer="otc-3" class="codeDanger" >
                      <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" value="" inputtype="numeric" id="otc-4" wire.model.defer="otc-4" class="codeDanger" >
                      <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" value="" inputtype="numeric" id="otc-5" wire.model.defer="otc-5" class="codeDanger" >
                      <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" value="" inputtype="numeric" id="otc-6" wire.model.defer="otc-6" class="codeDanger" >
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
                  <span wire:loading.remove>Log In</span>
                </button>
            @else
            <form class="mt-4">
              <!-- Form -->
              <div class="form-group">
                <div class="d-flex flex-column mb-2">
                  <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email or Username" type="text" aria-label="email adress" wire:model="email" wire:keydown.enter="login">
                  @error('email')
                  <small><span class="text-danger error">{{ $message }}</span></small>
                  @enderror
                  <a href="{{ route('login/number') }}" class="text-dark LoginPhone"><u>Log in with Phone Number</u></a>
                </div>
              </div>
              <!-- End of Form -->
              <div class="form-group">
                <!-- Form -->
                <div class="form-group">
                  <div class="d-flex flex-column mb-2">
                    <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" type="password" aria-label="Password" wire:model="password" wire:keydown.enter="login">
                    @error('password')
                    <small><span class="text-danger error">{{ $message }}</span></small>
                    @enderror
                    <a href="" class="text-dark ForgotPassword"><u>Forgot Password</u></a>
                  </div>
                </div>
                <!-- End of Form -->
                <div class="d-block d-sm-flex justify-content-between align-items-center mb-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="remember_me" name="remember_me" wire:model="remember_me">
                    <label class="form-check-label" for="remember_me">
                      Remember me
                    </label>
                  </div>
                  <div><a href="/forgot-password" class="small text-right">Lost password?</a></div>
                </div>
              </div>
              <button type="button" class="btn btn-block btn-primary w-100" wire:click.prevent="login">
                <span wire:loading>
                  <span class="spinner-border" role="status">
                    <span class="visually-hidden"></span>
                  </span>
                </span>
                <span wire:loading.remove>Sign in</span>
              </button>
            </form>
            <div class="divider d-flex align-items-center my-2">
              <p class="text-center fw-bold mx-3 mb-0 text-muted">or</p>
            </div>
            <div class="socialLink">
              <span class="socialLinkButton"><a href="">
                  <i class="text-primary fab fa-facebook-f" style="color:#2A5297 !important;"></i><span id="fbText"></span>
                </a></span>
              <span class="socialLinkButton" id="register-button"><a href="">
                  <i class="fa-brands fa-google" style="color: blue;"></i><span id="gText"></span>
                </a></span>
            </div>
            <div class="text-center">
              <p>No account yet? <a href="/register" style="color:#FF6233;"><u>Sign Up here</u></a></p>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>