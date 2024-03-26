<?php

namespace App\Livewire\Pages\Auth;

use App\Models\Order;
use Livewire\Component;
use Auth;

class CheckoutProcess extends Component
{
    public $isSingleProductCheckout = false;
    public $singleProduct = null;
    public $cartItems = [];
    public $total = 0;
    public $name, $email, $phoneNumber, $address;
    public $step = 1;

    public function mount()
    {

        $this->loadUserInfo();
        $this->isSingleProductCheckout = session('checkout') === 'single';

        if ($this->isSingleProductCheckout) {
            $order = Order::with('orderItems.product')->findOrFail(session('order_id'));
            // Assuming you want to display order summary for a single product
            $this->singleProduct = $order->orderItems->first()->product->toArray();
            $this->total = $order->total;
        } else {
            // Load full cart
            $this->cartItems = auth()->user()->cartItems()->with('product')->get();
            $this->total = $this->cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });
        }
    }

    protected function loadCartItems()
    {
        $user = auth()->user();

        $this->cartItems = $user->cartItems()->with('product')->get();
        $this->total = $this->cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });
    }

    protected function loadUserInfo()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phoneNumber = "+63" . $user->phone_number;
        $this->address = $user->address;
    }
    public function nextStep()
    {
        $this->step++;
    }

    public function render()
    {
        return view('livewire.pages.auth.checkout-process');
    }
}
