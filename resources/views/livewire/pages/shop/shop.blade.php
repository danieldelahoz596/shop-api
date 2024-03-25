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
                    @foreach($categoryOption as $option)
                        <li class="option-group-button" x-on:click="$refs.select.value = '{{ $option }}'; isOpen = false;">{{ $option }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
            <select x-ref="select" class="d-none">
                @foreach($categoryOption as $option)
                <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
        </div>

          <!-- Todo: Will show this button when the user click a value in the category -->
          <div x-data="{ isOpen: false }" class="dropdown-trigger position-relative">
            <button @click="isOpen = !isOpen" class="btn btn-secondary">
                Subcategory
                <span><i class="fa-solid fa-angle-down"></i></span>
            </button>
            <div class="dropdown-container">
              <div class="dropdown-content">
                <div class="dropdown-menu-list">
                  <ul x-show="isOpen" @click.away="isOpen = false">
                      @foreach($subcategoriesOption as $category => $subcategories)
                        @foreach($subcategories as $subcategory => $items)
                              <li class="option-group-button"  x-on:click="$refs.select.value = '{{ $subcategory }}'; isOpen = false;">{{ $subcategory }}</li>
                          @endforeach
                      @endforeach
                  </ul>
                </div>
              </div>
            </div>
              <select x-ref="select" class="d-none">
              @foreach($subcategoriesOption as $subcategories)
                  @foreach($subcategories as $subcategory => $items)
                      <option value="{{ $subcategory }}">{{ $subcategory }}</option>
                  @endforeach
              @endforeach
              </select>
          </div>
          <div x-data="{ isOpen: false }" class="dropdown-trigger position-relative">
            <button @click="isOpen = !isOpen" class="btn btn-secondary">
                Sub-subcategory
                <span><i class="fa-solid fa-angle-down"></i></span>
            </button>
            <div class="dropdown-container">
              <div class="dropdown-content">
                <div class="dropdown-menu-list">
                  <ul x-show="isOpen" @click.away="isOpen = false">
                      @foreach($subcategoriesOption as $category => $subcategories)
                          @foreach($subcategories as $subcategory => $items)
                              @foreach($items as $item)
                                  <li class="option-group-button" x-on:click="$refs.select.value = '{{ $item }}'; isOpen = false;">{{ $item }}</li>
                              @endforeach
                          @endforeach
                      @endforeach
                  </ul>
                </div>
              </div>
            </div>
              <select x-ref="select" class="d-none">
              @foreach($subcategoriesOption as $category => $subcategories)
                    @foreach($subcategories as $subcategory => $items)
                        @foreach($items as $item)
                            <li class="option-group-button" x-on:click="$refs.select.value = '{{ $item }}'; isOpen = false;">{{ $item }}</li>
                        @endforeach
                    @endforeach
                @endforeach
              </select>
          </div>


          <div class="dropdown-trigger position-relative" >
            <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span>Brand</span>
              <span><i class="fa-solid fa-angle-down"></i></span>
            </button>

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
                      @foreach($styleOption as $option)
                          <li class="option-group-button" x-on:click="$refs.select.value = '{{ $option }}'; isOpen = false;">{{ $option }}</li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
              <select x-ref="select" class="d-none">
                  @foreach($styleOption as $option)
                  <option value="{{ $option }}">{{ $option }}</option>
                  @endforeach
              </select>
          </div>

          <!-- Will ask marketing about the data for size and the design -->
          <div class="dropdown-trigger position-relative">
            <button class="btn btn-secondary" type="button">
              <span>Size</span>
              <span><i class="fa-solid fa-angle-down"></i></span>
            </button>

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
                    @foreach($colorOption as $option)
                        <li class="option-group-button" x-on:click="$refs.select.value = '{{ $option }}'; isOpen = false;">
                          <div data-testid="colour-circle-{{ str_replace(' ', '-', $option) }}" id="{{ $option }}" class="option-{{ str_replace(' ', '-', $option) }}-color"></div>
                          {{ $option }}
                        </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
            <select x-ref="select" class="d-none">
                @foreach($colorOption as $option)
                <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
        </div>


          <div class="dropdown">
            <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span>Price</span>
              <span><i class="fa-solid fa-angle-down"></i></span>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
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
        <button class="active-filter d-flex align-items-center btn btn-secondary">
          Womenswear
          <i class="fa-solid fa-xmark"></i>
        </button>
        <button class="active-filter d-flex align-items-center btn btn-secondary">
          Tops
          <i class="fa-solid fa-xmark"></i>
        </button>
        <button class="active-filter d-flex align-items-center btn btn-secondary">
          Skirt
          <i class="fa-solid fa-xmark"></i>
        </button>
        <button class="reset-active-filter d-flex align-items-center">
          Clear
        </button>
      </div>
    </div>

    <div class="pt-5">
      <ul class="product-item">
        <li class="product-container">
          <div>
            <div class="product-img-container">
              <a href="" class="product-card">
                <div class="product-image">
                  <img src="{{ asset('assets/img/brands/brandimg1.jpg') }}" alt="">
                </div>
              </a>
            </div>
            <div class="product-attribute">
              <div class="product-info">
                <h4>Denim Pants</h4>
                <div class="price">P 400</div>
              </div>
              <div class="heart-icon">
                <i class="fa-regular fa-heart"></i>
              </div>
            </div>
          </div>
        </li>
        <li class="product-container">
          <div>
            <div class="product-img-container">
              <a href="" class="product-card">
                <div class="product-image">
                  <img src="{{ asset('assets/img/brands/brandimg1.jpg') }}" alt="">
                </div>
              </a>
            </div>
            <div class="product-attribute">
              <div class="product-info">
                <h4>Denim Pants</h4>
                <div class="price">P 400</div>
              </div>
              <div class="heart-icon">
                <i class="fa-regular fa-heart"></i>
              </div>
            </div>
          </div>
        </li>
        <li class="product-container">
          <div>
            <div class="product-img-container">
              <a href="" class="product-card">
                <div class="product-image">
                  <img src="{{ asset('assets/img/brands/brandimg1.jpg') }}" alt="">
                </div>
              </a>
            </div>
            <div class="product-attribute">
              <div class="product-info">
                <h4>Denim Pants</h4>
                <div class="price">P 400</div>
              </div>
              <div class="heart-icon">
                <i class="fa-regular fa-heart"></i>
              </div>
            </div>
          </div>
        </li>
        <li class="product-container">
          <div>
            <div class="product-img-container">
              <a href="" class="product-card">
                <div class="product-image">
                  <img src="{{ asset('assets/img/brands/brandimg1.jpg') }}" alt="">
                </div>
              </a>
            </div>
            <div class="product-attribute">
              <div class="product-info">
                <h4>Denim Pants</h4>
                <div class="price">P 400</div>
              </div>
              <div class="heart-icon">
                <i class="fa-regular fa-heart"></i>
              </div>
            </div>
          </div>
        </li>
        <li class="product-container">
          <div>
            <div class="product-img-container">
              <a href="" class="product-card">
                <div class="product-image">
                  <img src="{{ asset('assets/img/brands/brandimg1.jpg') }}" alt="">
                </div>
              </a>
            </div>
            <div class="product-attribute">
              <div class="product-info">
                <h4>Denim Pants</h4>
                <div class="price">P 400</div>
              </div>
              <div class="heart-icon">
                <i class="fa-regular fa-heart"></i>
              </div>
            </div>
          </div>
        </li>
        <li class="product-container">
          <div>
            <div class="product-img-container">
              <a href="" class="product-card">
                <div class="product-image">
                  <img src="{{ asset('assets/img/brands/brandimg1.jpg') }}" alt="">
                </div>
              </a>
            </div>
            <div class="product-attribute">
              <div class="product-info">
                <h4>Denim Pants</h4>
                <div class="price">P 400</div>
              </div>
              <div class="heart-icon">
                <i class="fa-regular fa-heart"></i>
              </div>
            </div>
          </div>
        </li>
        <li class="product-container">
          <div>
            <div class="product-img-container">
              <a href="" class="product-card">
                <div class="product-image">
                  <img src="{{ asset('assets/img/brands/brandimg1.jpg') }}" alt="">
                </div>
              </a>
            </div>
            <div class="product-attribute">
              <div class="product-info">
                <h4>Denim Pants</h4>
                <div class="price">P 400</div>
              </div>
              <div class="heart-icon">
                <i class="fa-regular fa-heart"></i>
              </div>
            </div>
          </div>
        </li>
        <li class="product-container">
          <div>
            <div class="product-img-container">
              <a href="" class="product-card">
                <div class="product-image">
                  <img src="{{ asset('assets/img/brands/brandimg1.jpg') }}" alt="">
                </div>
              </a>
            </div>
            <div class="product-attribute">
              <div class="product-info">
                <h4>Denim Pants</h4>
                <div class="price">P 400</div>
              </div>
              <div class="heart-icon">
                <i class="fa-regular fa-heart"></i>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>

</div>
