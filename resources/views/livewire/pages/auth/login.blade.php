<section class="d-flex align-items-center" id="loginPage" style="background-image: url({{ asset('assets/img/loginBg.png') }});">
  <div class="container">
    <div class="row justify-content-end">
      <div class="col-12 col-md-8 col-lg-6 justify-content-center">
        <div class="card shadow-soft border-light py-4 px-5 bg-transparent border-0">
          <div class="text-center pb-0">
            @if (!$phone_otp && !$email_otp)
            <h2 class="h2" style="font-weight: 600;">Hello, We're happy to have you here again!</h2>
            @endif
          </div>
          <div class="card-body pt-0">
            @if ($phone_otp)
            <div class="text-center pb-0">
              <h2 class="h2" style="font-weight: 600;">Enter Code</h2>
            </div>
            <div class="text-center pb-0">
              <p class="h4">Your verification code is sent by SMS to</p>
              <p class="h4 "><strong>(+63){{ $phone_number }}</strong></p>
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

                  <button wire:click.prevent="emailSend" id="emailSendButton" value="1">Send OTP via email</button>
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
                <span wire:loading wire:target="verifyCode">
                  <span class="spinner-border" role="status">
                    <span class="visually-hidden"></span>
                  </span>
                </span>
              </div>
              <span wire:loading.remove>Log In</span>
            </button>
            @if (session('message'))
            <div class="pt-2 alert alert-success">
              {{ session('message') }}
            </div>
            @elseif(session('error'))
            <div class="pt-2 alert alert-success">
              {{ session('error') }}
            </div>
            @endif

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

            @else
            <!-- Form -->
            <div class="form-group">
              <div class="d-flex flex-column mb-2">
                <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email or Username" type="text" aria-label="email adress" wire:model="email" wire:keydown.enter="login">
                @error('email')
                <small><span class="text-danger error">{{ $message }}</span></small>
                @enderror
                <a href="" wire:click.prevent="togglePhoneNumberLogin" class="text-dark LoginPhone"><u>Log in with
                    Phone Number</u>
                </a>
              </div>
            </div>
            <!-- End of Form -->
            <div class="form-group">
              <!-- Form -->
              <div class="form-group">
                <div class="d-flex flex-column mb-2">
                  <div class="position-relative">
                    <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" type="{{ $type }}" aria-label="Password" wire:model="password">
                    <button type="button" class="toggleButton" wire:click.prevent="togglePassword">
                      @if ($type == 'password')
                      <i class="fa-regular fa-eye-slash"></i>
                      @else
                      <i class="fa-regular fa-eye"></i>
                      @endif
                    </button>
                  </div>
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

            <button class="btn btn-block btn-primary w-100 signIn" wire:click.prevent="login">
              <div wire:ignore>
                <span wire:loading wire:target="login">
                  <span class="spinner-border" role="status">
                    <span class="visually-hidden"></span>
                  </span>
                </span>
              </div>
              <span wire:loading.remove class="text-white">Sign in</span>
            </button>

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
              <p>No account yet? <a href="/register" style="color:#FF6233;"><u>Sign Up here</u></a>
              </p>
            </div>
            @endif
          </div>
        </div>


</section>