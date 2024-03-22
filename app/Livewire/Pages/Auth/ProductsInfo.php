<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use App\Models\Product;

class ProductsInfo extends Component
{
    public Product $products;
    public $category_id;
    public $product_code;
    public $product_id;

    public function mount(Product $products, $category_id, $product_code,  $product_id)
    {
        $this->products = $products->load('user');
        $this->category_id = $category_id;
        $this->product_code = $product_code;

        $this->product_id = $product_id;

        // Fetch the product based on the provided parameters
        $this->products = Product::where('category_id', $this->category_id)
            ->where('product_code', $this->product_code)
            ->where('id', $this->product_id)
            ->firstOrFail();

        // Load additional related data
        $this->products->load('user');
    }

    public function render()
    {
        return view('livewire.pages.auth.products-info', [
            'product' => $this->products,
            'keywords' => $this->products->keyword,
            'user' => $this->products->user
        ]);
    }
}
