<?php

namespace App\Livewire\Components\Landing;

use App\Models\Product;
use Livewire\Component;

class FeaturedItem extends Component
{
    public $featuredItems;

    public function featuredItems()
    {
        $this->featuredItems = Product::where('is_featured', true)->get();
    }

    public function mount()
    {
        $this->featuredItems();
    }

    public function render()
    {
        return view('livewire.components.landing.featured-item', [
            'featuredItems' => $this->featuredItems
        ]);
    }
}
