<div class="px-4">
  <div class="container-fluid mb-4 pt-5">
    <h1>Shop Spotlight</h1>
    <div class="spotlightWrapper pb-4">
      @foreach ($owners as $owner)
        <div class="spotLightShop position-relative">
            <a href="" class="shop"><img src="{{ asset('assets/img/spotlight/spotlightimg.png') }}" alt=""></a>
            <div class="content">
                <h2>{{ $owner->firstname }}'s Store</h2>
            </div>
        </div>
      @endforeach
      {{-- <div class="spotLightShop position-relative">
        <a href="" class="shop"><img src="{{ asset('assets/img/spotlight/spotlightimg.png') }}" alt=""></a>
        <div class="content">
          <h2>Retro Store</h2>
        </div>
      </div>
      <div class="spotLightShop position-relative">
        <a href="" class="shop"><img src="{{ asset('assets/img/spotlight/spotlightimg.png') }}" alt=""></a>
        <div class="content">
          <h2>Retro Store</h2>
        </div>
      </div>
      <div class="spotLightShop position-relative">
        <a href="" class="shop"><img src="{{ asset('assets/img/spotlight/spotlightimg.png') }}" alt=""></a>
        <div class="content">
          <h2>Retro Store</h2>
        </div>
      </div> --}}
    </div>

    <div class="sellingContainer p-4">
      <div class="left">
        <img src="{{ asset('assets/img/sellingLeft.jpg') }}" class="img-fluid" alt="">
      </div>
      <div class="right">
        <h1>Selling is more fun!</h1>
        <p>Transform clutter into cash with our thrift app! Sell now and declutter effortlessly. Turn your pre-loved items into instant money with just a few taps. Join our community of savvy sellers today!</p>
        <button class="spotBtn">Start Selling</button>
      </div>
    </div>

    <div class="sellingInfoContainer mb-5" style="background-image: url({{ asset('assets/img/spotlight/sellBg.png') }});">
      <div class="descriptionWrap">
        <h1>Sell anything. Sell to Anyone.</h1>
        <p>Transform clutter into cash with our thrift app! Sell now and declutter effortlessly. Turn your pre-loved items into instant money with just a few taps. Join our community of savvy sellers today!</p>
        <a href="" class="ctaSell">
          <span class="info">Here’s how you can sell</span>
          <span class="ctaIcon"><span class="arrowLine"></span><i class="fa-solid fa-angle-right"></i></span>
        </a>
      </div>
      <div class="starIcon">
        <img src="{{ asset('assets/img/starIcon.svg') }}" alt="">
      </div>
      <div class="buudlIcon">
        <img src="{{ asset('assets/img/buudleIcon2.svg') }}" alt="">
      </div>
    </div>

    <div class="priceInfoContainer">
      <div class="left">
        <h1>Low prices</h1>
        <p>Transform clutter into cash with our thrift app! Sell now and declutter effortlessly. Turn your pre-loved items into instant money with just a few taps. Join our community of savvy sellers today!</p>
        <button class="spotBtn">Thrift</button>
      </div>
      <div class="right position-relative">
        <img src="{{ asset('assets/img/spotlight/thrift.jpg') }}" class="img-fluid" alt="">
        <div class="flowerIcon">
          <img src="{{ asset('assets/img/flowerIcon.svg') }}" alt="">
        </div>
      </div>
    </div>

  </div>

</div>
