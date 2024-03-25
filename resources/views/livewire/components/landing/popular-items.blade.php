<div class="py-4">
    <div class="placeItemheader container-fluid d-flex align-items-center justify-content-between px-5">
        <span class="display-6 tertiary-color  fw-bold"><strong>Popular items</strong></span>
        <a href="/shop/all" class=" tertiary-color display-6 fw-bold"><u>More</u></a>
    </div>

    <div x-data="swiper()" x-init="init()" class="position-relative mx-auto d-flex flex-row px-5">
        <div class="swiper-container" x-ref="container">
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach ($popularItems as $popularItem)
                <div class="swiper-slide p-4">
                    <div class="d-flex flex-column overflow-hidden">
                        <div class="brandImg">
                            <a href="/product/{{$popularItem->id}}-{{$popularItem->category_id}}-{{$popularItem->product_code}}"
                                class="img"><img class="img-fluid" src="{{ asset('assets/img/brands/'.$popularItem->image) }}"
                                    alt=""></a>
                        </div>
                        <div class="imgContent pt-3">
                            <h3 class="m-0 tertiary-color fw-bold">{{ $popularItem->product_name }}</h3>
                            <h3 class="price lh-1 tertiary-color fw-bold">P {{ $popularItem->price }}</h3>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container-fluid shopByCategory mt-5">
        <div class="left position-relative">
            <div class="img"><img src="{{ asset('assets/img/buudlSmallIcon.svg') }}" alt=""></div>
            <h1>Shop in</h1>
            <h5>Who are you shopping for?</h5>
        </div>
        <div class="right">
            <ul class="listCategory">
                <li><a href="/shop/women" class="link"><span>Women</span><span><i
                                class="fa-solid fa-arrow-right"></i></span></a></li>
                <li><a href="/shop/men" class="link"><span>Men</span><span><i
                                class="fa-solid fa-arrow-right"></i></span></a></li>
                <li><a href="/shop/kids" class="link"><span>Kids</span><span><i
                                class="fa-solid fa-arrow-right"></i></span></a></li>
                <li><a href="/shop/all" class="link active"><span>Everything</span><span><i
                                class="fa-solid fa-arrow-right"></i></span></a></li>
            </ul>
        </div>
    </div>

    <div class="container-fluid">
      <div class="display-6 tertiary-color fw-bold ps-5">People are talking about...</div>
        <div class="catogeryList">
          <div x-data="swiper()" x-init="init()" class="position-relative mx-auto d-flex flex-row ps-5">
            <div class="swiper-container" x-ref="container">
              <div class="swiper-wrapper position-relative">
                @foreach ($subCategories as $subCategory)
                <div class="swiper-slide p-4">
                  <div class="d-flex flex-column overflow-hidden">
                    <div class="itemImg">
                        <a href="/shop/{{ $subCategory->slug }}" class="img">
                            <img class="img-fluid" src="{{ asset('assets/img/category/category1.png') }}" alt="">
                        </a>
                    </div>
                    <div class="itemContent text-start">
                      <h3 class="m-0 space-nowrap">{{ $subCategory->name }}</h3>
                      <h3 class="price lh-1">4.k searches this week</h3>
                    </div>
                  </div>
              </div>
              @endforeach
              {{-- <div class="swiper-slide p-4">
                    <div class="d-flex flex-column overflow-hidden">
                      <div class="itemImg">
                        <a href="" class="d-block img">
                          <img class="img-fluid" src="{{ asset('assets/img/category/category2.png') }}" alt="">
                        </a>
                      </div>
                      <div class="itemContent text-start">
                        <h3 class="m-0"> dress </h3>
                        <div class="price lh-1">4.k searches this week</div>
                      </div>
                    </div>
                  </div>
            </div>--}}
            </div>
          </div>
        </div>
</div>

<script>
function swiper() {
    let swiperInstance;

    return {
        init() {
            swiperInstance = new Swiper(this.$refs.container, {
                loop: true,
                // autoplay: {
                //     delay: 5000,
                // },
                parallax: true,
                rewind: true,
                slidesPerView: 1,
                spaceBetween: 0,
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 0,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 0,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 0,
                    },
                    1399: {
                        slidesPerView: 4,
                        spaceBetween: 0,
                    },
                },
            });
        },

        slideNext() {
            swiperInstance.slideNext();
        },

        slidePrev() {
            swiperInstance.slidePrev();
        },
    };
}
</script>
</div>