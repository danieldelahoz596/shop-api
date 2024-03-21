<div class="section-shop">
  <div class="container">
    <div class="display-1">
      retro tops
    </div>
    <div class="filter-container">
      <div class="filter-dropdown d-flex justify-content-between mb-3">
        <div class="left d-flex">
          <div class="dropdown-trigger position-relative" x-data="{open:false, menu1:false, menu2:false, menu3:false}">
            <button class="btn btn-secondary" type="button" x-on:click="open = ! open">
              <span>Category</span>
              <span><i class="fa-solid fa-angle-down"></i></span>
            </button>
            <div class="dropdown-container" x-show="open" @click.away="open = false">
              <div class="dropdown-content">
                <div class="dropdown-menu-list d-flex flex-column">
                  <button class="option-group-button" x-on:click="menu1 = ! menu1">
                    <span>Women</span>
                    <span><i class="fa-solid fa-angle-down"></i></span>
                  </button>
                  <div class="option-group-list" x-show="menu1" @click.away="{open:false, menu1:false}">
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Tops</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Bottoms</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Dresses</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Rompers and Bodysuits</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Outerwear</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Activewear</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Swimwear</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Undergarments</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Sleepwear</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Accessories</p>
                        <input type="checkbox">
                      </label>
                    </div>
                  </div>

                  <button class="option-group-button" x-on:click="menu2 = ! menu2">
                    <span>Menswear</span>
                    <span><i class="fa-solid fa-angle-down"></i></span>
                  </button>
                  <div class="option-group-list" x-show="menu2" @click.outside="{open:false, menu1:false, menu2:false}">
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Tops</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Bottoms</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Suits and Formal Wear</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Activewear</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Outerwear</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Casual Wear</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Swimwear</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Underwear</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Sleepwear</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Accessories</p>
                        <input type="checkbox">
                      </label>
                    </div>
                  </div>

                  <button class="option-group-button" x-on:click="menu3 = ! menu3">
                    <span>Kids</span>
                    <span><i class="fa-solid fa-angle-down"></i></span>
                  </button>
                  <div class="option-group-list" x-show="menu3" @click.outside="{open:false, menu1:false, menu2:false, menu3:false}">
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Infants</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Toddlers</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Girls</p>
                        <input type="checkbox">
                      </label>
                    </div>
                    <div class="option-style-list">
                      <label class="option-label">
                        <p>Boys</p>
                        <input type="checkbox">
                      </label>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Todo: Will show this button when the user click a value in the category -->
          <div class="dropdown-trigger position-relative">
            <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span>Sub-Category</span>
              <span><i class="fa-solid fa-angle-down"></i></span>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </div>


          <div class="dropdown-trigger position-relative">
            <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span>Brand</span>
              <span><i class="fa-solid fa-angle-down"></i></span>
            </button>

          </div>


          <div class="dropdown">
            <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span>Style</span>
              <span><i class="fa-solid fa-angle-down"></i></span>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </div>

          <!-- Will ask marketing about the data for size and the design -->
          <div class="dropdown-trigger position-relative">
            <button class="btn btn-secondary" type="button">
              <span>Size</span>
              <span><i class="fa-solid fa-angle-down"></i></span>
            </button>

          </div>
          <div class="dropdown-trigger position-relative" x-data="{open:false}">
            <button class="btn btn-secondary" type="button" x-on:click="open = ! open">
              <span>Colour</span>
              <span><i class="fa-solid fa-angle-down"></i></span>
            </button>
            <div class="dropdown-container"  x-show="open" @click.away="open = false">
              <div class="dropdown-content">
                <div class="dropdown-menu-list">
                  <div class="option-group-list">
                    <div class="option-group-style">
                      <div class="option-black-dropdown" role="button">
                        <div class="option-black">
                          <div data-testid="colour-circle-black" id="black" class="option-black-color"></div>
                        </div>
                      </div>
                      <label class="option-label">
                        <p data-testid="checkbox-label">Black</p>
                        <input type="checkbox" data-testid="checkbox">
                      </label>
                    </div>
                    <div class="option-group-style">
                      <div class="option-White-dropdown" role="button">
                        <div class="option-White">
                          <div data-testid="colour-circle-White" id="White" class="option-white-color"></div>
                        </div>
                      </div>
                      <label class="option-label">
                        <p data-testid="checkbox-label">White</p>
                        <input type="checkbox" data-testid="checkbox">
                      </label>
                    </div>
                  </div>
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