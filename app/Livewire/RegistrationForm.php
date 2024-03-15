<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Mail\RegisterMail;
use App\Service\LogService;
use App\Mail\SendOtpViaMail;
use Livewire\Attributes\Rule;
use Mail;
use Str;

class RegistrationForm extends Component
{
    public $currentStep = 1;
    public $selectedIdd, $phone_number, $email, $birthday, $firstname, $lastname, $username;
    public $password, $gender, $address, $password_confirmation;
    public  $remember_me, $phone_otp, $email_otp;
    public $countries = [];
    public $provinces = [];
    public $cities = [];
    public $selectedCity, $selectedProvince, $streetNumber, $barangay, $street;
    public $phone;
    public $input;
    public $otp;
    public $otc1, $otc2, $otc3, $otc4, $otc5, $otc6;
    public $inputCode;

    public function otp_gen()
    {
        return $this->otp;
    }
    public function switchToPhoneNumberLogin()
    {
        $this->loginMode = 'phone';
    }

    public function switchToEmailLogin()
    {
        $this->loginMode = 'email';
    }


    public function verifyCode()
    {
        $inputCode = $this->otc1 . $this->otc2 . $this->otc3 . $this->otc4 . $this->otc5 . $this->otc6;
        movider_service($this->phone, $this->otp_gen());
        // Logger

        if ($this->otp == (int)$inputCode) {
            // Logger
            $this->phone_otp = false;
            $this->email_otp = false;
            $this->currentStep++;
        }
    }

    public function emailSend()
    {
        $this->phone_otp = 0;
        $otp_gen = otp_generator();
        Mail::to($this->email)->send(new SendOtpViaMail($otp_gen)); // Iisang variable, kasi pag cinall mo twice, different ang OTP
        $this->otp = $otp_gen;
        $this->email_otp = 1;
    }

    //THIS SETUP IS FOR THE ADDRESS INCLUDING PROVINCES AND MUNICIPALITIES
    protected $listeners = ['provinceSelected'];


