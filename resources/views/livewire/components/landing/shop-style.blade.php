<div>
  <div class="my-5" x-data="{swiper_shop: null}">
    <div x-init="
              swiperThumb = new Swiper($refs.container, {
                speed: 300,
                spaceBetween: 40,
                slidesPerView: 3,
              });" class="position-relative mx-auto d-flex flex-row px-md-5">
      <div class="swiper-container" x-ref="container">
        <div class="swiper-wrapper">
          <div class="swiper-slide ">
            <a href="">
              <img class="swiper-img img-fluid w-100 " src="{{ asset('assets/img/shop_style/dummy_shopStye1.jpg') }}" />
            </a>
          </div>
          <div class="swiper-slide ">
            <a href="">
              <img class="swiper-img img-fluid w-100 " src="{{ asset('assets/img/shop_style/dummy_shopStye2.jpg') }}" />
            </a>
          </div>
          <div class="swiper-slide ">
            <a href="">
              <img class="swiper-img img-fluid w-100 " src="{{ asset('assets/img/shop_style/dummy_shopStye3.jpg') }}" />
            </a>
          </div>
          <div class="swiper-slide ">
            <a href="">
              <img class="swiper-img img-fluid w-100 " src="{{ asset('assets/img/shop_style/dummy_shopStye4.jpg') }}" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="my-5 tertiary-color fw-bold text-center" style="font-size: 5.36vw;">Shop your own style</div>
  <div x-init="
              swiperThumb = new Swiper($refs.container2, {
                speed: 300,
                spaceBetween: 40,
                slidesPerView: 3,
              });" class="position-relative mx-auto d-flex flex-row px-md-5">
      <div class="swiper-container" x-ref="container2">
        <div class="swiper-wrapper">
          <div class="swiper-slide ">
            <a href="">
              <img class="swiper-img img-fluid w-100 " src="{{ asset('assets/img/shop_style/dummy_shopStye4.jpg') }}" />
            </a>
          </div>
          <div class="swiper-slide ">
            <a href="">
              <img class="swiper-img img-fluid w-100 " src="{{ asset('assets/img/shop_style/dummy_shopStye5.jpg') }}" />
            </a>
          </div>
          <div class="swiper-slide ">
            <a href="">
              <img class="swiper-img img-fluid w-100 " src="{{ asset('assets/img/shop_style/dummy_shopStye6.jpg') }}" />
            </a>
          </div>
          <div class="swiper-slide ">
            <a href="">
              <img class="swiper-img img-fluid w-100 " src="{{ asset('assets/img/shop_style/dummy_shopStye1.jpg') }}" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
