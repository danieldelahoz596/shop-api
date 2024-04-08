<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubsubCategory;
use Livewire\Component;

class Preferences extends Component
{
    public $categories;
    public $subcategories;
    public $subsubcategories;

    public function updatedPreferences($value, $key)
    {
        //
    }


    public function savePreferences()
    {
       //
    }

    public function validator()
    {
        //
    }

    public function mount()
    {
        $this->categories = Category::all();
        $this->subcategories = SubCategory::all();
        $this->subsubcategories = SubsubCategory::all();
    }


    public function render()
    {
        return view('livewire.pages.preferences', [
            'categories' => $this->categories,
            'subcategories' => $this->subcategories,
            'subsubcategories' => $this->subsubcategories
        ]);
    }
}
