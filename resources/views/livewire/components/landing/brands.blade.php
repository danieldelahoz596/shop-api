<div class="px-4">
  <div class="container-fluid">
    <h1>Popular Brands</h1>
    <div class="wrapperBrand">
      <div class="brandLogo">
        <a href=""><img src="{{ asset('assets/img/brands/brand1.svg') }}" class="img-fluid" alt=""></a>
      </div>
      <div class="brandLogo">
        <a href=""><img src="{{ asset('assets/img/brands/brand2.svg') }}" class="img-fluid" alt=""></a>
      </div>
      <div class="brandLogo">
        <a href=""><img src="{{ asset('assets/img/brands/brand3.svg') }}" class="img-fluid" alt=""></a>
      </div>
      <div class="brandLogo">
        <a href=""><img src="{{ asset('assets/img/brands/brand4.svg') }}" class="img-fluid" alt=""></a>
      </div>
    </div>

    <div class="d-flex justify-content-between align-items-center px-4">
      <h1>Brands</h1>
      <a href="">More</a>
    </div>

    <div x-data="swiper()" x-init="init()" class="position-relative mx-auto d-flex flex-row">
      <div class="swiper-container" x-ref="container">
        <div class="swiper-wrapper">
          <!-- Slides -->
          <div class="swiper-slide p-4">
            <div class="d-flex flex-column overflow-hidden">
              <div class="brandImg">
                <a href="" class="img"><img src="{{ asset('assets/img/brands/brandimg3.jpg') }}" alt=""></a>
              </div>
              <div class="imgContent text-start">
              <h3>YSL Jackets</h3>
              </div>
            </div>
          </div>

          <div class="swiper-slide p-4">
            <div class="d-flex flex-column overflow-hidden">
              <div class="brandImg">
                <a href="" class="img"><img src="{{ asset('assets/img/brands/brandimg1.jpg') }}" alt=""></a>
              </div>
              <div class="imgContent text-start">
              <h3>Adidas Bottoms</h3>
              </div>
            </div>
          </div>

          <div class="swiper-slide p-4">
            <div class="d-flex flex-column overflow-hidden">
              <div class="brandImg">
                <a href="" class="img"><img src="{{ asset('assets/img/brands/brandimg2.jpg') }}" alt=""></a>
              </div>
              <div class="imgContent text-start">
                <h3>Tops from Nike</h3>
              </div>
            </div>
          </div>
          <div class="swiper-slide p-4">
            <div class="d-flex flex-column overflow-hidden">
              <div class="brandImg">
                <a href="" class="img"><img src="{{ asset('assets/img/brands/brandimg2.jpg') }}" alt=""></a>
              </div>
              <div class="imgContent text-start">
                <h3>Tops from Nike</h3>
              </div>
            </div>
          </div>
          <div class="swiper-slide p-4">
            <div class="d-flex flex-column overflow-hidden">
              <div class="brandImg">
                <a href="" class="img"><img src="{{ asset('assets/img/brands/brandimg2.jpg') }}" alt=""></a>
              </div>
              <div class="imgContent text-start">
                <h3>Tops from Nike</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>