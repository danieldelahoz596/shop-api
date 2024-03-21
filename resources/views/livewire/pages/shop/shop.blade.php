<div class="section-shop">
  <div class="container">
    <div class="heading display-1 fw-bolder">
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
                <div class="dropdown-top-search">
                  <div class="top-search-wrapper position-relative">
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input placeholder="Search for Categories" class="search-input">
                  </div>
                </div>
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


          <div class="dropdown-trigger position-relative" >
            <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span>Brand</span>
              <span><i class="fa-solid fa-angle-down"></i></span>
            </button>

          </div>


          <div class="dropdown-trigger position-relative" x-data="{open:false}">
            <button class="btn btn-secondary" type="button" x-on:click="open = ! open">
              <span>Style</span>
              <span><i class="fa-solid fa-angle-down"></i></span>
            </button>
            <div class="dropdown-container" x-show="open" @click.away="open = false">
              <div class="dropdown-content">
                <div class="dropdown-menu-list">
                  <div class="option-group-list">
                      <div class="option-style-dropdown" role="button">
                        <label class="option-label">
                          <p data-testid="checkbox-label" >Retro</p>
                          <input type="checkbox" data-testid="checkbox">
                        </label>
                      </div>
                      <div class="option-style-dropdown" role="button">
                        <label class="option-label">
                          <p data-testid="checkbox-label" >Vintage</p>
                          <input type="checkbox" data-testid="checkbox">
                        </label>
                      </div>
                      <div class="option-style-dropdown" role="button">
                        <label class="option-label">
                          <p data-testid="checkbox-label" >Y2K</p>
                          <input type="checkbox" data-testid="checkbox">
                        </label>
                      </div>
                      <div class="option-style-dropdown" role="button">
                        <label class="option-label">
                          <p data-testid="checkbox-label" >Streetwear</p>
                          <input type="checkbox" data-testid="checkbox">
                        </label>
                      </div>
                      <div class="option-style-dropdown" role="button">
                        <label class="option-label">
                          <p data-testid="checkbox-label" >Athleisure</p>
                          <input type="checkbox" data-testid="checkbox">
                        </label>
                      </div>
                      <div class="option-style-dropdown" role="button">
                        <label class="option-label">
                          <p data-testid="checkbox-label" >Casual</p>
                          <input type="checkbox" data-testid="checkbox">
                        </label>
                      </div>
                      <div class="option-style-dropdown" role="button">
                        <label class="option-label">
                          <p data-testid="checkbox-label" >Formal</p>
                          <input type="checkbox" data-testid="checkbox">
                        </label>
                      </div>
                      <div class="option-style-dropdown" role="button">
                        <label class="option-label">
                          <p data-testid="checkbox-label" >Glam</p>
                          <input type="checkbox" data-testid="checkbox">
                        </label>
                      </div>
                      <div class="option-style-dropdown" role="button">
                        <label class="option-label">
                          <p data-testid="checkbox-label" >Cottage</p>
                          <input type="checkbox" data-testid="checkbox">
                        </label>
                      </div>
                      <div class="option-style-dropdown" role="button">
                        <label class="option-label">
                          <p data-testid="checkbox-label" >Punk</p>
                          <input type="checkbox" data-testid="checkbox">
                        </label>
                      </div>
                      <div class="option-style-dropdown" role="button">
                        <label class="option-label">
                          <p data-testid="checkbox-label" >Preppy & Chic</p>
                          <input type="checkbox" data-testid="checkbox">
                        </label>
                      </div>
                      <div class="option-style-dropdown" role="button">
                        <label class="option-label">
                          <p data-testid="checkbox-label" >utility</p>
                          <input type="checkbox" data-testid="checkbox">
                        </label>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
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
                    <div class="option-group-style">
                      <div class="option-gray-dropdown" role="button">
                        <div class="option-gray">
                          <div data-testid="colour-circle-gray" id="gray" class="option-gray-color"></div>
                        </div>
                      </div>
                      <label class="option-label">
                        <p data-testid="checkbox-label">Gray</p>
                        <input type="checkbox" data-testid="checkbox">
                      </label>
                    </div>
                    <div class="option-group-style">
                      <div class="option-beige-dropdown" role="button">
                        <div class="option-beige">
                          <div data-testid="colour-circle-beige" id="beige" class="option-beige-color"></div>
                        </div>
                      </div>
                      <label class="option-label">
                        <p data-testid="checkbox-label">Beige</p>
                        <input type="checkbox" data-testid="checkbox">
                      </label>
                    </div>
                    <div class="option-group-style">
                      <div class="option-red-dropdown" role="button">
                        <div class="option-red">
                          <div data-testid="colour-circle-red" id="red" class="option-red-color"></div>
                        </div>
                      </div>
                      <label class="option-label">
                        <p data-testid="checkbox-label">Red</p>
                        <input type="checkbox" data-testid="checkbox">
                      </label>
                    </div>
                    <div class="option-group-style">
                      <div class="option-blue-dropdown" role="button">
                        <div class="option-blue">
                          <div data-testid="colour-circle-blue" id="blue" class="option-blue-color"></div>
                        </div>
                      </div>
                      <label class="option-label">
                        <p data-testid="checkbox-label">Blue</p>
                        <input type="checkbox" data-testid="checkbox">
                      </label>
                    </div>
                    <div class="option-group-style">
                      <div class="option-green-dropdown" role="button">
                        <div class="option-green">
                          <div data-testid="colour-circle-green" id="green" class="option-green-color"></div>
                        </div>
                      </div>
                      <label class="option-label">
                        <p data-testid="checkbox-label">Green</p>
                        <input type="checkbox" data-testid="checkbox">
                      </label>
                    </div>
                    <div class="option-group-style">
                      <div class="option-yellow-dropdown" role="button">
                        <div class="option-yellow">
                          <div data-testid="colour-circle-yellow" id="yellow" class="option-yellow-color"></div>
                        </div>
                      </div>
                      <label class="option-label">
                        <p data-testid="checkbox-label">Yellow</p>
                        <input type="checkbox" data-testid="checkbox">
                      </label>
                    </div>
                    <div class="option-group-style">
                      <div class="option-purple-dropdown" role="button">
                        <div class="option-purple">
                          <div data-testid="colour-circle-purple" id="purple" class="option-purple-color"></div>
                        </div>
                      </div>
                      <label class="option-label">
                        <p data-testid="checkbox-label">Purple</p>
                        <input type="checkbox" data-testid="checkbox">
                      </label>
                    </div>
                    <div class="option-group-style">
                      <div class="option-pink-dropdown" role="button">
                        <div class="option-pink">
                          <div data-testid="colour-circle-pink" id="pink" class="option-pink-color"></div>
                        </div>
                      </div>
                      <label class="option-label">
                        <p data-testid="checkbox-label">Pink</p>
                        <input type="checkbox" data-testid="checkbox">
                      </label>
                    </div>
                    <div class="option-group-style">
                      <div class="option-orange-dropdown" role="button">
                        <div class="option-orange">
                          <div data-testid="colour-circle-orange" id="orange" class="option-orange-color"></div>
                        </div>
                      </div>
                      <label class="option-label">
                        <p data-testid="checkbox-label">Orange</p>
                        <input type="checkbox" data-testid="checkbox">
                      </label>
                    </div>
                    <div class="option-group-style">
                      <div class="option-brown-dropdown" role="button">
                        <div class="option-brown">
                          <div data-testid="colour-circle-brown" id="brown" class="option-brown-color"></div>
                        </div>
                      </div>
                      <label class="option-label">
                        <p data-testid="checkbox-label">Brown</p>
                        <input type="checkbox" data-testid="checkbox">
                      </label>
                    </div>
                    <div class="option-group-style">
                      <div class="option-navy-blue-dropdown" role="button">
                        <div class="option-navy-blue">
                          <div data-testid="colour-circle-navy-blue" id="navy-blue" class="option-navy-blue-color"></div>
                        </div>
                      </div>
                      <label class="option-label">
                        <p data-testid="checkbox-label">Navy Blue</p>
                        <input type="checkbox" data-testid="checkbox">
                      </label>
                    </div>
                    <div class="option-group-style">
                      <div class="option-silver-dropdown" role="button">
                        <div class="option-silver">
                          <div data-testid="colour-circle-silver" id="silver" class="option-silver-color"></div>
                        </div>
                      </div>
                      <label class="option-label">
                        <p data-testid="checkbox-label">Silver</p>
                        <input type="checkbox" data-testid="checkbox">
                      </label>
                    </div>
                    <div class="option-group-style">
                      <div class="option-gold-dropdown" role="button">
                        <div class="option-gold">
                          <div data-testid="colour-circle-gold" id="gold" class="option-gold-color"></div>
                        </div>
                      </div>
                      <label class="option-label">
                        <p data-testid="checkbox-label">Gold</p>
                        <input type="checkbox" data-testid="checkbox">
                      </div>
                      <div class="option-group-style">
                        <div class="option-multicolor-dropdown" role="button">
                          <div class="option-multicolor">
                            <div data-testid="colour-circle-multicolor" id="multicolor" class="option-multicolor-color"></div>
                          </div>
                        </label>
                      </div>
                      <label class="option-label">
                        <p data-testid="checkbox-label">Multicolor</p>
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
