<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\User;
use App\Service\LogService;


class EmailVerify extends Component
{
    public $token, $message;

    public function mount($token)
    {
        $this->token = $token;
        $userData = User::where('email_verify_token', $this->token)->first();

        if (empty($userData)) {
            $message = 'This token has expire or not found';
        } else {
            User::where('id', $userData->id)->update([
                'email_verify_token' => null,
                'email_verified_at' => Carbon::now()
            ]);

            $log_name = 'User verified email';
            $log_desc = 'User verified email for user: ' . $userData->name;
            LogService::userLog($log_name, $log_desc);

            $message = 'You have successfully verified';
        }

        $this->message = $message;
    }

    public function render()
    {
        return view('livewire.pages.auth.email-verify')->with(['message' => $this->message]);
    }
}