<div class="px-4">
  <div class="container-fluid">
    <h1>Popular Brands</h1>
    <div class="wrapperBrand">
        @foreach ($pBrands as $pBrand)
            <div class="brandLogo">
                <a href="/shop/{{ $pBrand->name }}"><img src="{{ asset('assets/img/brands/'.$pBrand->brand_logo) }}" class="img-fluid" alt=""></a>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-between align-items-center px-4">
      <h1>Brands</h1>
      <a href="/shop/all">More</a>
    </div>

    <div x-data="swiper()" x-init="init()" class="position-relative mx-auto d-flex flex-row">
      <div class="swiper-container" x-ref="container">
        <div class="swiper-wrapper">
          <!-- Slides -->
          @foreach ($brands as $brand)
            <div class="swiper-slide p-4">
                <div class="d-flex flex-column overflow-hidden">
                    <div class="brandImg">
                        <a href="#" class="img"><img src="{{ asset('assets/img/brands/'.$brand->image) }}" alt=""></a>
                    </div>
                    <div class="imgContent text-center">
                        <h3>{{ $brand->product_name }} from {{ $brand->product_brand }}</h3>
                    </div>
                </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>


  </div>
</div>
