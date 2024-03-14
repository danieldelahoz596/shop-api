<div class="signup-container absolute " style="top: 6vh;right:5vw;">


    @if ($currentStep == 1)
    <div class="border justify-content-center gap-2 align-items-center d-flex flex-column bg-white p-3">
        <h5 class="" style="color:#808080;">Step 1 of 4</h5>
        <h1 class="text-primary ">Let's get to know you better</h1>
        <h3 class="lead">Let's personalize your Virtual Ukay-ukay</h3>
        <div class=" w-75 justify-content-center gap-2 align-items-center d-flex flex-column">
            <div class="d-flex">
                <div>
                    <input type="text" wire:model.live="firstname" class="rounded form-control @error('firstname') is-invalid @enderror" placeHolder="First Name" />

                </div>
                <div>
                    <input type=" text" wire:model.live="lastname" class="rounded ms-1 form-control @error('lastname') is-invalid @enderror" placeHolder="Last Name" />

                </div>
            </div>
            <select wire:model="gender" class="form-control @error('gender') is-invalid @enderror">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <div class="w-100">
                <input type="email" wire:model.live="email" class="rounded w-full form-control @error('email') is-invalid @enderror" placeHolder="Email" />
                @error('email') <span class="error text-danger text-sm" style="font-size: 10px;">{{ $message }} This
                    should be a valid email. </span> @enderror
            </div>

            <div class=" w-100 justify-content-center align-items-center d-flex">
                <label for="dob" class="w-50">Date of Birth:</label>
                <input wire:model="birthday" type="date" class="rounded w-full form-control @error('birthday') is-invalid @enderror" id="dob" name="dob">

            </div>

        </div>
        <div class="text-center text-sm mt-3 mb-3 text-gray-600">
            By continuing, I agree to Buudle Policies and Terms and Conditions
            <div class="flex gap-2">

                <button wire:loading.remove wire:click="increaseStep" class="btn bg-primary p-2 px-5 w-75 h-12 rounded mt-1 text-white color-orange font-semibold"><span wire:loading.remove wire:target="increaseStep">Next</span>
                    <!-- Loading Spinner -->
                    <div wire:loading wire:target="increaseStep" class="absolute inset-0 flex justify-center items-center">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>
                </button>

            </div>
            <div class="text-center"><a href="/login" class="text-orange-600">Have an account already?</a>
            </div>
        </div>
    </div>
    @endif
    @if ($currentStep == 2)
    <div class=" justify-content-center gap-2 align-items-center d-flex flex-column bg-white p-3">
        <h5 class="" style="color:#808080;">Step 2 of 4</h5>
        <h1 class="text-primary ">Let's get to know you better</h1>
        <h3 class="lead">Let's personalize your Virtual Ukay-ukay</h3>
        <div class=" w-75 justify-content-center gap-2 align-items-center d-flex flex-column">
            <select wire:model="selectedProvince" wire:change="provinceSelected($event.target.value)" name="province" id="province" class="form-control @error('province') is-invalid @enderror" required>
                <option value="">Select Province</option>
                @foreach($provinces as $province)
                <option value="{{ $province['code'] }}">{{ $province['name'] }}</option>
                @endforeach
            </select>

            <select wire:model="selectedCity" name="city" id="city" class="form-control @error('city') is-invalid @enderror" required>
                <option value="">Select City</option>
                @foreach($cities as $city)
                <option value="{{ $city['code'] }}">{{ $city['name'] }}</option>
                @endforeach
            </select>
            <div class="w-100">
                <input type="text" wire:model="barangay" class="rounded w-full form-control @error('barangay') is-invalid @enderror" placeHolder="Barangay" />

            </div>
            <div class="d-flex">
                <div class="w-25">
                    <input type="text" wire:model="streetNumber" class="rounded w-full form-control @error('streetNumber') is-invalid @enderror" placeHolder="St No." />

                </div>
                <div class="w-75 ms-1">
                    <input type="text" wire:model="street" class="rounded w-full form-control @error('Street') is-invalid @enderror" placeHolder="Street" />

                </div>
            </div>

        </div>
        <div class="text-center text-sm mt-3 mb-3 text-gray-600">
            By continuing, I agree to Buudle Policies and Terms and Conditions
            <div class="flex gap-2">

                <button wire:loading.remove wire:click="increaseStep" class="btn bg-primary p-2 px-5 w-75 h-12 rounded mt-1 text-white color-orange font-semibold">Next</button>
                <div wire:loading wire:target="increaseStep" class="absolute inset-0 flex justify-center items-center">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </div>
            </div>

        </div>
    </div>
    @endif


    @if ($currentStep == 3)
    <div class="  justify-content-center gap-2 align-items-center d-flex flex-column bg-white p-3">
        @if($phone_otp)
        <div class="text-center pb-0">
            <h2 class="h2" style="font-weight: 600;">Enter Code</h2>
        </div>
        <div class="text-center pb-0">
            <p class="h4">Your verification code is sent by SMS to</p>
            <p class="h4 "><strong>{{$this->selectedIdd}}{{ $this->phone_number }}</strong></p>
        </div>
        <div class="form-group">
            <div class="d-flex flex-column mb-4">
                <div class="digit-group">
                    <input type="number" wire:change="nextInput" pattern="[0-9]*" inputtype="numeric" autocomplete="one-time-code" id="otc-1" wire.model.defer="otc_1" class="codeDanger otpNumber">
                    <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" inputtype="numeric" id="otc-2" wire.model.defer="otc_2" class="codeDanger otpNumber">
                    <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" inputtype="numeric" id="otc-3" wire.model.defer="otc_3" class="codeDanger otpNumber">
                    <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" inputtype="numeric" id="otc-4" wire.model.defer="otc_4" class="codeDanger otpNumber">
                    <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" inputtype="numeric" id="otc-5" wire.model.defer="otc_5" class="codeDanger otpNumber">
                    <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" inputtype="numeric" id="otc-6" wire.model.defer="otc_6" class="codeDanger otpNumber">
                </div>
                @error('number')
                <small><span class="text-danger error">{{ $message }}</span></small>
                @enderror
            </div>
        </div>
        <button wire:click.prevent="emailSend" value="1" class="btn btn-block btn-primary w-100 text-white">Send OTP via
            email</button>
        <!-- End of Form -->
        <button wire:click.prevent="verifyCode" type="button" class="btn btn-block btn-primary w-100 text-white">
            <span wire:loading>
                <span class="spinner-border" role="status">
                    <span class="visually-hidden"></span>
                </span>
            </span>
        </button>
        @elseif($email_otp)
        <div class="text-center pb-0">
            <h2 class="h2" style="font-weight: 600;">Enter Code</h2>
        </div>
        <div class="text-center pb-0">
            <p class="h4">Your verification code is sent by Email to</p>
            <p class="h4 "><strong>{{ $this->email }}</strong></p>
        </div>
        <div class="form-group">
            <div class="d-flex flex-column mb-4">
                <div class="digit-group">
                    <input type="number" pattern="[0-9]*" inputtype="numeric" autocomplete="one-time-code" id="otc-1" wire:model.defer="otc1" class="codeDanger">
                    <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" inputtype="numeric" id="otc-2" wire:model.defer="otc2" class="codeDanger">
                    <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" inputtype="numeric" id="otc-3" wire:model.defer="otc3" class="codeDanger">
                    <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" inputtype="numeric" id="otc-4" wire:model.defer="otc4" class="codeDanger">
                    <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" inputtype="numeric" id="otc-5" wire:model.defer="otc5" class="codeDanger">
                    <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" inputtype="numeric" id="otc-6" wire:model.defer="otc6" class="codeDanger">
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
        </button>
        @else
        <!-- Last Form -->
        <div class=" justify-content-center gap-2 align-items-center d-flex flex-column bg-white p-3">
            <h5 class="" style="color:#808080;">Step 3 of 4</h5>
            <h1 class="text-primary ">What's your phone number</h1>
            <span class="h5 text-center">We need this to very it's you.<br>Don't worry, you are secure with us</span>
            <div class="mt-3">
                <div class="d-flex flex-wrap flex-row">
                    <select name="country_code" id="country_code" wire:model="selectedIdd" class="form-control cc-container bg-white">
                        @foreach ($countries as $country)
                        @foreach ($country['callingCodes'] as $code)
                        <option value="{{ $code }}">{{ $country['name'] }} {{ $code }} </option>
                        @endforeach
                        @endforeach
                    </select>
                    <input type="text" wire:model.live="phone_number" class=" w-75 ms-2 rounded bg-white form-control @error('email') is-invalid @enderror" placeHolder=" " />
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="text-center text-sm mt-10 text-gray-600">
                <div>
                    <button wire:loading.remove wire:click="increaseStep" class="btn bg-primary  h-12 rounded mt-1 text-white color-orange font-semibold">Send
                        Code</button>
                    <div wire:loading wire:target="increaseStep" class="absolute inset-0 flex justify-center items-center">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="text-center"><a href="/login" class="text-orange-600">Have an account already?</a>
                </div>
            </div>

        </div>
        @endif
    </div>
    @endif


    @if ($currentStep == 4)
    <div class="border justify-content-center gap-2 align-items-center d-flex flex-column bg-white p-3">
        <h5 class="" style="color:#808080;">Step 4 of 4</h5>
        <h1 class="text-primary ">Last stretch!</h1>
        <h3 class="lead">Just one step your closet</h3>

        <div class="w-75 d-flex flex-column justify-content-center gap-2 align-items-center">
            <input type="text" wire:model="username" class="rounded form-control @error('email') is-invalid @enderror" placeHolder="Username" />
            @error('username') <span class="error">{{ $message }}</span> @enderror



            <input type="password" wire:model.live="password" class="rounded form-control @error('password') is-invalid @enderror" placeholder="Password" />

            {{-- Display all error messages --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <input type="password" wire:model="password_confirmation" class="rounded form-control @error('email') is-invalid @enderror" placeHolder="Confirm Password" />
            <ul class="text-left" style="color: #808080;text-align: left;">
                <li> Must be at least 8 characters</li>
                <li> Uppercase, lowercase, and one number atleast</li>
            </ul>


            <button wire:click="submit" class="btn bg-primary mt-3 p-2 px-5 h-12 rounded text-white color-orange font-semibold relative">
                <span wire:loading.remove wire:target="submit">All set!</span>
                <!-- Loading Spinner -->
                <div wire:loading wire:target="submit" class="absolute inset-0 flex justify-center items-center">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </div>
            </button>
        </div>


    </div>
</div>
@endif








</div>