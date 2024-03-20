<div>
    <ul class="nav d-flex justify-content-between w-30 w-xl-50 ms-4">
        <li class="nav-item h3
    ">
            <a class="nav-link muted active" aria-current="page" href="#">Selling</a>
        </li>
        <li class="nav-item h3
    ">
            <a class="nav-link muted" href="#">Likes</a>
        </li>
        <li class="nav-item h3
    ">
            <a class="nav-link muted" href="#">Purchases</a>
        </li>
    </ul>

    <h4 class="ms-5 ps-3 py-4">4 listings</h4>

    <div class="container">
        <div class="product_sell_listing row">
            <div class="col-lg-3">
                <div class="items position-relative">
                    <span class="badges position-absolute d-flex flex-column">
                        <span class="bag_icon bg-light rounded-5 px-2">
                            <i class="fa-solid fa-bag-shopping"></i>
                            0
                        </span>
                        <span class="view_icon bg-light rounded-5 px-2">
                            <i class="fa-regular fa-eye"></i>
                            3
                        </span>
                    </span>
                    <img class="img img-fluid" src="{{ asset('assets/img/profile_listing/item1.png') }}" alt=""
                        style="object-fit: contain;">
                    <div class="item_description pt-3">
                        <h4>Denim Pants</h4>
                        <h4>P 400</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="items position-relative">
                    <span class="badges position-absolute d-flex flex-column">
                        <span class="bag_icon bg-light rounded-5 px-2">
                            <i class="fa-solid fa-bag-shopping"></i>
                            0
                        </span>
                        <span class="view_icon bg-light rounded-5 px-2">
                            <i class="fa-regular fa-eye"></i>
                            3
                        </span>
                    </span>
                    <img class="img img-fluid" src="{{ asset('assets/img/profile_listing/item2.png') }}" alt=""
                        style="object-fit: contain;">
                    <div class="item_description pt-3">
                        <h4>Beach Polo</h4>
                        <h4>P 300</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="items position-relative">
                    <span class="badges position-absolute d-flex flex-column">
                        <span class="bag_icon bg-light rounded-5 px-2">
                            <i class="fa-solid fa-bag-shopping"></i>
                            0
                        </span>
                        <span class="view_icon bg-light rounded-5 px-2">
                            <i class="fa-regular fa-eye"></i>
                            3
                        </span>
                    </span>
                    <img class="img img-fluid" src="{{ asset('assets/img/profile_listing/item3.png') }}" alt=""
                        style="object-fit: contain;">
                    <div class="item_description pt-3">
                        <h4>Orange Pants</h4>
                        <h4>P 600</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="items position-relative">
                    <span class="badges position-absolute d-flex flex-column">
                        <span class="bag_icon bg-light rounded-5 px-2">
                            <i class="fa-solid fa-bag-shopping"></i>
                            0
                        </span>
                        <span class="view_icon bg-light rounded-5 px-2">
                            <i class="fa-regular fa-eye"></i>
                            3
                        </span>
                    </span>
                    <img class="img img-fluid" src="{{ asset('assets/img/profile_listing/item4.png') }}" alt=""
                        style="object-fit: contain;">
                    <div class="item_description pt-3">
                        <h4>Shiny Tops</h4>
                        <h4>P 400</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container text-center pt-5">

        <a href="profile/{{$this->id}}/add-product">
            <button class="item_btn">
                List an Item
            </button></a>
    </div>



</div>