    protected $rules = [
        'password' => [
            'required',
            'min:8', // Minimum 8 characters
            'regex:/[a-z]/', // Must include lowercase letters
            'regex:/[A-Z]/', // Must include uppercase letters
            'regex:/[0-9]/', // Must include numbers
            'regex:/[@$!%*#?&]/', // Must include a special character
        ],
        'phone_number' => [
            'required',
            'digits:10', // digit is 10

        ],
        'email' => [
            'required',
            'email',
            'unique:users,email', // digit is 10

        ],
    ];
    protected $messages = [
        'password.required' => 'The password field is required.',
        'password.min' => 'The password must be at least :min characters.',
        'password.regex' => 'Uppercase, lowercase, and one number atleast.',
        'phone_number.required' => 'It should be 10 digits. Country code is not included.',
        'phone_number.digit' => 'It should be 10 digits country code is not included.',
        'email.required' => 'The email field is required.',
        'email.email' => 'The email field should be a valid email.',
        'email.unique' => 'The email is already taken.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function provinceSelected($provinceCode)
    {
        $this->fetchCities($provinceCode);
    }

    public function mount()
    {
        $this->fetchCountryCodes();
        $this->fetchProvinces();
    }

    public function fetchProvinces()
    {
        $response = Http::get('https://psgc.gitlab.io/api/provinces');

        if ($response->successful()) {
            $this->provinces = collect($response->json())->map(function ($province) {
                return [
                    'code' => $province['code'],
                    'name' => $province['name'],
                ];
            })->toArray();
        }
    }

    public function fetchCities($provinceCode)
    {
        if (!empty($provinceCode)) {
            $response = Http::get("https://psgc.gitlab.io/api/provinces/{$provinceCode}/municipalities");

            if ($response->successful()) {
                $this->cities = collect($response->json())->map(function ($city) {
                    return [
                        'code' => $city['code'],
                        'name' => $city['name'],
                    ];
                })->toArray();
            } else {
                $this->cities = [];
            }
        } else {
            $this->cities = [];
        }
    }


    //THIS IS TO GET THE COUNTRY CODE (SELECTIDD)
    public function fetchCountryCodes()
    {
        $response = Http::get('https://restcountries.com/v3.1/all?fields=name,idd');

        if ($response->successful()) {
            $this->countries = collect($response->json())->map(function ($country) {
                $fullCodes = [];
                $root = $country['idd']['root'] ?? '';
                $suffixes = $country['idd']['suffixes'] ?? [];

                foreach ($suffixes as $suffix) {
                    $fullCodes[] = $root . $suffix;
                }

                return [
                    'name' => $country['name']['common'],
                    'callingCodes' => $fullCodes,
                ];
            })->toArray();
        }
    }
    //RENDER TO PAGE
    public function render()
    {
        return view('livewire.pages.auth.registration-form', [
            'countries' => $this->countries,
        ]);
    }

    //THIS IS FOR THE NEXT BUTTON
    public function increaseStep()
    {
        if ($this->currentStep === 3) {
            // Check if we are on Step 3
            $this->phone_otp = true; // Enable phone OTP mode

            return; // Exit the function without incrementing the step
        }
        $this->validateData();
        $this->currentStep++;
        $this->loading = true;
        $this->loading = false;
    }

    public function decreaseStep()
    {
        $this->currentStep--;
    }
    //OTHER VALIDATIONS ARE HERE
    protected function validateData()
    {
        if ($this->currentStep === 1) {
            $this->validate([
                'email' => 'required|email|unique:users,email',
                'firstname' => 'required',
                'lastname' => 'required',
                'gender' => 'required',
                'birthday' => 'required|date'
            ]);
        } elseif ($this->currentStep === 3) {
            $this->validate([
                'selectedIdd' => 'required',
                'phone_number' => 'required|numeric|digits:10|unique:users,phone_number',
            ]);
        } elseif ($this->currentStep === 4) {
            $this->validate([
                'username' => 'required|min:4|unique:users,username',
                'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                'password_confirmation' => 'required|same:password',
            ]);
        }
    }

    //SUBMIT BUTTON

    public function submit()
    {
        // $this->phone_otp = 1;
        // $this->phoneSend();
        // $otp_gen = otp_generator();
        // User::where('email', '=', $this->email)
        //     ->update([
        //         'otp_code' => $otp_gen
        //     ]);

        $this->loading = true; // Before the operation
        $this->loading = false; // After the operation
        // Validate form data
        $this->validateData();
        $address =  $this->streetNumber . ' ' . $this->street . ', ' . $this->barangay . ', ' . $this->selectedCity . ', ' . $this->selectedProvince;
        // Create the user
        $user = User::create([
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'name' => $this->firstname . ' ' . $this->lastname,
            'birthday' => $this->birthday,
            'phone_area_code' => $this->selectedIdd,
            'username' => $this->username,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'address' => $address,
            'gender' => $this->gender,
            'email_verify_token' => randon_prefix(),
            'password' => Hash::make($this->password),
        ]);


        // Send verification email
        Mail::to($this->email)->send(new RegisterMail($user->email_verify_token, $user->email, $user->name));

        // Dispatch success event
        $log_name = 'User registered';
        $log_desc = 'User successfully registered. ';
        LogService::userLog($log_name, $log_desc);
        $this->dispatch('success_login_swal', [
            'title' => 'Success',
            'timer' => 3000,
            'icon' => 'success',
            'toast' => false,
            'position' => 'center',
            'text' => 'You have successfully registered. Please Check you email '
        ]);

        // Reset form fields
        $this->reset(['selectedIdd', 'gender', 'address', 'phone_number', 'firstname', 'lastname', 'email', 'username', 'password']);
        return redirect()->route('verificationalert');
    }
}