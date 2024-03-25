<?php

namespace App\Livewire\Pages\Shop;

use Livewire\Component;
use App\Models\User;

class Profile extends Component
{
    public User $user;
    public $activeTab = 1;

    // Called when the component is instantiated
    public function mount()
    {
        $this->user = auth()->user();
    }

    public function setActiveTab($tabNumber)
    {
        $this->activeTab = $tabNumber;
        $this->dispatchBrowserEvent('contentChanged');
    }

    public function render()
    {
        return view('livewire.pages.shop.profile', [
            'user' => $this->user,
            'activeTab' => $this->activeTab,
        ]);
    }
}
