<?php

namespace App\Livewire\Pages\Shop;

use App\Enum\ColorEnum;
use App\Enum\SizeEnum;
use App\Enum\StyleEnum;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{

    public $categoryOption = ['Women', 'Menswear', 'Kids'];
    public $styleOption = [
      'Retro',
      'Vintage',
      'Y2K',
      'Streetwear',
      'Athleisure',
      'Casual',
      'Formal',
      'Glam',
      'Cottage',
      'Punk',
      'Preppy & Chic',
      'Utility'
    ];
    public $colorOption = [
      'Black',
      'White',
      'Gray',
      'Beige',
      'Red',
      'Blue',
      'Green',
      'Yellow',
      'Purple',
      'Pink',
      'Orange',
      'Brown',
      'Navy Blue',
      'Silver',
      'Gold',
      'Multicolor'
    ];
    public $subcategoriesOption = [
      'Menswear' => [
          'Tops' => ['T-shirts', 'Polos', 'Casual Shirts', 'Dress Shirts', 'Sweaters'],
          'Bottoms' => ['Jeans', 'Chinos', 'Dress Pants', 'Shorts'],
          'Suits and Formal Wear' => ['Suits', 'Blazers', 'Dress Shirts', 'Ties'],
          'Activewear' => ['Athletic T-shirts', 'Sports Jerseys', 'Athletic Shorts', 'Track Pants'],
          'Outerwear' => ['Jackets', 'Coats', 'Hoodies', 'Vests'],
          'Casual Wear' => ['Hoodies', 'Casual Jackets', 'Casual Shirts'],
          'Swimwear' => ['Swim Trunks', 'Board Shorts'],
          'Underwear' => ['Boxers', 'Briefs', 'Boxer Briefs'],
          'Sleepwear' => ['Pajamas', 'Lounge Pants'],
          'Accessories' => ['Ties', 'Belts', 'Hats']
        ]
    ];

    
    
  
    use WithPagination;

    public $category;
    public $categoryFilter;
    public $subcategoryfilter;
    public $brand;
    public $style;
    public $size;
    public $color;
    public $price;
    public $sale;
    public $sort;

    protected $listeners = ['searchProducts' => 'updateProducts'];

    public function mount($category = null)
    {
        $this->category = $category ?: request('keyword');
    }

    public function updateProducts($keyword)
    {
        $this->category = $keyword;
    }

    public function shopData()
    {
        $query = Product::query();

        if ($this->category) {
            if ($this->category === 'all') {
                $products = $query;
            } else if($this->category === 'steals') {
                $products = $this->steals($query);
            } else {
                $products = $this->filteredData($query);
            }
        }

        if ($this->categoryFilter) {
            $query->whereHas('category', function($query) {
                $query->where('slug', $this->categoryFilter);
            });
        }

        if ($this->subcategoryfilter) {
            $query->orWhereHas('subcategory', function($query) {
                $query->where('slug', $this->subcategoryfilter);
            });
        }

        if ($this->brand) {
            foreach ($this->brand as $brand) {
                $query->orWhere('product_brand', $brand);
            }
        }

        if ($this->style) {
            foreach ($this->style as $style) {
                $query->orWhere('style', $style);
            }
        }

        if ($this->size) {
            foreach ($this->size as $size) {
                $query->orWhereJsonContains('size', $size);
            }
        }

        if ($this->color) {
            foreach ($this->color as $color) {
                $query->orWhere('color', $color);
            }
        }

        if ($this->price) {
            $query->whereBetween('price', [$this->price['min'], $this->price['max']]);
        }

        if ($this->sale) {
            $query->orWhere('discount', '>', 0);
        }

        if ($this->sort) {
            $query->orderBy('product_name', 'asc');
        }

        return $products->orderBy('created_at', 'asc')->paginate(20);
    }

    public function steals($query)
    {
        return $query->whereHas('productSold', function($query) {
            $query->where('item_quantity', '>=', 50);
        });
    }

    public function filteredData($query)
    {
        return $query->whereHas('category', function($query) {
            $query->where('slug', $this->category);
        })->orWhereHas('subcategory', function($query) {
            $query->where('slug', $this->category);
        })->orWhere('product_brand', $this->category)
        ->orWhere('product_name', 'like', '%'.$this->category.'%')
        ->orWhereJsonContains('size', $this->category)
        ->orWhereJsonContains('keyword', 'like', '%'.ucfirst($this->category).'%');
    }

    public function categories()
    {
        return Category::all();
    }

    public function subcategories()
    {
        return SubCategory::all();
    }

    public function brands()
    {
        return Brand::all();
    }

    public function render()
    {
        $products = $this->shopData();
        $categories = $this->categories();
        $subcategories = $this->subcategories();
        $brands = $this->brands();

        $styles = StyleEnum::values();
        $colors = ColorEnum::values();
        $sizes = SizeEnum::values();

        return view('livewire.pages.shop.shop', [
            'products' => $products,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'brands' => $brands,
            'styles' => $styles,
            'colors' => $colors,
            'sizes' => $sizes
        ]);
    }
}
