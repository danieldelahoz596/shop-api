<?php

namespace App\Livewire\Pages\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Login extends Component
{

  

  public $email = '';
  public $password = '';

  public function LogIn()
  {
    $credentials = $this->validate([
      'email' => ['required', 'email'],
      'password' => 'required'
    ]);

    

  }

  public function render()
  {
    return view('livewire.pages.auth.login');
  }
}
