<?php

namespace App\Livewire\Components\Landing;

use App\Models\Product;
use Livewire\Component;

class PopularItems extends Component
{
    public $popularItems;

    public function popularItems()
    {
        $this->popularItems = Product::limit(10)->get();
    }

    public function mount()
    {
        $this->popularItems();
    }

    public function render()
    {
        return view('livewire.components.landing.popular-items', [
            'popularItems' => $this->popularItems
        ]);
    }
}
