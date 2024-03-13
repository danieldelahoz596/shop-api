<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Mail\RegisterMail;
use Mail;
use Str;

class RegistrationForm extends Component
{
    public $currentStep = 1;
    public $selectedIdd;
    public $phone_number;
    public $email;
    public $birthday;
    public $firstname;
    public $lastname;
    public $username;
    public $password;
    public $gender;
    public $address;
    public $countries = [];
    public $provinces = [];
    public $cities = [];
    public $selectedCity;
    public $selectedProvince;



    public function mount()
    {
        $this->fetchCountryCodes();
        $this->fetchProvinces();
        // $this->fetchCities();
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

    // public function fetchCities($provinceCode)
    // {
    //     if (!empty($provinceCode)) {
    //         $response = Http::get("https://psgc.gitlab.io/api/province/{$provinceCode}/municipalities");

    //         if ($response->successful()) {
    //             $this->cities = collect($response->json())->map(function ($city) {
    //                 return [
    //                     'code' => $city['code'],
    //                     'name' => $city['name'],
    //                 ];
    //             })->toArray();
    //         } else {
    //             $this->cities = [];
    //         }
    //     } else {
    //         $this->cities = [];
    //     }
    // }


    // public function updatedSelectedProvince($provinceCode)
    // {
    //     $this->fetchCities($provinceCode);
    // }


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

    public function render()
    {
        return view('livewire.pages.auth.registration-form', [
            'countries' => $this->countries,
        ]);
    }
    public function increaseStep()
    {
        $this->validateData();
        $this->currentStep++;
    }

    public function decreaseStep()
    {
        $this->currentStep--;
    }

    protected function validateData()
    {
        if ($this->currentStep === 1) {
            $this->validate([
                'email' => 'required|email|unique:users,email',
                'firstname' => 'required',
                'lastname' => 'required',
                'gender' => 'required',
                'birthday' => 'required'
            ]);
        } elseif ($this->currentStep === 2) {
            $this->validate([
                'selectedIdd' => 'required',
                'phone_number' => 'required|numeric|digits:10',
            ]);
        } elseif ($this->currentStep === 3) {
            $this->validate([
                'username' => 'required',
                'password' => 'required',
            ]);
        }
    }



    public function submit()
    {
        // Validate form data
        $this->validateData();

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
            'address' => $this->selectedProvince,
            'gender' => $this->gender,
            'email_verify_token' => randon_prefix(),
            'password' => Hash::make($this->password),
        ]);

        // Send verification email
        Mail::to($this->email)->send(new RegisterMail($user->email_verify_token, $user->email, $user->name));

        // Dispatch success event
        $this->dispatch('success_registration_swal', [
            'title' => 'Success',
            'timer' => 3000,
            'icon' => 'success',
            'toast' => false,
            'position' => 'center',
            'text' => 'You have registered successfully! Please verify your email to activate your account.',
        ]);

        // Reset form fields
        $this->reset(['selectedIdd', 'gender', 'address', 'phone_number', 'firstname', 'lastname', 'email', 'username', 'password']);
        return redirect()->route('verification-alert');
    }
}