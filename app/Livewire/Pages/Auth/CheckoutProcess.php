<?php

namespace App\Livewire\Pages\Auth;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CheckoutProcess extends Component
{
    public $isSingleProductCheckout = false;
    public $singleProduct = null;
    public $cartItems = [];
    public $total = 0;
    public $name, $email, $phoneNumber, $address;
    public $step = 1;
    public $sellers = [];

    public function mount()
    {
        $this->loadUserInfo();
        $this->isSingleProductCheckout = session('checkout') === 'single';

        if ($this->isSingleProductCheckout) {
            $order = Order::with('orderItems.product.user')->findOrFail(session('order_id'));
            $product = $order->orderItems->first()->product;
            $this->singleProduct = $product->toArray();
            $this->sellers[$product->user->id] = $product->user; // Save seller info
            $this->total = $order->total;
        } else {
            $this->loadCartItems();
        }
    }

    protected function loadCartItems()
    {
        $user = Auth::user();

        $this->cartItems = $user->cartItems()->with('product.user')->get();
        $this->total = $this->cartItems->sum(function ($cartItem) {
            // Accumulate the seller information
            $this->sellers[$cartItem->product->user->id] = $cartItem->product->user;
            return $cartItem->product->price * $cartItem->quantity;
        });
    }

    protected function loadUserInfo()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phoneNumber = $user->phone_number; // Assuming the phone number is complete
        $this->address = $user->address;
    }

    public function nextStep()
    {
        $this->step++;
    }

    public function render()
    {
        return view('livewire.pages.auth.checkout-process', [
            'sellers' => $this->sellers
        ]);
    }
}