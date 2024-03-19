<div class="py-4">
  <div class="placeItemheader container-fluid d-flex align-items-center justify-content-between pb-4">
    <span class="h2 me-2"><strong>Popular items</strong></span>
    <a href="" class="text-black ms-2"><u>More</u></a>
  </div>

  <div x-data="{swiper: null}" x-init="swiper = new Swiper($refs.container, {
      loop: true,
      autoplay: {
        delay: 5000,
      },
      parallax: true,
      rewind: true,

      
      slidesPerView: 1,
      spaceBetween: 0,
  
      breakpoints: {
        640: {
          slidesPerView: 1,
          spaceBetween: 0,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 0,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 0,
        },
        1399: {
          slidesPerView: 4,
          spaceBetween: 0,
        },
      },
    })" class="position-relative mx-auto d-flex flex-row">
    <div class="position-absolute top-50 start-0 translate-middle-y z-3 d-flex align-items-center">
      <button @click="swiper.slidePrev()" class="btn btn-light position-relative ms-n2 ms-lg-n4 d-flex justify-content-center align-items-center rounded-circle shadow focus-outline-none" style="width: 2.5rem; height: 2.5rem;">
        <svg viewBox="0 0 20 20" fill="currentColor" class="chevron-left w-6 h-6">
          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>

    <div class="position-absolute top-50 end-0 translate-middle-y z-3 d-flex align-items-center">
      <button @click="swiper.slideNext()" class="btn btn-light position-relative ms-n2 ms-lg-n4 d-flex justify-content-center align-items-center rounded-circle shadow focus-outline-none" style="width: 2.5rem; height: 2.5rem;">
        <svg viewBox="0 0 20 20" fill="currentColor" class="chevron-right w-6 h-6">
          <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>

    <div class="swiper-container" x-ref="container">
      <div class="swiper-wrapper">
        <!-- Slides -->
        <div class="swiper-slide p-4">
          <div class="d-flex flex-column rounded shadow overflow-hidden">
            <div class="brandImg">
            <a href="" class="img"><img src="{{ asset('assets/img/brands/brandimg3.jpg') }}" alt=""></a>
            </div>
            <div class="imgContent text-start">
              <h3 class="m-0">skirts</h3>
              <div class="price lh-1">P 200</div>
            </div>
          </div>
        </div>

        <div class="swiper-slide p-4">
          <div class="d-flex flex-column rounded shadow overflow-hidden">
            <div class="brandImg">
              <a href="" class="img"><img src="{{ asset('assets/img/brands/brandimg2.jpg') }}" alt=""></a>
            </div>
            <div class="imgContent text-start">
              <h3 class="m-0">skirts</h3>
              <div class="price lh-1">P 200</div>
            </div>
          </div>
        </div>

        <div class="swiper-slide p-4">
          <div class="d-flex flex-column rounded shadow overflow-hidden">
            <div class="brandImg">
              <a href="" class="img"><img src="{{ asset('assets/img/brands/brandimg1.jpg') }}" alt=""></a>
            </div>
            <div class="imgContent text-start">
              <h3 class="m-0">skirts</h3>
              <div class="price lh-1">P 200</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid shopByCategory mt-5">
    <div class="left position-relative">
      <div class="img"><img src="{{ asset('assets/img/buudlSmallIcon.svg') }}" alt=""></div>
      <h1>Shop in</h1>
      <h5>Who are you shopping for?</h5>
    </div>
    <div class="right">
      <ul class="listCategory">
        <li><a href="" class="link"><span>Women</span><span><i class="fa-solid fa-arrow-right"></i></span></a></li>
        <li><a href="" class="link"><span>Men</span><span><i class="fa-solid fa-arrow-right"></i></span></a></li>
        <li><a href="" class="link"><span>Kids</span><span><i class="fa-solid fa-arrow-right"></i></span></a></li>
        <li><a href="" class="link active"><span>Everything</span><span><i class="fa-solid fa-arrow-right"></i></span></a></li>
      </ul>
    </div>
  </div>

  <div class="container-fluid">
    <h1>People are talking about...</h1>
    <div class="catogeryList">
      <div class="itemWrap">
        <div class="placeItemGrid">
          <div class="itemImg">
            <a href="" class="image">
              <img src="{{ asset('assets/img/category/category1.png') }}" alt="">
            </a>
          </div>
          <div class="itemContent text-start">
            <h3 class="m-0">skirts</h3>
            <div class="price lh-1">4.k searches this week</div>
          </div>
        </div>
      </div>
      <div class="itemWrap">
        <div class="placeItemGrid">
          <div class="itemImg">
            <a href="" class="d-block image">
              <img src="{{ asset('assets/img/category/category2.png') }}" alt="">
            </a>
          </div>
          <div class="itemContent text-start">
            <h3 class="m-0"> dress </h3>
            <div class="price lh-1">4.k searches this week</div>
          </div>
        </div>
      </div>
      <div class="itemWrap">
        <div class="placeItemGrid">
          <div class="itemImg">
            <a href="" class="d-block image">
              <img src="{{ asset('assets/img/category/category1.png') }}" alt="">
            </a>
          </div>
          <div class="itemContent text-start">
            <h3 class="m-0">tops</h3>
            <div class="price lh-1">4.k searches this week</div>
          </div>
        </div>
      </div>
      <div class="itemWrap">
        <div class="placeItemGrid">
          <div class="itemImg">
            <a href="" class="d-block image">
              <img src="{{ asset('assets/img/category/category2.png') }}" alt="">
            </a>
          </div>
          <div class="itemContent text-start">
            <h3 class="m-0">tops</h3>
            <div class="price lh-1">4.k searches this week</div>
          </div>
        </div>
      </div>
      <div class="itemWrap">
        <div class="placeItemGrid">
          <div class="itemImg">
            <a href="" class="d-block image">
              <img src="{{ asset('assets/img/category/category1.png') }}" alt="">
            </a>
          </div>
          <div class="itemContent text-start">
            <h3 class="m-0">tops</h3>
            <div class="price lh-1">4.k searches this week</div>
          </div>
        </div>
      </div>
      <div class="itemWrap">
        <div class="placeItemGrid">
          <div class="itemImg">
            <img src="{{ asset('assets/img/category/category2.png') }}" alt="">
            <img src="" alt="">
            </a>
          </div>
          <div class="itemContent text-start">
            <h3 class="m-0">tops</h3>
            <div class="price lh-1">4.k searches this week</div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>