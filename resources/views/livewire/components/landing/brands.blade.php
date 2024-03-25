<div class="py-5">
    <div class="container-fluid">
        <div class="display-6 tertiary-color fw-bold ps-5">Popular Brands</div>
        <div class="wrapperBrand py-5">
            @foreach ($pBrands as $pBrand)
            <div class="brandLogo">
                <a href="/shop/{{ $pBrand->name }}"><img src="{{ asset('assets/img/brands/'.$pBrand->brand_logo) }}"
                        class="img-fluid" alt=""></a>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-end align-items-center px-4">
            <div class="display-6  fw-bold"><a class="tertiary-color" href="/shop/all">More</a></div>
        </div>

        <div x-data="swiper()" x-init="init()" class="position-relative mx-auto d-flex flex-row pt-5">
            <div class="swiper-container" x-ref="container">
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    @foreach ($brands as $brand)
                    <div class="swiper-slide p-4">
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
</div>