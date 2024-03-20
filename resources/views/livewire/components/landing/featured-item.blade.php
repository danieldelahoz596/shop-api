<div class="p-4">

  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center px-4">
      <h1>Featured Items</h1>
      <a href="">More</a>
    </div>

    <div x-data="swiper()" x-init="init()" class="position-relative mx-auto d-flex flex-row">
      <div class="swiper-container" x-ref="container">
        <div class="swiper-wrapper">
          <!-- Slides -->
          @foreach ($featuredItems as $featuredItem)
            <div class="swiper-slide p-4">
                <div class="d-flex flex-column overflow-hidden">
                    <div class="brandImg">
                        <a href="" class="img"><img src="{{ asset('assets/img/brands/'.$featuredItem->image) }}" alt=""></a>
                    </div>
                    <div class="imgContent text-center">
                        <h3>{{ $featuredItem->product_name }} from {{ $featuredItem->product_brand }}</h3>
                    </div>
                </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div x-data="swiper_pagination()" x-init="init()" class="position-relative mx-auto d-flex flex-row pt-5">
      <div class="communityWrapper swiper-container" x-ref="container">
        <div class="swiper-wrapper pb-5">
          <div class="communityItems swiper-slide">
            <div class="img"><img src="{{ asset('assets/img/featured/communityImg1.png') }}" alt=""></div>
            <div class="cta">
              <h1>Join our community</h1>
              <button class="commBtn">Join</button>
            </div>
          </div>
          <div class="communityItems swiper-slide">
            <div class="img"><img src="{{ asset('assets/img/featured/communityImg1.png') }}" alt=""></div>
            <div class="cta">
              <h1>Join our community</h1>
              <button class="commBtn">Join</button>
            </div>
          </div>
          <div class="communityItems swiper-slide">
            <div class="img"><img src="{{ asset('assets/img/featured/communityImg1.png') }}" alt=""></div>
            <div class="cta">
              <h1>Join our community</h1>
              <button class="commBtn">Join</button>
            </div>
          </div>
          <div class="communityItems swiper-slide">
            <div class="img"><img src="{{ asset('assets/img/featured/communityImg1.png') }}" alt=""></div>
            <div class="cta">
              <h1>Join our community</h1>
              <button class="commBtn">Join</button>
            </div>
          </div>
        </div>
        <div class="swiper-pagination d-flex"></div>
      </div>
    </div>

    <div class="valueInfoContainer pt-5" style="background-image: url({{ asset('assets/img/snakeBgBeige.png') }});">
      <div class="valueWrapper">
        <h1>what we value</h1>
        <div class="valueGrid">
          <div class="value">
            <div class="icon"><i class="fa-solid fa-asterisk"></i></div>
            <h4>Empowered community</h4>
            <p>In essence, our brand stands as a beacon of possibility, proving that style, sustainability, and savings can coexist harmoniously. </p>
          </div>
          <div class="value">
            <div class="icon"><i class="fa-solid fa-hashtag"></i></div>
            <h4>Unique finds</h4>
            <p>In essence, our brand stands as a beacon of possibility, proving that style, sustainability, and savings can coexist harmoniously. </p>
          </div>
          <div class="value">
            <div class="icon"><i class="fa-solid fa-tag"></i></div>
            <h4>Affordability</h4>
            <p>In essence, our brand stands as a beacon of possibility, proving that style, sustainability, and savings can coexist harmoniously. </p>
          </div>
        </div>
      </div>
    </div>

  </div>
  <script>
    function swiper_pagination() {
      let swiperInstance;

      return {
        init() {
          swiperInstance = new Swiper(this.$refs.container, {
            slidesPerView: 3,
            spaceBetween: 30,
            pagination: {
              el: ".swiper-pagination",
              clickable: true,
              renderBullets: function(index, className) {
                return '<span class="' + className + '">' + (index + 1) + '</span>';
              }
            },
            breakpoints: {
              640: {
                slidesPerView: 1,
              },
              768: {
                slidesPerView: 2,
                spaceBetween: 30,
              },
              1024: {
                slidesPerView: 2,
                spaceBetween: 30,
              },
              1399: {
                slidesPerView: 3,
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
