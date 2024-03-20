<?php

namespace App\Livewire\Pages\Shop\Component;

use App\Models\Brand;
use Livewire\Component;
use App\Models\Product;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ManageProducts extends Component
{
    use WithFileUploads;
    public $product_name;
    public $name;
    public $product_description;
    public $product_price;
    public $category_id;
    public $subcategory_id;
    public $image;
    public $images;
    public $categories;
    public $subcategories;
    public $user;
    public $slug;
    public $product_user_id;
    public $product_code;
    public $brands;
    public $product_brand;
    public $quantity;

    public function mount(User $user)
    {
        $this->categories = Category::all();
        $this->subcategories = SubCategory::all();
        $this->brands = Brand::all();
        $this->user = $user; // Assuming the user is already authenticated
    }

    public function addProduct()
    {

        $path = $this->images->store('/assets/img/product-images');
        $this->images = $path;
        Product::create([
            'user_id' => $this->user->id, // Use the authenticated user ID
            'product_name' => $this->product_name,
            'product_description' => $this->product_description,
            'price' => $this->product_price,
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id,
            'product_code' => $this->product_code,
            'slug' => $this->slug,
            'product_brand' => $this->product_brand,
            'quantity' => $this->quantity,
            'keyword' => '["dress","tops","sportswear"]',
            'status' => 1,
            'image' => $this->images,
        ]);

        // Handle image uploads if they are included


        session()->flash('message', 'Product listed successfully!');
        $this->reset(); // Reset specific fields
    }

    public function render()
    {
        return view('livewire.pages.shop.component.manage-products');
    }
}
