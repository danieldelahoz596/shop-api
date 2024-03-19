<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Nav extends Component
{
    public function logout()
    {
        Auth::logout();
        $this->dispatch('logout_swal', [
            'title' => 'Success',
            'timer' => 3000,
            'icon' => 'success',
            'toast' => false,
            'position' => 'center',
            'text' => 'You have logged out successfully.'
        ]);

        session()->flash('message', 'You have logged out successfully.');
    }

    public function render()
    {
        return view('livewire.components.nav');
    }
}
