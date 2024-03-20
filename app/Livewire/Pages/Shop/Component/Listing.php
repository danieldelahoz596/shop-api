<?php

namespace App\Livewire\Pages\Shop\Component;

use Livewire\Component;
use App\Models\User;
use App\Models\Product;

class Listing extends Component
{
    public $user;
    public $products;
    public function mount(User $user)
    {
        $this->user = $user;
        $this->products = Product::all();
        // $this->products = $this->user->products()->with('category')->get();

        // // Debug the loaded products
        // logger()->info($this->products);
    }

    public function render()
    {
        if (!$this->user) {
            abort(404, 'User not found.');
        }
        $products = $this->user->products()->with('category')->get();

        return view('livewire.pages.shop.component.listing', [
            'user' => $this->user,
            'products' => $this->products,
        ]);
    }
}
