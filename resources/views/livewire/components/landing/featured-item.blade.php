<div class="p-4">
  <div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center px-4">
      <h1>Featured Items</h1>
      <a href="">More</a>
    </div>

    <div class="brandImages">
      <div class="imgWrap">
        @foreach ($featuredItems as $featuredItem)
            <div class="placeItemGrid">
                <div class="brandImg">
                <a href="" class="img"><img src="{{ asset('assets/img/brands/'.$featuredItem->image) }}" alt=""></a>
                </div>
                <div class="imgContent">
                <h3>{{ $featuredItem->product_name }} from {{ $featuredItem->product_brand }}</h3>
                </div>
            </div>
        @endforeach
      </div>
    </div>

    <div class="communityContainer pt-5">
      <div class="communityWrapper">
        <div class="communityItems">
          <div class="img"><img src="{{ asset('assets/img/featured/communityImg1.png') }}" alt=""></div>
          <div class="cta">
            <h1>Join our community</h1>
            <button class="commBtn">Join</button>
          </div>
        </div>
        <div class="communityItems">
          <div class="img"><img src="{{ asset('assets/img/featured/communityImg1.png') }}" alt=""></div>
          <div class="cta">
            <h1>Join our community</h1>
            <button class="commBtn">Join</button>
          </div>
        </div>
        <div class="communityItems">
          <div class="img"><img src="{{ asset('assets/img/featured/communityImg1.png') }}" alt=""></div>
          <div class="cta">
            <h1>Join our community</h1>
            <button class="commBtn">Join</button>
          </div>
        </div>
        <div class="communityItems">
          <div class="img"><img src="{{ asset('assets/img/featured/communityImg1.png') }}" alt=""></div>
          <div class="cta">
            <h1>Join our community</h1>
            <button class="commBtn">Join</button>
          </div>
        </div>
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
</div>
