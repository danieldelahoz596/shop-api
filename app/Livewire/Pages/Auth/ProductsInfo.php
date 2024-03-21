<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use App\Models\Product;

class ProductsInfo extends Component
{
    public Product $products;

    // Remove the public $keywords; line if you no longer need it

    public function mount(Product $products)
    {
        $this->products = $products->load('user');
    }

    public function render()
    {
        // If you have the cast set up in your model, you can just pass the attribute.
        return view('livewire.pages.auth.products-info', [
            'product' => $this->products,
            'keywords' => $this->products->keyword, // Assuming the 'keyword' attribute is already an array
            'user' => $this->products->user
        ]);
    }
}