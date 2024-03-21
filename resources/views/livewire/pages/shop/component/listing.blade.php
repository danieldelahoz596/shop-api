<div>

    <h4 class="ms-5 ps-3 py-4">{{ $productsCount }} listings</h4>

    <div class="container">
        <div class="product_sell_listing row">
            @foreach ($products as $product)
            <div class="product">
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
                        <img class="img img-fluid" src="" alt="" style="object-fit: contain;">
                        <div class="item_description pt-3">
                            <h4>{{$product->product_name}}</h4>
                            <h4><span>₱ </span>{{$product->price}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach



        </div>
    </div>
    <div>

    </div>


    <div class="container text-center pt-5">

        <a href="{{ request()->url() }}/add-products">
            <button class="item_btn">
                List an Item
            </button>
        </a>



    </div>