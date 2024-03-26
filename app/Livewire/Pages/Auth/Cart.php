<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Support\Facades\Session;

class Cart extends Component
{
    public $cartItems = [];
    public $total = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        if (auth()->check()) {
            $this->cartItems = auth()->user()->cartItems()->with('product')->get();
            $this->total = $this->cartItems->reduce(function ($carry, $item) {
                return $carry + ($item->quantity * $item->product->price);
            }, 0);
        }
    }

    public function checkout()
    {
        if (!auth()->check()) {
            session()->flash('error', 'You must be logged in to checkout.');
            return redirect()->route('login');
        }

        $cartItems = auth()->user()->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            session()->flash('error', 'Your cart is empty.');
            return;
        }

        session(['checkout' => 'full']);
        return redirect()->route('checkout.process');
    }


    public function render()
    {
        return view('livewire.pages.auth.cart');
    }
}
