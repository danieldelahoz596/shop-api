<?php

namespace App\Livewire\Pages\Shop\Component;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Purchases extends Component
{
    public $sales;
    public $user;
    public $productsSoldCount;

    public function mount(User $user = null)
    {
        $this->user = $user;
        // $this->productSold = $user->products()
        //     ->withCount('productSold')
        //     ->get();
        $this->sales = DB::table('product_solds')
            ->leftJoin('products', 'product_solds.product_id', '=', 'products.id')
            ->select('products.product_name', 'product_solds.*')
            ->where('product_solds.user_id', $user->id)
            ->get();
        $this->productsSoldCount = $this->sales->count();
    }
    public function render()
    {
        return view('livewire.pages.shop.component.purchases');
    }
}