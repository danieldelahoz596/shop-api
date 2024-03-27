<div class="section-shop">
  <div class="container">
    <div class="heading display-1 fw-bolder">
      retro tops
    </div>
    <div class="filter-container">
      <div class="filter-dropdown d-flex justify-content-between mb-3">
        <div class="left d-flex">
            <div x-data="{ isOpen: false }" class="dropdown-trigger position-relative">
                <button @click="isOpen = !isOpen" class="btn btn-secondary">
                    Category
                    <span><i class="fa-solid fa-angle-down"></i></span>
                </button>
                <div class="dropdown-container">
                    <div class="dropdown-content">
                        <div class="dropdown-menu-list">
                            <ul x-show="isOpen" @click.away="isOpen = false">
                                @foreach($categories as $category)
                                    <li class="option-group-button" onclick="this.querySelector('input').click();">
                                        {{ $category->name }}
                                        <input type="checkbox" name="categoryFilter" id="categoryFilter" value="{{ $category->id }}" wire:change="fetchSubcategories({{$category->id}})" onclick="event.stopPropagation();">
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Todo: Will show this button when the user click a value in the category -->
            @if ($categoryFilter)
                <div x-data="{ isOpen: false }" class="dropdown-trigger position-relative">
                    <button @click="isOpen = !isOpen" class="btn btn-secondary">
                        Subcategory
                        <span><i class="fa-solid fa-angle-down"></i></span>
                    </button>
                    <div class="dropdown-container">
                        <div class="dropdown-content">
                            <div class="dropdown-menu-list">
                                <ul x-show="isOpen" @click.away="isOpen = false">
                                    @if ($subcategories)
                                        @foreach($subcategories as $subcategory)
                                            <li class="option-group-button" onclick="this.querySelector('input').click();">
                                                {{ $subcategory->name }}
                                                <input type="checkbox" name="subcategoryFilter" id="subcategoryFilter" value="{{ $subcategory->id }}" wire:change="fetchSubsubCategories({{$subcategory->id}})" onclick="event.stopPropagation();">
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($subcategoryFilter)
                <div x-data="{ isOpen: false }" class="dropdown-trigger position-relative">
                    <button @click="isOpen = !isOpen" class="btn btn-secondary">
                        Sub-subcategory
                        <span><i class="fa-solid fa-angle-down"></i></span>
                    </button>
                    <div class="dropdown-container">
                        <div class="dropdown-content">
                            <div class="dropdown-menu-list">
                                <ul x-show="isOpen" @click.away="isOpen = false">
                                    @if ($subsubcategories)
                                        @foreach($subsubcategories as $subsubcategory)
                                            <li class="option-group-button" onclick="this.querySelector('input').click();">
                                                {{ $subsubcategory->name }}
                                                <input type="checkbox" name="subsubcategoryFilter" id="subsubcategoryFilter" value="{{ $subsubcategory->id }}" wire:change="fetchDataSubsubCategory({{$subsubcategory->id}})" onclick="event.stopPropagation();">
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div x-data="{ isOpen: false }" class="dropdown-trigger position-relative" >
                <button @click="isOpen = !isOpen" class="btn btn-secondary" type="button">
                    <span>Brand</span>
                    <span><i class="fa-solid fa-angle-down"></i></span>
                </button>
                <div class="dropdown-container">
                    <div class="dropdown-content">
                        <div class="dropdown-menu-list">
                            <ul x-show="isOpen" @click.away="isOpen = false">
                                @if ($brands)
                                    @foreach($brands as $brand)
                                        <li class="option-group-button" onclick="this.querySelector('input').click();">
                                            {{ $brand->name }}
                                            <input type="checkbox" name="brandFilter" id="brandFilter" value="{{ $brand->name }}" wire:change='fetchDataBrands("{{ $brand->name }}")' onclick="event.stopPropagation();">
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div x-data="{ isOpen: false }" class="dropdown-trigger position-relative">
                <button @click="isOpen = !isOpen" class="btn btn-secondary">
                    Style
                    <span><i class="fa-solid fa-angle-down"></i></span>
                </button>
                <div class="dropdown-container">
                    <div class="dropdown-content">
                        <div class="dropdown-menu-list">
                            <ul x-show="isOpen" @click.away="isOpen = false">
                                @if ($styles)
                                    @foreach($styles as $style)
                                        <li class="option-group-button" onclick="this.querySelector('input').click();">
                                            {{ $style }}
                                            <input type="checkbox" name="styleFilter" id="styleFilter" value="{{ $style }}" wire:change='fetchDataStye("{{ $style }}")' onclick="event.stopPropagation();">
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Will ask marketing about the data for size and the design -->
            <div x-data="{ isOpen: false }" class="dropdown-trigger position-relative">
                <button @click="isOpen = !isOpen" class="btn btn-secondary" type="button">
                    <span>Size</span>
                    <span><i class="fa-solid fa-angle-down"></i></span>
                </button>
                <div class="dropdown-container">
                    <div class="dropdown-content">
                        <div class="dropdown-menu-list">
                            <ul x-show="isOpen" @click.away="isOpen = false">
                                @if ($sizes)
                                    @foreach($sizes as $size)
                                        <li class="option-group-button" onclick="this.querySelector('input').click();">
                                            {{ $size }}
                                            <input type="checkbox" name="styleFilter" id="styleFilter" value="{{ $size }}" wire:change='fetchDataSize("{{ $size }}")' onclick="event.stopPropagation();">
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div x-data="{ isOpen: false }" class="dropdown-trigger position-relative">
                <button @click="isOpen = !isOpen" class="btn btn-secondary">
                    Colour
                    <span><i class="fa-solid fa-angle-down"></i></span>
                </button>
                <div class="dropdown-container">
                    <div class="dropdown-content">
                        <div class="dropdown-menu-list">
                            <ul x-show="isOpen" @click.away="isOpen = false">
                                @foreach($colors as $color)
                                    <li class="option-group-button" onclick="this.querySelector('input').click();">
                                        <span style="display: flex">
                                            <div data-testid="colour-circle-{{ str_replace(' ', '-', $color) }}" id="{{ $color }}" class="option-{{ str_replace(' ', '-', $color) }}-color"></div>
                                            {{ $color }}
                                        </span>
                                        <input type="checkbox" name="colorFilter" id="colorFilter" value="{{ $color }}" wire:change='fetchDataColor("{{ $color }}")' onclick="event.stopPropagation();">
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown">
                <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>Price</span>
                    <span><i class="fa-solid fa-angle-down"></i></span>
                </button>
                <ul class="dropdown-menu">
                    <li class="dropdown-item" style="cursor: pointer" wire:click='fetchDataPrice("asc")'>
                        <b>
                            Low to High
                            <span class="px-3">
                                <i class="fa-solid fa-long-arrow-down"></i>
                            </span>
                        </b>
                    </li>
                    <li class="dropdown-item" style="cursor: pointer" wire:click='fetchDataPrice("desc")'>
                       <b>
                            High to Low
                            <span class="px-3">
                                <i class="fa-solid fa-long-arrow-up "></i>
                            </span>
                       </b>
                    </li>
                </ul>
            </div>
        </div>

        <div class="right d-flex">
          <div class="checkbox-container">
            <input type="checkbox">
            <span>On sale</span>
          </div>
          <div class="dropdown">
            <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span>Sort By</span>
              <span><i class="fa-solid fa-angle-down"></i></span>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="filter-result d-flex">
        @if ($filterKeywords)
            @foreach ($filterKeywords as $filterKeyword)
                <button class="active-filter d-flex align-items-center btn btn-secondary">
                    {{ $filterKeyword }}
                    <i class="fa-solid fa-xmark"></i>
                </button>
            @endforeach
            <a href="/shop/all" class="reset-active-filter d-flex align-items-center">
                Clear
            </a>
        @endif
      </div>
    </div>

    <div class="pt-5">
      <ul class="product-item">
        @foreach ($products as $product)
            <li class="product-container">
                <div>
                <div class="product-img-container">
                    <a href="" class="product-card">
                        @php
                            $image = $product->images->first();
                        @endphp
                        <div class="product-image">
                            @if ($image)
                                <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $product->product_name }}">
                            @else
                                <img src="{{ asset('assets/img/brands/brandimg1.jpg') }}" alt="">
                            @endif
                        </div>
                    </a>
                </div>
                <div class="product-attribute">
                    <div class="product-info">
                    <h4>{{ $product->product_name }}</h4>
                    <div class="price">P {{ $product->price }}</div>
                    </div>
                    <div class="heart-icon">
                    <i class="fa-regular fa-heart"></i>
                    </div>
                </div>
                </div>
            </li>
        @endforeach
      </ul>
    </div>
  </div>

</div>
