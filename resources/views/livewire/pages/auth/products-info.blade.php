<!-- product-info.blade.php -->
<!-- create a Model for Products with Reviews and connected to Seller-->

<div class="container-fluid my-4 product-info">
    <div class="card mb-3 px-md-5" style="border: none;">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="row" x-data="{ swiperThumb: null, swiperLargePreview: null}">
                    <div class="col-12 col-lg-4 px-0 py-2">
                        <div class=" overflow-hidden " x-init="
                    swiperThumb = new Swiper($refs.swiperThumb, {
                      speed: 300,
                      spaceBetween: 0,
                      slidesPerView: 1,
                      direction: 'horizontal',
                      pagination: {
                        el: $refs.pagination,
                        clickable: true,
                      },
                      breakpoints: {
                        992: {
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
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide" x-on:mouseenter="swiperLargePreview.slideTo(1);">
                                        <div class="zoom_img">
                                            <img class="img-fluid"
                                                src="{{ asset('assets/img/category/category1.png') }}" />
                                        </div>
                                    </div>
                                    <div class="swiper-slide" x-on:mouseenter="swiperLargePreview.slideTo(2);">
                                        <div class="zoom_img">
                                            <img class="img-fluid"
                                                src="{{ asset('assets/img/category/category2.png') }}" />
                                        </div>
                                    </div>
                                    <div class="swiper-slide" x-on:mouseenter="swiperLargePreview.slideTo(3);">
                                        <div class="zoom_img">
                                            <img class="img-fluid"
                                                src="{{ asset('assets/img/featured/communityImg1.png') }}" />
                                        </div>
                                    </div>
                                    <div class="swiper-slide" x-on:mouseenter="swiperLargePreview.slideTo(4);">
                                        <div class="zoom_img">
                                            <img class="img-fluid"
                                                src="{{ asset('assets/img/featured/communityImg2.png') }}" />
                                        </div>
                                    </div>
                                    <div class="swiper-slide" x-on:mouseenter="swiperLargePreview.slideTo(5);">
                                        <div class="zoom_img">
                                            <img class="img-fluid"
                                                src="{{ asset('assets/img/category/category1.png') }}" />
                                        </div>
                                    </div>
                                    <div class="swiper-slide" x-on:mouseenter="swiperLargePreview.slideTo(6);">
                                        <div class="zoom_img">
                                            <img class="img-fluid"
                                                src="{{ asset('assets/img/category/category2.png') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div x-ref="pagination" class="swiper-pagination d-block d-lg-none"></div>
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
                                            <img class="img-fluid"
                                                src="{{ asset('assets/img/category/category1.png') }}" />
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="zoom_img">
                                            <img class="img-fluid"
                                                src="{{ asset('assets/img/category/category2.png') }}" />
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="zoom_img">
                                            <img class="img-fluid"
                                                src="{{ asset('assets/img/featured/communityImg1.png') }}" />
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="zoom_img">
                                            <img class="img-fluid"
                                                src="{{ asset('assets/img/featured/communityImg2.png') }}" />
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="zoom_img">
                                            <img class="img-fluid"
                                                src="{{ asset('assets/img/category/category1.png') }}" />
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="zoom_img">
                                            <img class="img-fluid"
                                                src="{{ asset('assets/img/category/category2.png') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6" id="product-profile-col">
                <div class="product-detail-container h-100">
                    <div class="product-detail-wrapper h-100 d-flex flex-column" style="row-gap:1.5rem;">
                        <div class="d-flex justify-content-between d-lg-block  px-2 px-sm-0">
                            <div class="product-heading">
                                <div class="fs-heading-lg tertiary-color fw-bold lh-1">{{ $product->product_name }}
                                </div>
                                <p class="muted-color m-0 fs-heading-md">US M - Used - Good Condition</p>
                                <div class="price-holder">
                                    <span>₱<span
                                            class="text-danger fs-heading-highlight">{{ $product->price }}</span></span>
                                    <span class="fs-heading-sm muted-color"><del>2500</del></span><span
                                        class="fs-heading-sm"> 20% off</span>
                                </div>
                            </div>
                            <div
                                class="product-icon-mobile d-lg-none d-flex flex-column align-items-center justify-content-center">
                                <a href="" class="lh-1" style="font-size: 9.877vw;"><i
                                        class="fa-regular fa-heart"></i></a>
                                <span>3</span>
                            </div>
                        </div>
                        <div class="product-buttons d-flex flex-row-reverse flex-lg-column align-items-center">
                            <button class="btn btn-secondary fs-heading-sm me-2 me-sm-0" wire:click="buyNow">Buy
                                now</button>
                            <button class="btn btn-secondary fs-heading-sm" wire:click="addToCart">Add to bag</button>
                            <button class="btn btn-secondary fs-heading-sm ms-2 ms-sm-0">Make an offer</button>
                        </div>
                        <div class="product-description px-2 px-sm-0">
                            <div class="tertiary-color fw-bold fs-default-md">Description</div>
                            <div class="muted color fs-xmd my-3"> <span><i class="fa-solid fa-droplet"></i></span> Gray
                            </div>
                            <div class="text-description">
                                <p class="tertiary-color fw-semibold fs-xmd lh-1">
                                    <span>Used once cropped top from H&M. I ship worldwide! <br></span>
                                    <span>Condition: 8/10</span>
                                </p>
                                <p class="tertiary-color fw-semibold fs-xmd">Please check all my pics.</p>
                                <p class="tertiary-color fw-semibold fs-xmd">Follow my accounts for more items!</p>
                            </div>
                            <div class="tags d-flex flex-wrap pt-3 pb-4"
                                style="border-bottom: 1px solid rgba(49, 13, 0, 0.5);">
                                <a href="" class="tag fs-default">#VINTAGE</a>
                                <a href="" class="tag fs-default">#NYLON</a>
                                <a href="" class="tag fs-default">#RETRO</a>
                                <a href="" class="tag fs-default">#H&M</a>
                                <a href="" class="tag fs-default">#H&M</a>
                                <a href="" class="tag fs-default">#H&M</a>
                                <a href="" class="tag fs-default">#H&M</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Seller Info -->
    <div class="card px-lg-5" style="border:none; ">
        <div class="row pb-4" style="border-bottom: 1px solid rgba(49, 13, 0, 0.5);">
            <div class="col-xl-6 col-12">
                <div
                    class="profile-wrapper d-flex flex-row align-items-center gap-4 justify-content-between w-xxl-90 w-xl-90 wm-100  flex-xl-column flex-xxl-row">
                    <div class="d-flex align-items-center">
                        <div class="p-2">
                            <img src="https://i2.cdn.turner.com/cnnnext/dam/assets/140926165711-john-sutter-profile-image-large-169.jpg"
                                alt="Profile Picture" class="img-fluid img-profile rounded-circle">
                        </div>
                        <div>
                            <div class="fs-heading-md card-subtitle tertiary-color fw-bold text-nowrap">{{$user->name}}
                            </div>
                            <p class="text-muted m-0 fs-default-xsm"> <span><i
                                        class="fa-solid fa-location-dot"></i></span> {{$user->address}} | Active now</p>
                            <p class="text-primary mb-0">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </p>
                        </div>
                    </div>
                    <div class="profile-cta text-nowrap">
                        <p class="m-0 ms-2"><a href="" class="tertiary-color fs-default-sm">See Reviews</a></p>
                        <div class="profile-buttons">
                            <button class="btn btn-outline-primary px-4 mx-1 fs-default-sm">Visit Shop</button>
                            <a href="/profile/{{ $user->id }}"><button
                                    class="btn btn-outline-primary px-4 mx-1 fs-default-sm">
                                    Follow
                                </button></a>
                        </div>
                    </div>
                </div>
                <div class="report-wrapper mt-4 align-items-center d-flex d-lg-none" style="column-gap: 1rem;">
                    <div class="report-icon">
                        <span class="fs-default-md" style="color: #CCCE6D;"><i
                                class="fa-solid fa-triangle-exclamation"></i></span>
                    </div>
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <div class="tertiary-color fw-bold fs-default-md">Report Listing</div>
                        <div class="link-icon">
                            <a href="" class="fs-default text-black"><i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="protection-wrapper d-flex mt-lg-4 w-xxl-90 w-xl-90 wm-100" style="column-gap: 1rem;">
                    <div class="shield-icon">
                        <span class="fs-default-md  position-relative" style="color: #CCCE6D;"> <i
                                class="fa-solid fa-shield"></i>
                            <span class="check text-light position-absolute fs-default"
                                style="top: 50%;right: 50%; transform:translate(50%, -50%)"><i
                                    class="fa-solid fa-check"></i></span>
                        </span>
                    </div>
                    <div class="protection-description d-flex align-items-center justify-content-between">
                        <div class="protection-heading">
                            <div class="tertiary-color fw-bold fs-default-md">Buudl Purchase Protection</div>
                            <p class="d-none d-lg-block fs-xmd lh-1" style="width: 90%;">We want you to feel safe buying
                                and selling on Buudl. Qualifying orders are covered by our Purchase Protection in the
                                rare case something goes wrong.</p>
                        </div>
                        <div class="link-icon">
                            <a href="" class="fs-default text-black"><i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-12 d-flex">
                <div class="measurement-container">
                    <div class="measurement-wrapper">
                        <div class="measurement-heading">
                            <div class="tertiary-color fw-bold fs-default-md">Measurements</div>
                            <p class="fs-xmd lh-1 w-75">Let the seller know you are interested in measurement details.
                                We’ll notify you as soon as they have added.</p>
                        </div>
                        <div class="measurement-cta text-center text-xl-center">
                            <button class="btn btn-primary w-75">Request Measurements</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <livewire:pages.auth.partials.productInfo.moreProduct />
    <!-- Recommendations Component -->
    @if($showRecommendations)
    @livewire('pages.auth.recommendations', ['product' => $currentProduct])
    @endif
    <div x-data="{  open: false,
    lastAddedItem: null,
    init() {
        Livewire.on('itemAddedToCart', (item) => {
            console.log('Item added to cart', item);
            this.lastAddedItem = Array.isArray(item) ? item[0] : item;
            this.open = true;
            setTimeout(() => { this.open = false; }, 15000);
        });
    }
}" x-init="init()" x-show.transition="open" style="display: none; z-index: 9999; position: fixed; top: 0; right: 0; margin: 1rem; padding: 1rem;
        background-color: white; border: 1px solid black; border-radius: 5px;"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform"
        x-transition:enter-end="opacity-100 transform" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform" x-transition:leave-end="opacity-0 transform">

        <template x-if="lastAddedItem">
            <div>
                <img x-bind:src="lastAddedItem.image" alt="Product Image" class="h-16 w-16 object-cover rounded">
                <h2 x-text="'Product: ' + lastAddedItem.name"></h2>
                <p x-text="'Price: $' + lastAddedItem.price.toFixed(2)"></p>
                <button @click="window.location.href='/checkout-process'"
                    class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Checkout
                </button>
                <button @click="window.location.href='/cart'"
                    class="bg-primary hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    View Bag
                </button>
            </div>
        </template>
    </div>


</div>