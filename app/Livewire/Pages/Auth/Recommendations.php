<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use App\Models\Product;

class Recommendations extends Component
{
    public $product; // Current product being viewed
    public $recommendedProducts = [];
    public $sellerProducts = [];
    public $categoryProducts = [];


    protected $listeners = ['loadRecommendations' => 'loadRelatedProducts'];


    public function loadRelatedProducts($productId = null)
    {
        $productId = $productId ?: $this->product->id;
        $this->sellerProducts = Product::where('user_id', $this->product->user_id)
            ->where('id', '!=', $productId)
            ->limit(5)
            ->get();

        $this->categoryProducts = Product::where('category_id', $this->product->category_id)
            ->where('id', '!=', $productId)
            ->limit(5)
            ->get();
    }


    public function mount(Product $product)
    {
        $this->product = $product;
        $this->loadRelatedProducts();
    }

    public function render()
    {
        return view('livewire.pages.auth.recommendations', [
            'recommendedProducts' => $this->recommendedProducts,
        ]);
    }
}