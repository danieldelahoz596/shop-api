<?php

namespace App\Livewire\Pages\Shop;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;

    public $category;

    protected $listeners = ['searchProducts' => 'updateProducts'];

    public function mount($category = null)
    {
        $this->category = $category ?: request('keyword');
    }

    public function updateProducts($keyword)
    {
        $this->category = $keyword;
    }

    public function shopData()
    {
        $query = Product::query();

        if ($this->category) {
            if ($this->category === 'all') {
                $products = $query;
            } else if($this->category === 'steals') {
                $products = $this->steals($query);
            } else {
                $products = $this->filteredData($query);
            }
        }

        return $products->paginate(10);
    }

    public function steals($query)
    {
        return $query->whereHas('productSold', function($query) {
            $query->where('item_quantity', '>=', 50);
        });
    }

    public function filteredData($query)
    {
        return $query->whereHas('category', function($query) {
            $query->where('slug', $this->category);
        })->orWhereHas('subcategory', function($query) {
            $query->where('slug', $this->category);
        })->orWhere('product_brand', $this->category)
        ->orWhere('product_name', 'like', '%'.$this->category.'%')
        ->orWhereJsonContains('size', $this->category)
        ->orWhereJsonContains('keyword', $this->category);
    }

    public function render()
    {
        $products = $this->shopData();

        return view('livewire.pages.shop.shop', [
            'products' => $products
        ]);
    }
}
