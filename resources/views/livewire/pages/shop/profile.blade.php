<div>
  <div class="container-fluid border border-black" style="height:100vh;">
    <div class="row" style="height:100vh">
      <div class="col-xxl-3 col-xl-4 left border-end">
        <div class="container">
          <div class="w-100 text-end pt-4">
            <div class="dropdown">
              <a class=" dropdown-toggle settings h4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis"></i>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Report Seller</a></li>
                <li><a class="dropdown-item" href="#">Block Seller</a></li>
              </ul>
            </div>
          </div>
          <div class="user_profile d-flex pb-2 ps-4">
            <img class="img-fluid" src="{{ asset('assets/img/public_profile/Vector.jpg') }}" alt="">
            <div class="user_name ps-4">
              <h1>Beautiful Shop</h1>
              <p><span class="location_icon"> <i class="fa-solid fa-location-dot"></i> </span><span class="location">Cebu City</span></p>
            </div>
          </div>
          <div class="user_description">
            <h4>Fashion is nice! Follow me for updates</h4>
            <div class="row py-4">
              <div class="col-4 text-center">
                <div class="review">
                  <p class="h3"><span class="text-danger"><i class="fa-solid fa-star"></i></span><span class="h1">4.8</span></p>
                  <p class="h5 muted">4 Reviews</p>
                </div>
              </div>
              <div class="col-4 text-center">
                <div class="followers">
                  <h1>4</h1>
                  <p class="h5 muted">Followers</p>
                </div>
              </div>
              <div class="col-4 text-center">
                <div class="following">
                  <h1>8</h1>
                  <p class="h5 muted">Following</p>
                </div>
              </div>
            </div>
            <div class="row ps-4">
              <div class="col-9">
                <button class="edit_btn">
                  Edit Profile
                </button>
              </div>
              <div class="col-3">
                <button class="share_btn">
                  <span class="h2"><i class="fa-solid fa-arrow-up-from-bracket"></i></span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-9 col-xl-8 right p-0 m-0 py-4">
        <livewire:pages.shop.component.listing />
      </div>
    </div>
  </div>
</div>