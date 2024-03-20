<?php

namespace App\Livewire\Pages\Shop\Component;

use Livewire\Component;
use App\Models\Category;

class ManageCategories extends Component
{
    public $name;

    public function addCategory()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);
        // Create a new category
        Category::create([
            'name' => $this->name
        ]);

        session()->flash('message', 'Category added successfully!');
        $this->reset('name'); // Reset the name field
    }
    public function render()
    {
        return view('livewire.pages.shop.component.manage-categories', [
            'categories' => Category::all() // Send existing categories to the view
        ]);
    }
}
