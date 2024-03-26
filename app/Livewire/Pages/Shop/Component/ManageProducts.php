<?php

namespace App\Livewire\Pages\Shop\Component;

use App\Enum\ColorEnum;
use App\Enum\ConditionEnum;
use App\Enum\SizeEnum;
use App\Enum\StyleEnum;
use App\Enum\TagEnum;
use App\Models\Brand;
use Livewire\Component;
use App\Models\Product;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\Image;
use App\Models\Measurement;
use App\Models\SubsubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ManageProducts extends Component
{
    use WithFileUploads;
    public $product_name;
    public $name;
    public $product_description;
    public $price;
    public $category_id;
    public $subcategory_id;
    public $sub_subcategory_id;
    public $images = [];
    public $subsubcategories;
    public $condition;
    public $brand;
    public $style;
    public $size = [];
    public $keyword;
    public $tags;
    public $product_brand;
    public $color;
    public $categories;
    public $subcategories;
    public $user;
    public $brands;
    public $conditions;
    public $styles;
    public $colors;
    public $sizes;
    public $listings;
    public $keywords;

    public $measurement = 'in';
    public $chest;
    public $shoulders;
    public $sleeve_length;
    public $length;
    public $hem;

    public $listeners = ['fetchSubcategories', 'fetchSubsubCategories', 'measurements'];

    public function mount()
    {
        $user = auth()->user();
        $this->categories = Category::all();

        $this->subcategories = collect();
        $this->subsubcategories = collect();

        $this->brands = Brand::all();
        $this->colors = ColorEnum::values();
        $this->styles = StyleEnum::values();
        $this->conditions = ConditionEnum::values();
        $this->sizes = SizeEnum::values();
        $this->keywords = TagEnum::values();
        $this->user = $user;
    }

    public function fetchSubcategories($value)
    {
        return $this->subcategories = SubCategory::where('category_id', $value)->get();
    }

    public function fetchSubsubCategories($value)
    {
        $data = SubsubCategory::where('subcategory_id', $value)->get();

        if ($data->count() > 0) {
            return $this->subsubcategories = $data;
        } else {
            return $this->subsubcategories = collect();
        }
    }

    public function measurements($value)
    {
        return $this->measurement = $value;
    }

    public function addProduct()
    {
        $slug = strtolower(str_replace(' ', '-', $this->product_name));

        $tags = explode(', ', $this->tags);

        $product = Product::create([
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id,
            'sub_subcategory_id' => $this->sub_subcategory_id,
            'user_id' => $this->user->id,
            'product_code' => '',
            'product_name' => $this->product_name,
            'product_description' => $this->product_description,
            'product_brand' => $this->product_brand,
            'slug' => $slug,
            'price' => $this->price,
            'quantity' => 1,
            'size' => $this->size,
            'style' => $this->style,
            'color' => $this->color,
            'condition' => $this->condition,
            'keyword' => $tags,
            'status' => 1,
            'listings' => $this->listings,
            // 'image' =>  $imagePath,
        ]);

        if ($this->chest || $this->shoulders || $this->sleeve_length || $this->length || $this->hem) {
            Measurement::create([
                'product_id' => $product->id,
                'measurement_symbol' => $this->measurement,
                'chest' => $this->chest,
                'shoulders' => $this->shoulders,
                'sleeve_length' => $this->sleeve_length,
                'length' => $this->length,
                'hem' => $this->hem
            ]);
        }

        // Handle image uploads if they are included
        foreach($this->images as $key => $image) {
            $file = 'product_'.($key + 1).'-'.$product->id.'_'.$product->slug.'-'.$product->user_id.'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs("productimages/{$product->user_id}", $file, 'public');

            Image::create([
                'product_id' => $product->id,
                'filename' => $file,
                'path' => $path
            ]);
        }

        $this->dispatch('success_add_product', [
            'title' => 'Success',
            'timer' => 3000,
            'icon' => 'success',
            'toast' => false,
            'position' => 'center',
            'text' => 'Product listed successfully!'
        ]);
        session()->flash('message', 'Product listed successfully!');
    }

    public function render()
    {
        return view('livewire.pages.shop.component.manage-products', [
            'categories' => $this->categories,
            'subcategories' => $this->subcategories,
            'subsubcategories' => $this->subsubcategories,
            'brands' => $this->brands,
            'colors' => $this->colors,
            'styles' => $this->styles,
            'conditions' => $this->conditions,
            'sizes' => $this->sizes,
            'keywords' => $this->keywords,
        ]);
    }
}
