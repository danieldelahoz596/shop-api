<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use Carbon\Carbon;
use App\Service\LogService;

class LoginPhone extends Component
{

  public string $phone_number;
  public bool $isVerificationCodeSent;
  public $otc1, $otc2, $otc3, $otc4, $otc5, $otc6;
  public $inputCode;

  public function sendCode()
  {
    $validate = $this->validate([
      'phone_number' => 'required|min:10|exists:users,phone_number',
    ]);
    if($validate){
      $this->isVerificationCodeSent = true;
    }
  }

  public function verifyCode(){
    $inputCode = $this->otc1 . $this->otc2 . $this->otc3 . $this->otc4 . $this->otc5 . $this->otc6;
    return $inputCode;
  }

  public function render()
  {
    return view('livewire.pages.auth.login-phone');
  }
}
