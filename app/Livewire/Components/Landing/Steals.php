<?php

namespace App\Livewire\Components\Landing;

use App\Models\Sale;
use Livewire\Component;

class Steals extends Component
{
    public $steals;

    public function getAllSteals()
    {
        $this->steals = Sale::with('product')->where('item_quantity', '>=', 50)->limit(4)->get();
    }

    public function mount()
    {
        $this->getAllSteals();
    }

    public function render()
    {
        return view('livewire.components.landing.steals', [
            'steals' => $this->steals
        ]);
    }
}
