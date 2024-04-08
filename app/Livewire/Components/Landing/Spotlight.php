<?php

namespace App\Livewire\Components\Landing;

use App\Models\User;
use Livewire\Component;

class Spotlight extends Component
{
    public $owners;

    public function shopOwners()
    {
        $this->owners = User::orderBy('id', 'desc')->get();
    }

    public function mount()
    {
        $this->shopOwners();
    }

    public function render()
    {
        return view('livewire.components.landing.spotlight', [
            'owners' => $this->owners
        ]);
    }
}
