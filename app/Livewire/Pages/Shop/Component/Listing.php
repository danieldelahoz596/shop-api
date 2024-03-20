<?php

namespace App\Livewire\Pages\Shop\Component;

use Livewire\Component;
use App\Models\User;
use App\Models\Product;

class Listing extends Component
{
    public ?User $user;
    public $products;
    public function mount(User $user = null)
    {
        if (!$user) {
            abort(404, 'User not found.'); // Or abort with a 404 error
        }
        $this->products = Product::all();
        $this->user = $user;
    }

    public function render()
    {
        if (!$this->user) {
            abort(404, 'User not found.');
        }
        $products = $this->user->products()->with('category')->get();

        return view('livewire.pages.shop.component.listing', [
            'user' => $this->user,
            'products' => $products,
        ]);
    }
}