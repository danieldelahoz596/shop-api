
<!-- Todo: used popular item component to render images and details -->
<div>
    <div class="placeItemheader container-fluid d-flex align-items-center justify-content-between px-md-5">
        <span class="display-6 tertiary-color  fw-bold"><strong>Steals</strong></span>
        <a href="/shop/all" class=" tertiary-color display-6 fw-bold"><u>More</u></a>
    </div>

    <div x-data="swiper()" x-init="init()" class="position-relative mx-auto d-flex flex-row px-md-5">
        <div class="swiper-container" x-ref="container">
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach ($popularItems as $popularItem)
                <div class="swiper-slide p-3">
                    <div class="d-flex flex-column overflow-hidden">
                        <div class="brandImg">
                            <a href="/product/{{$popularItem->id}}-{{$popularItem->category_id}}-{{$popularItem->product_code}}"
                                class="img"><img class="img-fluid" src="{{ asset($popularItem->image) }}"
                                    alt=""></a>
                        </div>
                        <div class="imgContent pt-md-3">
                            <h3 class="m-0 tertiary-color fw-bold">{{ $popularItem->product_name }}</h3>
                            <h3 class="price lh-1 tertiary-color fw-bold">P {{ $popularItem->price }}</h3>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container-fluid">
      <div class="createStyle-container">
          <div class="display-6 tertiary-color fw-bold">
            Create your own style
          </div>
          <div class="createStyle-wrapper">
             <a href="" class="vertical"><img class="img-fluid h-100 w-100" style="object-fit: cover;" src="{{ asset('assets/img/brands/brandimg1.jpg') }}" alt=""></a>
             <a href=""><img class="img-fluid h-100 w-100" style="object-fit: cover;" src="{{ asset('assets/img/brands/brandimg1.jpg') }}" alt=""></a>
             <a href="" class="vertical"><img class="img-fluid h-100 w-100" style="object-fit: cover;" src="{{ asset('assets/img/brands/brandimg1.jpg') }}" alt=""></a>
             <a href=""><img class="img-fluid h-100 w-100" style="object-fit: cover;" src="{{ asset('assets/img/brands/brandimg1.jpg') }}" alt=""></a>
             <a href=""><img class="img-fluid h-100 w-100" style="object-fit: cover;" src="{{ asset('assets/img/brands/brandimg1.jpg') }}" alt=""></a>
             <a href=""><img class="img-fluid h-100 w-100" style="object-fit: cover;" src="{{ asset('assets/img/brands/brandimg1.jpg') }}" alt=""></a>
          </div>
      </div>
    </div>


    <!-- Todo: Need new background image -->
    <div class="sellingInfoContainer3 justify-content-start mt-5" style="background-image: url({{ asset('assets/img/spotlight/sellinginfo2.png') }});">
      <div class="descriptionWrap-mobile ps-3">
        <div class="display-2 tertiary-color fw-bold w-100" style="max-width: 311px; letter-spacing: -1px;">Turn extra clothes into extra cash.</div>
        <a href="" class="ctaSell-mobile btn btn-secondary">
          Sell
        </a>
      </div>
    </div>

    <div class="community-container d-flex align-items-center justify-content-center" style="height: 143px;">
      <div class="community-wrapper d-flex align-items-center justify-content-center flex-column">
        <div class="display-2 tertiary-color fw-bold">Buy. Sell. Keep fashion circular.</div>
        <a href="" class="ctaSell-mobile btn btn-secondary">Join our community</a>
      </div>
    </div>
</div>
