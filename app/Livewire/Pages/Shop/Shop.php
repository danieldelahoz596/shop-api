<?php

namespace App\Livewire\Pages\Shop;

use App\Enum\ColorEnum;
use App\Enum\SizeEnum;
use App\Enum\StyleEnum;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubsubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;

    public $category;
    public $categoryFilter;
    public $subcategoryFilter;
    public $subsubcategoryFilter;
    public $brandFilter;
    public $styleFilter;
    public $sizeFilter;
    public $colorFilter;
    public $priceFilter;
    public $sale;
    public $sort;

    public $categories;
    public $subcategories;
    public $subsubcategories;
    public $brands;
    public $styles;
    public $sizes;
    public $colors;

    public $filterKeywords = [];

    // protected $listeners = ['fetchSubcategories', 'searchProducts' => 'updateProducts'];
    protected $listeners = ['fetchSubcategories'];

    // protected $queryString = ['categoryFilter', 'subcategoryFilter'];

    public function mount($category = null)
    {
        $this->category = $category ?: request('keyword');

        $this->categories = Category::all();
        $this->brands = Brand::all();
        $this->styles = StyleEnum::values();
        $this->sizes = SizeEnum::values();
        $this->colors = ColorEnum::values();

        $this->subcategories = collect();
        $this->subsubcategories = collect();
    }

    public function updateProducts($keyword)
    {
        $this->category = $keyword;
    }

    public function shopData()
    {
        $query = Product::query();
        $products = $query;

        if ($this->category) {
            if ($this->category === 'all') {
                $products = $query;
            } else if ($this->category === 'steals') {
                $products = $this->steals($query);
            } else {
                $products = $this->filteredData($query);
            }
        }

        if ($this->categoryFilter) {
            $this->filterKeywords = [];
            $query->orWhere('category_id', $this->categoryFilter);
            $catName = Category::find($this->categoryFilter);
            $this->filterKeywords[] = $catName->name;
        }

        if ($this->subcategoryFilter) {
            $query->orWhere('subcategory_id', $this->subcategoryFilter);
            $catName = SubCategory::find($this->subcategoryFilter);
            $this->filterKeywords[] = $catName->name;
        }

        if ($this->subsubcategoryFilter) {
            $query->orWhere('sub_subcategory_id', $this->subsubcategoryFilter);
            $catName = SubsubCategory::find($this->subsubcategoryFilter);
            $this->filterKeywords[] = $catName->name;
        }

        if ($this->brandFilter) {
            $query->orWhere('product_brand', $this->brandFilter);
            $this->filterKeywords[] = $this->brandFilter;
        }

        if ($this->styleFilter) {
            $query->orWhere('style', $this->styleFilter);
            $this->filterKeywords[] = $this->styleFilter;
        }

        if ($this->sizeFilter) {
            $query->orWhereJsonContains('size', $this->sizeFilter);
            $this->filterKeywords[] = $this->sizeFilter;
        }

        if ($this->colorFilter) {
            $query->orWhere('color', $this->colorFilter);
            $this->filterKeywords[] = $this->colorFilter;
        }

        if ($this->priceFilter) {
            $query->orderBy('price', $this->priceFilter);
            if ($this->priceFilter === 'asc') {
                $this->filterKeywords = [];
                $this->filterKeywords[] = 'Low to High';
            } else {
                $this->filterKeywords = [];
                $this->filterKeywords[] = 'High to Low';
            }

        }

        if ($this->sale) {
            $query->orWhere('discount', '>', 0);
        }

        if ($this->sort) {
            $query->orderBy('product_name', 'asc');
        }

        return $products->orderBy('created_at', 'desc')->paginate(20);
    }

    public function steals($query)
    {
        return $query->whereHas('sales', function($query) {
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
        ->orWhereJsonContains('keyword', ucfirst($this->category));
    }

    public function fetchSubcategories($value)
    {
        $this->categoryFilter = $value;
        $this->subcategories = SubCategory::where('category_id', $value)->get();
        $this->shopData();
        $this->render();
    }

    public function fetchSubsubCategories($value)
    {
        $data = SubsubCategory::where('subcategory_id', $value)->get();

        $this->subcategoryFilter = $value;
        if ($data->count() > 0) {
            $this->subsubcategories = $data;
        } else {
            $this->subsubcategories = collect();
        }
        $this->shopData();
        $this->render();
    }

    public function fetchDataSubsubCategory($value)
    {
        return $this->subsubcategoryFilter = $value;
    }

    public function fetchDataBrands($value)
    {
        return $this->brandFilter = $value;
    }

    public function fetchDataStye($value)
    {
        return $this->styleFilter = $value;
    }

    public function fetchDataSize($value)
    {
        return $this->sizeFilter = $value;
    }

    public function fetchDataColor($value)
    {
        return $this->colorFilter = $value;
    }

    public function fetchDataPrice($value)
    {
        return $this->priceFilter = $value;
    }

    public function render()
    {
        $products = $this->shopData();

        return view('livewire.pages.shop.shop', [
            'products' => $products,
            'categories' => $this->categories,
            'subcategories' => $this->subcategories,
            'subsubcategories' => $this->subsubcategories,
            'brands' => $this->brands,
            'styles' => $this->styles,
            'colors' => $this->colors,
            'sizes' => $this->sizes,
            'filterKeywords' => $this->filterKeywords
        ]);
    }
}
