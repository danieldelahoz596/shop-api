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
    public $totalsPerSeller;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        if (auth()->check()) {
            $cartItems = auth()->user()->cartItems()->with('product.user')->get();


            $this->cartItems = $cartItems->groupBy('product.user_id')->map(function ($group) {
                return collect($group);
            });


            $this->totalsPerSeller = $this->cartItems->mapWithKeys(function ($items, $sellerId) {
                // Here $items is definitely a collection
                $total = $items->reduce(function ($carry, $item) {
                    return $carry + ($item->quantity * $item->product->price);
                }, 0);
                return [$sellerId => $total];
            });


            // Calculate grand total
            $this->total = $this->totalsPerSeller->sum();
        }
    }

    public function deleteItem($itemId)
    {
        $item = CartItem::find($itemId);
        if ($item) {
            $item->delete();
            session()->flash('success', 'Item removed from cart.');
            $this->loadCart(); // Refresh cart items and total
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