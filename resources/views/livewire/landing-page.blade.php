<div class="pb-4 section-landing">
  <div class="container-fluid px-0 position-relative">
    <div class="container carouselLinks position-absolute end-50 z-1">
      <div class="standard-cat">
        <ul class="nav justify-content-evenly">
          <li class="nav-item display-6">
            <a class="nav-link text-secondary" href="/shop/women">womenswear</a>
          </li>
          <li class="nav-item display-6">
            <a class="nav-link text-secondary" href="/shop/men">menswear</a>
          </li>
          <li class="nav-item display-6">
            <a class="nav-link text-secondary" href="/shop/kids">kids</a>
          </li>
          <li class="nav-item display-6">
            <a class="nav-link text-secondary" href="/shop/steals">steals</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="container-fluid px-0">
      <div id="buudlCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#buudlCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#buudlCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#buudlCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ asset('assets/img/slides/banner1.png') }}" class="d-block w-100 carousel-image" alt="slide_1">
            <div class="carousel-caption d-flex flex-column align-items-center">
              <h5 class="display-1 m-0 p-0">First slide label</h5>
              <p class="m-0 p-0 container-xl h1 container-md">Be part of our community. Thrift. Shop. Circular fashion. Save earth. be part of our community. Thrift. Shop. Circular fashion. Save earth. be part of our community. Thrift. Shop. Circular fashion. Save earth.</p>
              <button class="carouselBtn">Let's go!</button>
            </div>
          </div>
          <div class="carousel-item">
            <img src="{{ asset('assets/img/slides/banner2.png') }}" class="d-block w-100 carousel-image" alt="slide_2">
            <div class="carousel-caption d-flex flex-column align-items-center">
              <h5 class="display-1 m-0 p-0">Second slide label</h5>
              <p class="m-0 p-0 container-xl h1 container-md">Be part of our community. Thrift. Shop. Circular fashion. Save earth. be part of our community. Thrift. Shop. Circular fashion. Save earth. be part of our community. Thrift. Shop. Circular fashion. Save earth.</p>
              <button class="carouselBtn">Let's go!</button>
            </div>
          </div>
          <div class="carousel-item">
            <img src="{{ asset('assets/img/slides/banner3.png') }}" class="d-block w-100 carousel-image" alt="slide_3">
            <div class="carousel-caption d-flex flex-column align-items-center">
              <h5 class="display-1 m-0 p-0">Third slide label</h5>
              <p class="m-0 p-0 container-xl h1 container-md">Be part of our community. Thrift. Shop. Circular fashion. Save earth. be part of our community. Thrift. Shop. Circular fashion. Save earth. be part of our community. Thrift. Shop. Circular fashion. Save earth.</p>
              <button class="carouselBtn ">Let's go!</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <livewire:components.landing.popularItems />
  <livewire:components.landing.steals />
  <livewire:components.landing.brands />
  <livewire:components.landing.spotlight />
  <livewire:components.landing.featuredItem />
  <livewire:components.landing.emailSubscribe />
</div>


