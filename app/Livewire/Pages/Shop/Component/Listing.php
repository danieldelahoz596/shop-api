<?php

namespace App\Livewire\Pages\Shop\Component;

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
    public function mount(User $user = null)
    {

        $this->user = $user; // Assign the user instance to the public property

        $this->products = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('users', 'products.user_id', '=', 'users.id')
            ->where('products.user_id', $this->user->id)
            ->get();

        $this->productsCount = $this->products->count();
        $this->sales = $this->user->sales;
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