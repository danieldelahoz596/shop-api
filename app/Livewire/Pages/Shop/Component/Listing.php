<?php

namespace App\Livewire\Pages\Shop\Component;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Listing extends Component
{
    public $user; // Change to singular since it's one user
    public $products;

    // Type-hint the User model and set the default to null
    public function mount(User $user = null)
    {
        if (!$user) {
            // For debugging: If there's no user, throw an informative error.
            throw new \Exception('No user instance passed to the Livewire component.');
        }

        $this->user = $user; // Assign the user instance to the public property

        $this->products = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('users', 'products.user_id', '=', 'users.id')
            ->where('products.user_id', $this->user->id)
            ->get();
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