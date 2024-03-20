<?php

namespace App\Livewire\Pages\Shop\Component;

use Livewire\Component;
use App\Models\User;

class Listing extends Component
{
    public ?User $user; // The user object, which can be null

    // We'll use mount() to initialize the component with the user object
    public function mount(User $user = null)
    {
        // Here, we check if a user was passed, and if not, we can redirect or handle the error
        if (!$user) {
            // You can redirect or throw an exception
            // For example: return redirect()->to('/'); // Redirect to a default page
            abort(404, 'User not found.'); // Or abort with a 404 error
        }

        $this->user = $user;
    }

    // The render function now doesn't need to accept User $user as a parameter anymore
    public function render()
    {
        // Ensure that we have a user object before trying to use it
        if (!$this->user) {
            // Handle the case where the user is not set
            // For example: return view('errors.user-not-found');
            abort(404, 'User not found.');
        }

        // Retrieve products only if user exists
        $products = $this->user->products()->with('category')->get();

        // Return the view with the user and products data
        return view('livewire.pages.shop.component.listing', [
            'user' => $this->user,
            'products' => $products,
        ]);
    }
}
