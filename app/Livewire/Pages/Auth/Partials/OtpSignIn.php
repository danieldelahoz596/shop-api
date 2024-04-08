<?php

namespace App\Livewire\Pages\Auth\Partials;

use App\Mail\SendOtpViaMail;
use App\Models\User;
use App\Service\LogService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class OtpSignIn extends Component
{
    public $email, $password, $remember_me, $phone_otp, $phone_number, $email_otp, $otp_gen;
    public $otc1, $otc2, $otc3, $otc4, $otc5, $otc6;
    public $type = "password";
    public $input;


    public $usePhoneNumber = false;
    public $useEmail = true;
    public $sentViaEmail = false;

    public function togglePhoneNumberLogin()
    {
        $this->usePhoneNumber = !$this->usePhoneNumber;
        $this->useEmail = !$this->useEmail;
    }

    public function login()
    {
        $validate = $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = auth()->getProvider()->retrieveByCredentials($validate);

        if (!auth()->validate($validate)) {
            $log_name = 'User login';
            $log_desc = 'User Attempt Logging in using ' . $this->email;
            LogService::userLog($log_name, $log_desc);
            $this->dispatch('error_login_swal', [
                'title' => 'Error!',
                'timer' => 3000,
                'icon' => 'warning',
                'toast' => false,
                'position' => 'center',
                'text' => 'Looks like the credentials you entered are not found',
            ]);
            session()->flash('error', 'Looks like the credentials you entered are not found');
        } else {
            $user = User::where('email', $validate['email'])->first();

            if ($user->ftl === 1) {
                $this->phone_otp = 1;
                $this->phone_number = strval($user->phone_number);
                // $this->phoneSend();
                $otp_gen = otp_generator();
                $currentTime = now();
                User::where('email', '=', $this->email)
                    ->update([
                        'otp_code' => $otp_gen,
                    ]);
                $currentTime = now();
                $user->otp_sent_time = $currentTime;
                $user->save();
            } else {
                auth()->login($user, $this->remember_me);
                $user = Auth::user();
                $this->successLogin($user);
            }
        }
    }

    public function resendCode()
    {
        $currentTime = now();
        $user = User::where('email', $this->email)->first();
        if ($user->otp_sent_time && $currentTime->diffInSeconds($user->otp_sent_time) < 120) {
            session()->flash('error', 'Error sending OTP. Please wait at least 2 minutes before resending the code.');
        } else {
            // Resend the code logic here
            // $this->phoneSend();
            $otp_gen = otp_generator();
            $user->update([
                'otp_code' => $otp_gen,
                // 'otp_sent_time' => $currentTime
            ]);

            $currentTime = now();
            $user->otp_sent_time = $currentTime;
            $user->save();
            session()->flash('message', 'A new OTP code has been sent.');
        }
    }


    public function emailSend()
    {
        $this->sentViaEmail = true;
        $this->dispatch('refreshComponent', ['sentViaEmail' => $this->sentViaEmail]);

        $this->otp_gen = otp_generator();

        $otp_gen = $this->otp_gen;
        $user = User::where('email', $this->email)->first();
        $user->update([
            'otp_code' => $otp_gen,
        ]);

        Mail::to($this->email)->send(new SendOtpViaMail($this->otp_gen));
    }

    public function togglePassword()
    {
        if ($this->type === "password") {
            $this->type = "text";
        } else {
            $this->type = "password";
        }
    }

    public function phoneSend()
    {
        $this->phone_otp = 0;
        $this->otp_gen = otp_generator();
        movider_service("+63" . $this->phone_number, $otp_gen);
        $this->phone_otp = 1;
    }

    public function verifyCode()
    {
        // Concatenate the input OTP
        $inputCode = $this->otc1 . $this->otc2 . $this->otc3 . $this->otc4 . $this->otc5 . $this->otc6;

        // // Retrieve the user based on the provided email
        $user = User::where('email', $this->email)->first();

        if (!$user) {
            // Handle case where user does not exist with the provided email
            return false;
        }


        // Check if the OTP in the database matches the input OTP
        if ($user->otp_code == (int)$inputCode) {
            auth()->login($user, $this->remember_me);
            $user = Auth::user();
            if ($user) {
                $user->lastlogin = now(); // Assuming 'lastlogin' is a datetime field
                $user->ftl = 0;
                $user->otp_code = null;
                $user->save();
            }

            $this->successLogin($user);
        } else {
            // Set an error message when OTP does not match
            session()->flash('otp_error', 'Invalid OTP code. Please try again.');
        }
    }

    public function successLogin($user)
    {
        $log_name = 'User login';
        $log_desc = 'User successfull login using email ' . $this->email;
        LogService::userLog($log_name, $log_desc);
        $this->dispatch('success_login_swal', [
            'title' => 'Success',
            'timer' => 3000,
            'icon' => 'success',
            'toast' => false,
            'position' => 'center',
            'text' => 'You have logged in successfully. Welcome back! ' . $user->firstname . ' ' . $user->lastname
        ]);

        session()->flash('message', 'You have logged in successfully. Welcome back! ' . $user->firstname . ' ' . $user->lastname);
    }


    public function render()
    {
        return view('livewire.pages.auth.partials.otp-sign-in');
    }
}
