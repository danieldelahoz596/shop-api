<?php

namespace App\Livewire\Pages\Shop;

use Livewire\Component;
use App\Models\User;

class Profile extends Component
{
    /**
     * Display the user's shop profile.
     *
     * @param  User  $user
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public User $user;
    public $showingSales = false;
    public $products;
    // Called when the component is instantiated
    public function profile()
    {
        $user = auth()->user();
        $this->user = $user;
    }

    public function showSales()
    {
        $this->showingSales = true;
    }

    public function showListings()
    {
        $this->showingSales = false;
    }


    public function mount()
    {
        $this->profile();
    }

    public function render()
    {
        return view('livewire.pages.shop.profile', [
            'user' => $this->user,
        ]);
    }
}
