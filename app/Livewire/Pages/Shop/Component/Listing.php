<?php

namespace App\Livewire\Pages\Shop\Component;

use App\Models\Product;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Listing extends Component
{
    public $user;
    public $products;
    public $productsCount;
    public $sales;

    public $showingSales = false;

    public function showSales()
    {
        $this->showingSales = true;
    }

    public function showListings()
    {
        $this->showingSales = false;
    }
    public function mount(User $user)
    {

        $this->user = $user; // Assign the user instance to the public property

        $this->products = Product::with(['user', 'category', 'subcategory', 'subSubCategory'])->get();

        $this->productsCount = $this->products->count();
        // $this->sales = $this->user->sales;
    }


    public function render()
    {
        // No need to check $this->user again since an exception would be thrown in mount() if it wasn't set
        return view('livewire.pages.shop.component.listing', [
            'user' => $this->user,
            'products' => $this->products,
        ]);
    }
}
