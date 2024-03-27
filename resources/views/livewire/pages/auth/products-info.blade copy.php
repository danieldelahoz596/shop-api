<!-- product-info.blade.php -->
<!-- create a Model for Products with Reviews and connected to Seller-->

<div class="container my-4">
    <div class="card mb-3" style="border: none;">
        <div class=" row g-0" style="border: none;">
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <!-- $product->imageUrl  -->
                <div class="container mt-5">
                    <div class="row">
                        <!-- Thumbnails on the left -->
                        <div class="col-2 thumbnail-column">
                            <div
                                class="thumbnail-selector d-flex flex-column align-items-center justify-content-between h-100">
                                <img src="{{ asset('assets/img/1-Background.png') }}" class="active w-100"
                                    data-bs-target="#mainCarousel" data-bs-slide-to="0">
                                <img src="{{ asset('assets/img/1-Background.png') }}" data-bs-target="#mainCarousel"
                                    data-bs-slide-to="1" class="w-100">
                                <img src="{{ asset('assets/img/1-Background.png') }}" data-bs-target="#mainCarousel"
                                    data-bs-slide-to="2" class="w-100">
                                <!-- Add more thumbnails as needed -->
                            </div>
                        </div>
                        <!-- Main carousel -->
                        <div class="col-10">
                            <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
                                <!-- Carousel content -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('assets/img/1-Background.png') }}" class="d-block w-100"
                                            alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('assets/img/1-Background.png') }}" class="d-block w-100"
                                            alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('assets/img/1-Background.png') }}" class="d-block w-100"
                                            alt="...">
                                    </div>
                                    <!-- Add more carousel items as needed -->
                                </div>
                                <!-- Controls -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <div class="like-counter">
                                <i class="fa-solid fa-heart text-primary"></i>
                                <span>51</span>
                                <i class="fa-solid fa-bag-shopping text-primary"></i>
                                <span>4</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h3 class="card-title" style="font-weight: bold;">
                        {{ $product->product_name }}
                    </h3>
                    <p class="card-text"><small class="text-muted">
                            {{ $product->product_description }}
                        </small>
                    </p>
                    <p class="card-text">
                        ₱ {{ $product->price }}

                    </p>

                    <div class="d-flex flex-column w-25 gap-2 pt-3 pb-3 pe-3">
                        <button wire:click="buyNow" class="btn btn-primary">Buy now</button>
                        <button wire:click="addToBag" class="btn btn-outline-secondary">Make an Offer</button>
                        <div x-data="{ open: false }">
                            <button wire:click="addToCart" class="btn btn-outline-secondary">Add to bag</button>

                            <!-- Notification Pop-up -->
                            <div x-show="open"
                                @productAddedToCart.window="open = true; setTimeout(() => open = false, 3000);">
                                Product added to cart!
                            </div>
                        </div>

                        <script>
                        Livewire.on('productAddedToCart', () => {
                            alert('Product added to cart!');
                            // You could expand this to show a modal or a toast instead of an alert
                        });
                        </script>
                    </div>
                    <p class="card-text">
                    <div class="mb-2">
                        <div>
                            @if(!empty($keywords))
                            @foreach ($keywords as $keyword)
                            <span class="badge bg-secondary">{{ $keyword }}</span>
                            @endforeach
                            @else
                            <p>No keywords found.</p>
                            @endif
                        </div>

                    </div>
                    </p>
                    <div>
                        <ul style=" list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;">
                            <li style="float: left;
  margin-right: 5px;"><small class="text-muted">Retro</small></li>
                            <li style="float: left; margin-right: 5px;"><small class="text-muted">Streetwear</small>
                            </li>
                            <li style="float: left;
  margin-right: 5px;"><small class="text-muted">Casual</small></li>
                            <li style="float: left;
  margin-right: 5px;"><small class="text-muted">Y2K</small></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Seller Info -->


    <div class="card " style="border:none; ">
        <div class="row">
            <div class="col-md-6 d-flex flex-row justify-content-center align-items-center gap-4">
                <div class="p-2">
                    <img src="https://i2.cdn.turner.com/cnnnext/dam/assets/140926165711-john-sutter-profile-image-large-169.jpg"
                        alt="Profile Picture" class="img-fluid rounded-circle"
                        style="width: 50px; height: 50px; object-fit: cover;">
                </div>
                <div class="mt-3">
                    <h6 class="card-subtitle text-muted">Seller: {{$user->name}}</h6>
                    <p class="text-primary mb-0">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </p>
                    <p class="text-muted">{{$user->address}} | Active now</p>
                </div>
                <div>
                    <button class="btn btn-outline-primary px-4 my-4 btn-sm mx-1">Ask a Question</button>
                    <a href="/profile/{{ $user->id }}"><button class="btn btn-outline-primary px-4 my-4 btn-sm mx-1">
                            <i class="bi bi-shop"></i> Visit Shop
                        </button></a>
                </div>
            </div>
            <div class="col-md-6 d-flex">


                <div class="col-md-6">
                    <span>Products</span>
                    <br>
                    <span>Response Rate</span>
                    <br>
                    <span>Response Time</span>
                    <br>
                    <span>Joined</span>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <!-- create a review backend -->
        <div class="card mt-3">
            <div class="card-header">
                Reviews
            </div>
            @livewire('review-form', ['product' => $product])
            @livewire('product-reviews', ['product' => $product])

        </div>

        @script
        <script>
        Alpine.data('counter', () => {
            return {
                count: 0,
                increment() {
                    this.count++
                },
            }
        })
        // JavaScript to synchronize thumbnails with the carousel
        const thumbnails = document.querySelectorAll('.thumbnail-selector img');
        const updateThumbnails = (activeIndex) => {
            thumbnails.forEach((thumbnail, index) => {
                thumbnail.classList.toggle('active', index === activeIndex);
            });
        };

        // When a thumbnail is clicked, update the thumbnails
        thumbnails.forEach((thumbnail, index) => {
            thumbnail.addEventListener('click', () => {
                updateThumbnails(index);
            });
        });

        // Update thumbnails when the carousel changes
        const mainCarousel = document.querySelector('#mainCarousel');
        mainCarousel.addEventListener('slide.bs.carousel', (event) => {
            updateThumbnails(event.to);
        });
        </script>
        @endscript