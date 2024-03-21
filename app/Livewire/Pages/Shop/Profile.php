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
    // Called when the component is instantiated
    public function profile(User $user)
    {
        $this->user = $user;
        $products = $user->products()->with('category')->get();
        return view('user.profile', compact('user', 'products'));
    }
    public function showSales()
    {
        $this->showingSales = true;
    }

    public function showListings()
    {
        $this->showingSales = false;
    }




    public function render(User $user)
    {
        return view('livewire.pages.shop.profile', ['user' => $user]);
    }
}