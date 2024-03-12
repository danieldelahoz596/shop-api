<?php

namespace App\Livewire\Pages\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;
use App\Service\LogService;

class Login extends Component
{
    public $email,$password,$remember_me;

    public function render()
    {
        return view('livewire.pages.auth.login');
    }

    public function login(){
        $validate = $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = auth()->getProvider()->retrieveByCredentials($validate);

        if(!auth()->validate($validate)){
            $log_name = 'User login';
            $log_desc = 'User Attempt Logging in using '.$this->email;
            LogService::userLog($log_name,$log_desc);
            // $this->dispatchBrowserEvent('error_login_swal', [
            //     'title' => 'Error!',
            //     'timer'=>3000,
            //     'icon'=>'warning',
            //     'toast'=>false,
            //     'position'=>'center',
            //     'text'=>'Looks like the credentials you entered are not found',
            // ]);
            session()->flash('error', 'Looks like the credentials you entered are not found');
        }else{
            auth()->login($user, $this->rember_me);
            User::where('id', '=', auth()->user()->id)
            ->update([
                'user_lastlogin' => Carbon::now()
            ]);
            $log_name = 'User login';
            $log_desc = 'User successfull login using email '.$this->email;
            LogService::userLog($log_name,$log_desc);
            // $this->dispatchBrowserEvent('success_login_swal', [
            //     'title' => 'Success',
            //     'timer'=>3000,
            //     'icon'=>'success',
            //     'toast'=>false,
            //     'position'=>'center',
            //     'text' => 'You have logged in successfully. Welcome back! '.auth()->user()->user_firstname.' '.auth()->user()->user_lastname
            // ]);

            session()->flash('message', 'You have logged in successfully. Welcome back! '.auth()->user()->user_firstname.' '.auth()->user()->user_lastname);
        }
    }
}
