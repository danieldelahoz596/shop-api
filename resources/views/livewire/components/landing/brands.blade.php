<div class="px-4">
  <div class="container-fluid">
    <h1>Popular Brands</h1>
    <div class="wrapperBrand">
        @foreach ($pBrands as $pBrand)
            <div class="brandLogo">
                <a href=""><img src="{{ asset('assets/img/brands/'.$pBrand->brand_logo) }}" class="img-fluid" alt=""></a>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-between align-items-center px-4">
      <h1>Brands</h1>
      <a href="">More</a>
    </div>

    <div class="container-fluid">
      <div class="brandImages">
        <div class="imgWrap">
            @foreach ($brands as $brand)
                <div class="placeItemGrid">
                    <div class="brandImg">
                        <a href="" class="img"><img src="{{ asset('assets/img/brands/'.$brand->image) }}" alt=""></a>
                    </div>
                    <div class="imgContent">
                        <h3>{{ $brand->product_name }} from {{ $brand->product_brand }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
      </div>
    </div>

  </div>
</div>
