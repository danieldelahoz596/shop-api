<?php

namespace App\Livewire\Components\Landing;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;

class Brands extends Component
{
    public $pBrands, $brands;

    public function popularBrands()
    {
        $this->pBrands = Brand::all();
    }

    public function brands()
    {
        $this->brands = Product::limit(5)->get();
    }

    public function mount()
    {
        $this->popularBrands();
        $this->brands();
    }

    public function render()
    {
        return view('livewire.components.landing.brands', [
            'pBrands' => $this->pBrands,
            'brands' => $this->brands
        ]);
    }
}
