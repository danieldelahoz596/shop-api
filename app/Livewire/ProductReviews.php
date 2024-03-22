<?php

namespace App\Livewire;

use Livewire\Component;

class ProductReviews extends Component
{
    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        $reviews = $this->product->reviews()->with('user')->latest()->get();

        return view('livewire.product-reviews', compact('reviews'));
    }
}
