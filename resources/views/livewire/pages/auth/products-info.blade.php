<!-- product-info.blade.php -->
<!-- create a Model for Products with Reviews and connected to Seller-->

<div class="container-fluid my-4">
    <div class="card mb-3" style="border: none;">
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="row" x-data="{ swiperThumb: null, swiperLargePreview: null}">
              <div class="col-12 col-lg-4 px-0 py-2">
                <div class=" overflow-hidden "   x-init="
                    swiperThumb = new Swiper($refs.swiperThumb, {
                      speed: 300,
                      spaceBetween: 10,
                      slidesPerView: 1,
                      direction: 'horizontal',
                      pagination: {
                        el: $refs.pagination,
                        clickable: true,
                      },
                      breakpoints: {
                        789: {
                          spaceBetween: 10,
                          slidesPerView: 6,
                          direction: 'vertical',
                          clickable: true,
                        },
                      },
                    });
                    swiperThumb.on('slideChange', function() {
                      swiperThumb.pagination.render();
                      swiperThumb.pagination.update();
                      });
                  ">
                  <div thumbsSlider="" class="swiper swiper_thumb position-relative" x-ref="swiperThumb">
                      <div class="swiper-wrapper" >
                        <div class="swiper-slide" x-on:mouseenter="swiperLargePreview.slideTo(1);">
                          <div class="zoom_img">
                            <img class="img-fluid" src="{{ asset('assets/img/category/category1.png') }}" />
                          </div>
                        </div>
                        <div class="swiper-slide" x-on:mouseenter="swiperLargePreview.slideTo(2);">
                          <div class="zoom_img">
                            <img class="img-fluid" src="{{ asset('assets/img/category/category2.png') }}" />
                          </div>
                        </div>
                        <div class="swiper-slide" x-on:mouseenter="swiperLargePreview.slideTo(3);">
                          <div class="zoom_img">
                            <img class="img-fluid" src="{{ asset('assets/img/featured/communityImg1.png') }}" />
                          </div>
                        </div>
                        <div class="swiper-slide" x-on:mouseenter="swiperLargePreview.slideTo(4);">
                          <div class="zoom_img">
                            <img class="img-fluid" src="{{ asset('assets/img/featured/communityImg2.png') }}" />
                          </div>
                        </div>
                        <div class="swiper-slide" x-on:mouseenter="swiperLargePreview.slideTo(5);">
                          <div class="zoom_img">
                            <img class="img-fluid" src="{{ asset('assets/img/category/category1.png') }}" />
                          </div>
                        </div>
                        <div class="swiper-slide" x-on:mouseenter="swiperLargePreview.slideTo(6);">
                          <div class="zoom_img">
                            <img class="img-fluid" src="{{ asset('assets/img/category/category2.png') }}" />
                          </div>
                        </div>
                      </div>
                    <div x-ref="pagination" class="swiper-pagination d-block d-md-none"></div>
                    <!-- <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div> -->
                  </div>
                </div>
              </div>
              <div class="col-md-7 py-2 d-none d-lg-block">
                <div class="overflow-hidden" x-init="swiperLargePreview = new Swiper($refs.swiperLargePreview, {
                spaceBetween: 10,
                slidesPerView: 1,
                speed: 300,
                loop: true,
                thumbs: {
                  swiper: swiperThumb,
                },
              })">
              <div class="swiper swiper_large_preview position-relative" x-ref="swiperLargePreview">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="zoom_img">
                        <img class="img-fluid" src="{{ asset('assets/img/category/category1.png') }}" />
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="zoom_img">
                        <img class="img-fluid" src="{{ asset('assets/img/category/category2.png') }}" />
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="zoom_img">
                        <img class="img-fluid" src="{{ asset('assets/img/featured/communityImg1.png') }}" />
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="zoom_img">
                        <img class="img-fluid" src="{{ asset('assets/img/featured/communityImg2.png') }}" />
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="zoom_img">
                        <img class="img-fluid" src="{{ asset('assets/img/category/category1.png') }}" />
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="zoom_img">
                        <img class="img-fluid" src="{{ asset('assets/img/category/category2.png') }}" />
                      </div>
                    </div>
                  </div>
              </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-6">
          <div class="product-detail-container h-100" style="border-bottom: 1px solid ;">
            <div class="product-detail-wrapper h-100 d-flex flex-column" style="row-gap:1.5rem;">
              <div class="product-heading">
                <div class="display-2 tertiary-color fw-bold lt-3-spacing">Shiny Top</div>
                <p class="muted-color m-0 fs-heading-md lt-3-spacing">US M  - Used - Good Condition</p>
                <div class="price-holder">
                  <span class="fs-heading-sm">P<span class="text-danger">200</span></span> <span class="fs-heading-xsm muted-color"><del>250</del></span><span class="fs-heading-xsm"> 20% off</span>
                </div>
              </div>
              <div class="product-buttons d-none d-lg-flex flex-column align-items-center">
                <button class="btn btn-secondary">Buy now</button>
                <button class="btn btn-secondary">Add to bag</button>
                <button class="btn btn-secondary">Make an offer</button>
              </div>
              <div class="product-description">
                <div class="tertiary-color fw-bold h2">Description</div>
                <div class="muted color h4 my-3"> <span><i class="fa-solid fa-droplet"></i></span> Gray </div>
                <div class="text-description">
                  <p class="tertiary-color fw-semibold fs-xxsm lh-1">
                    <span>Used once cropped top from H&M. I ship worldwide! <br></span>
                    <span>Condition: 8/10</span>
                  </p>
                  <p class="tertiary-color fw-semibold fs-xxsm">Please check all my pics.</p>
                  <p class="tertiary-color fw-semibold fs-xxsm">Follow my accounts for more items!</p>
                </div>
                <div class="tags d-flex flex-wrap pt-3">
                    <a href="" class="tag">#VINTAGE</a>
                    <a href="" class="tag">#NYLON</a>
                    <a href="" class="tag">#RETRO</a>
                    <a href="" class="tag">#H&M</a>
                    <a href="" class="tag">#H&M</a>
                    <a href="" class="tag">#H&M</a>
                    <a href="" class="tag">#H&M</a>
                    <a href="" class="tag">#H&M</a>
                    <a href="" class="tag">#H&M</a>
                    <a href="" class="tag">#H&M</a>
                    <a href="" class="tag">#H&M</a>
                    <a href="" class="tag">#H&M</a>
                </div>
              </div>
            </div>
          </div>

          </div>
        </div>
    </div>

    <!-- Seller Info -->


    <div class="card " style="border:none; ">
        <div class="row">
            <div class="col-md-6 ">
                <div class="profile-wrapper d-flex flex-row align-items-center gap-4 justify-content-between">
                  <div class="d-flex align-items-center">
                    <div class="p-2">
                        <img src="https://i2.cdn.turner.com/cnnnext/dam/assets/140926165711-john-sutter-profile-image-large-169.jpg"
                            alt="Profile Picture" class="img-fluid rounded-circle"
                            style="width: 50px; height: 50px; object-fit: cover;">
                    </div>
                      <div>
                        <div class="h6 card-subtitle tertiary-color fw-bold">{{$user->name}}</div>
                        <p class="text-muted m-0"> <span><i class="fa-solid fa-location-dot"></i></span> {{$user->address}} | Active now</p>
                        <p class="text-primary mb-0">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </p>
                       </div>
                      </div>
                  <div>
                      <p class="m-0 ms-2"><a href="" class="tertiary-color">See Reviews</a></p>
                      <button class="btn btn-outline-primary px-4 btn-sm mx-1">Ask a Question</button>
                      <a href="/profile/{{ $user->id }}"><button class="btn btn-outline-primary px-4 btn-sm mx-1">
                              <i class="bi bi-shop"></i> Visit Shop
                          </button></a>
                  </div>
                </div>

                <div class="protection-wrapper d-flex align-items-center">
                  <div class="shield-icon position-relative">
                    
                  <span> <i class="fa-solid fa-shield" style="font-size: 2rem;"></i></span>
                  <span class="check text-light position-absolute" style="top: 50%;right: 50%;transform: translate(49%, -56%);"><i class="fa-solid fa-check"></i></span>

                  </div>
                  <div class="protection-description"></div>
                  <div class="link-icon"></div>
                </div>
            </div>
            <div class="col-md-6 d-flex">


                <div class="col-md-6">
                    <span>Products</span>
                    <br>
                    <span>Response Rate</span>
                    <br>
                    <span>Response Time</span>
                    <br>
                    <span>Joined</span>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <!-- create a review backend -->
        <div class="card mt-3">
            <div class="card-header">
                Reviews
            </div>
            @livewire('review-form', ['product' => $product])
            @livewire('product-reviews', ['product' => $product])

        </div>
    </div>
</div>
