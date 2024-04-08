<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductsInfo extends Component
{
    public $product;
    public $quantity = 1;
    public $total;
    public $currentProduct;
    public $showRecommendations = false;
    public $lastAddedItem = null;

    public function mount(Product $product, $category_id, $product_code, $product_id)
    {
        // Load the product
        $this->product = Product::where('category_id', $category_id)->where('product_code', $product_code)->where('id', $product_id)->with('user')->firstOrFail();
        $this->total = $this->product->price;
        $this->currentProduct = Product::find($product_id);
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            return;
        }

        $cartItem = CartItem::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $this->product->id,
            ],
            [
                'quantity' => DB::raw('quantity + 1'),
                'price' => $this->product->price,
            ]
        );
        $this->lastAddedItem = [
            'name' => $this->product->product_name,
            'price' => $this->product->price,
            'image' => $this->product->image, // Assuming there is an image attribute
        ];

        // Emit an event with the last added item details
        $this->dispatch('itemAddedToCart', $this->lastAddedItem);

        $this->showRecommendations = true;
        $this->dispatch('pages.auth.recommendations', 'loadRecommendations', $this->product->id);
    }

    public function buyNow()
    {
        if (!Auth::check()) {
            session()->flash('error', 'You must be logged in to buy now.');
            return redirect()->route('login');
        }

        $order = null;

        DB::transaction(function () use (&$order) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $this->product->price,
            ]);

            $order->orderItems()->create([
                'product_id' => $this->product->id,
                'quantity' => 1,
                'price' => $this->product->price,
            ]);
        });

        if ($order) {
            session([
                'checkout' => 'single',
                'order_id' => $order->id,
            ]);

            return redirect()->to('/checkout-process');
        } else {
            session()->flash('error', 'An error occurred while processing your order.');
        }
    }
    public function render()
    {
        return view('livewire.pages.auth.products-info', [
            'product' => $this->product,
            'user' => $this->product->user,
        ]);
    }
}