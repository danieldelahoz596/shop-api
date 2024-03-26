<?php

namespace App\Livewire\Components\Landing\MobileView;

use App\Models\Product;
use App\Models\SubCategory;
use Livewire\Component;

class Steals extends Component
{
  public $popularItems;
  public $subCategories;

  public function popularItems()
  {
      $this->popularItems = Product::limit(10)->get();
  }

  public function subCategories()
  {
      $this->subCategories = SubCategory::all();
  }

  public function mount()
  {
      $this->popularItems();
      $this->subCategories();
  }

  public function render()
  {
      return view('livewire.components.landing.mobile-view.steals', [
          'popularItems' => $this->popularItems,
          'subCategories' => $this->subCategories
      ]);
  }
}
