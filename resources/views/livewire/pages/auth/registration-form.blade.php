<div class="signup-container absolute right-0" style="top: 10vh;">


    @if ($currentStep == 1)
    <div class="border justify-content-center gap-2 align-items-center d-flex flex-column bg-white p-3">
        <h5 class="" style="color:#808080;">Step 1 of 3</h5>
        <h1 class="text-primary ">Let's get to know you better</h1>
        <h3 class="lead">Let's personalize your Virtual Ukay-ukay</h3>
        <div class=" w-75 justify-content-center gap-2 align-items-center d-flex flex-column">
            <div class="d-flex">
                <div>
                    <input type="text" wire:model="firstname"
                        class="rounded form-control @error('email') is-invalid @enderror" placeHolder="First Name" />

                </div>

                <div>
                    <input type=" text" wire:model="lastname"
                        class="rounded ms-1 form-control @error('email') is-invalid @enderror"
                        placeHolder="Last Name" />

                </div>

            </div>

            <div class="w-100">
                <input type="email" wire:model="email"
                    class="rounded w-full form-control @error('email') is-invalid @enderror" placeHolder="Email" />
                @error('email') <span class="error text-danger text-sm" style="font-size: 10px;">{{ $message }} This
                    should be a valid email. </span> @enderror
            </div>

            <div class=" w-100 justify-content-center align-items-center d-flex">
                <label for="dob" class="w-50">Date of Birth:</label>
                <input wire:model="birthday" type="date"
                    class="rounded w-full form-control @error('email') is-invalid @enderror" id="dob" name="dob">

            </div>

            <select wire:model="gender" class="form-control @error('email') is-invalid @enderror">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>


            <select wire:model="selectedProvince" name="country_code" id="country_code"
                class="form-control @error('email') is-invalid @enderror" required>
                <option value="">Location</option>
                @foreach($provinces as $province)
                <option value="{{ $province['name'] }}">{{ $province['name'] }}</option>
                @endforeach
            </select>

        </div>
        <div class="text-center text-sm mt-10 text-gray-600">
            By continuing, I agree to Buudle Policies and Terms and Conditions
            <div class="flex gap-2">

                <button wire:click="increaseStep"
                    class="btn bg-primary p-2 px-5 w-75 h-12 rounded mt-1 text-white color-orange font-semibold">Next</button>

            </div>
            <div class="text-center"><a href="/login" class="text-orange-600">Have an account already?</a>
            </div>
        </div>
    </div>
    @endif
    @if ($currentStep == 2)
    <div class="border justify-content-center gap-2 align-items-center d-flex flex-column bg-white p-3">
        <h5 class="" style="color:#808080;">Step 2 of 3</h5>
        <h1 class="text-primary ">What's your phone number</h1>
        <span class="h5 text-center">We need this to very it's you.<br>Don't worry, you are secure with us</span>
        <div class="mt-3">
            <div class="d-flex flex-wrap flex-row">
                <select name="country_code" id="country_code" wire:model="selectedIdd"
                    class="form-control cc-container bg-white">
                    @foreach ($countries as $country)
                    @foreach ($country['callingCodes'] as $code)
                    <option value="{{ $code }}">{{ $country['name'] }} {{ $code }} </option>
                    @endforeach
                    @endforeach
                </select>
                <input type="text" wire:model="phone_number"
                    class=" w-75 ms-2 rounded bg-white form-control @error('email') is-invalid @enderror"
                    placeHolder=" " />
                @error('phone') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="text-center text-sm mt-10 text-gray-600">

            <button wire:click="increaseStep"
                class="btn bg-primary  h-12 rounded mt-1 text-white color-orange font-semibold">Send
                Code</button>

            <div class="text-center"><a href="/login" class="text-orange-600">Have an account already?</a>
            </div>
        </div>

    </div>
    @endif

    @if ($currentStep == 3)
    <div class="border justify-content-center gap-2 align-items-center d-flex flex-column bg-white p-3">
        <h5 class="" style="color:#808080;">Step 3 of 3</h5>
        <h1 class="text-primary ">Last stretch!</h1>
        <h3 class="lead">Just one step your closet</h3>
        {{$this->phone_number}}

        <div class="w-50 d-flex flex-column justify-content-center gap-2 align-items-center">
            <input type="text" wire:model="username" class="rounded form-control @error('email') is-invalid @enderror"
                placeHolder="Username" />
            @error('username') <span class="error">{{ $message }}</span> @enderror


            <input type="password" wire:model="password"
                class="rounded form-control @error('email') is-invalid @enderror" placeHolder="Password" />
            @error('password') <span class="error">{{ $message }}</span> @enderror
            <ul class="text-left" style="color: #808080;text-align: left;">
                <li> Must be at least 8 characters</li>
                <li> Uppercase, lowercase, and one number atleast</li>
            </ul>


            <button wire:click="submit"
                class="btn bg-primary mt-3 p-2 px-5 h-12 rounded text-white color-orange font-semibold">All
                set!</button>
        </div>


    </div>
</div>
@endif







</div>