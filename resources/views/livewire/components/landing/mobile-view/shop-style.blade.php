<div>
    <div class=" container-fluid shopStyle-container py-5 px-0">
      <div class="shopStyle-wrapper">
        <div class="shopStyle-heading ps-3">
          <div class=" display-6 tertiary-color fw-bold">
            Shop by style
          </div>
          <p class="m-0 tertiary-color lh-1 mb-1">
          let us help you discover the perfect pieces to reflect your individuality and elevate your space. Personalize my shopping experience.
          </p>
          </div>
          <div x-data="swiper()" x-init="init()" class="position-relative mx-auto d-flex flex-row">
            <div class="swiper-container" x-ref="container">
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    @foreach ($brands as $brand)
                    <div class="swiper-slide p-3">
                        <div class="d-flex flex-column overflow-hidden">
                            <div class="brandImg">
                                <a href="/product/{{$brand->id}}-{{$brand->category_id}}-{{$brand->product_code}}"
                                    class="img"><img class="img-fluid" src="{{ asset('assets/img/brands/'.$brand->image) }}" alt=""></a>
                            </div>
                            <div class="imgContent text-center">
                                <h3 class="tertiary-color fw-bold lt-2-spacing">{{ $brand->product_name }} from {{ $brand->product_brand }}</h3>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
      </div>

      <div class="sellingInfoContainer my-5" style="background-image: url({{ asset('assets/img/spotlight/sellBg.png') }});">
        <div class="descriptionWrap">
          <div class="display-2 tertiary-color fw-bold">Sell anything. Sell to Anyone.</div>
          <p>Transform clutter into cash with our thrift app! Sell now and declutter effortlessly. Turn your pre-loved items into instant money with just a few taps. Join our community of savvy sellers today!</p>
          <a href="" class="ctaSell-mobile btn btn-secondary">
            Sell
          </a>
        </div>
        <div class="starIcon">
          <img class="img-fluid" src="{{ asset('assets/img/starIcon.svg') }}" alt="">
        </div>
        <div class="buudlIcon">
          <img class="img-fluid" src="{{ asset('assets/img/buudleIcon2.svg') }}" alt="">
        </div>
      </div>


      <!-- Todo: Need new background image -->
      <div class="sellingInfoContainer justify-content-start mt-5" style="background-image: url({{ asset('assets/img/spotlight/sellinginfo.png') }}); background-position:center bottom 77%;">
        <div class="descriptionWrap-mobile ps-3">
          <div class="display-2 tertiary-color fw-bold w-100" style="max-width: 311px;">Jumpstart your own business from your closet in a few steps!</div>
          <a href="" class="ctaSell">
            <span class="info display-6 fw-bold text-start" style="color: #EB3D00;">Here’s how you can sell</span>
            <span class="ctaIcon"><span class="arrowLine"></span><i class="fa-solid fa-angle-right"></i></span>
          </a>
        </div>
      </div>

    </div>
</div>
