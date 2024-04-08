<div x-data="{ offcanvasActive: false, searchOpen: false}" @click.away="offcanvasActive = false">
    <nav class="navbar2 navbar d-lg-none navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-lg flex-nowrap">
            <div class="navbarmain-container">
                <button @click="offcanvasActive = !offcanvasActive" class="navbar-toggler" type="button" style="border: none;"><span class="navbar-toggler-icon"></span></button>
                <a class="navbar-brand d-none d-sm-inline" href="{{ url('/') }}">
                  <picture>
                      <source media="(max-width:767.98px)" srcset="{{ asset('assets/img/buudl_red.svg') }}">
                      <img class="buudl-logo img-fluid" src="{{ asset('assets/img/buudl_brown.svg') }}" alt="logo">
                  </picture>
                </a>
            </div>
            <div class="right-nav-show d-flex gap-2 justify-content-end">
                <div class="search w-100 w-lg-50">
                  <div class="d-flex align-items-center justify-content-end" x-data="{ open: false }">
                    <span class="input-span my-2 my-lg-0" x-show="open" style="visibility: visible;">
                        <input placeholder="Search" type="search" wire:model="search" name="search" id="search" class="form-control border border-black" wire:keydown.enter="submit" autofocus>
                    </span>
                    <span class="input-span my-2 my-lg-0" x-show="!open" style="visibility: hidden;"><input type="search" class="form-control" autofocus></span>
                    <a type="button" x-on:click="open = !open" class="searchBtn ps-2 h2 m-0"><i class="fa fa-search"></i></a>
                  </div>
                </div>
                <ul class="navbar-nav d-flex align-items-center flex-row">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><i class="fa-solid fa-bag-shopping"></i></a>
                    </li>
                    <li class="nav-item">
                        @if(!auth()->user())
                        <a class="nav-link navBtn fw-bold" href="{{ route('register') }}" role="button">
                            Sign Up
                        </a>
                        @else
                        <a class="nav-link" href="#" role="button">
                            <i class="fa-solid fa-envelope"></i>
                        </a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <nav id="offcanvas" :class="{ 'show': offcanvasActive }" class="mobile-offcanvas navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container nav-cont">
            <a class="navbar-brand" href="{{ url('/') }}">
                <picture>
                    <source media="(max-width:767.98px)" srcset="{{ asset('assets/img/buudl_red.svg') }}">
                    <img class="buudl-logo img-fluid" src="{{ asset('assets/img/buudl_brown.svg') }}" alt="logo">
                </picture>
            </a>
            <div class="right-nav-show d-none d-lg-flex gap-2">
                <div class="search w-100 w-lg-50">
                  <div class="d-flex align-items-center justify-content-end" x-data="{ open: false }">
                    <span class="input-span my-2 my-lg-0" x-show="open" style="visibility: visible;">
                        <input placeholder="Search" type="search" wire:model="search" name="search" id="search" class="form-control border border-black" wire:keydown.enter="submit" autofocus x-show="open">
                    </span>
                    <span class="input-span my-2 my-lg-0" x-show="!open" style="visibility: hidden;"><input type="search" class="form-control" autofocus x-show="open"></span>
                    <a type="button" x-on:click="open = !open" class="searchBtn ps-2 h2 m-0"><i class="fa fa-search"></i></a>
                  </div>
                </div>
                <ul class="navbar-nav d-flex align-items-center flex-row">
                    <a class="navbar-brand d-none" href="{{ url('/') }}">
                        <picture>
                            <source media="(max-width:767.98px)" srcset="{{ asset('assets/img/buudl_red.svg') }}">
                            <img class="buudl-logo img-fluid" src="{{ asset('assets/img/buudl_brown.svg') }}" alt="logo">
                        </picture>
                    </a>
                    <li class="nav-item">
                        <a class="nav-link navBtn" role="button" href="{{ route('login') }}">Sell</a>
                    </li>
                    <li class="nav-item">
                        @if(!auth()->user())
                        <a class="nav-link navBtn" href="{{ route('register') }}" role="button">
                            thrift
                        </a>
                        @else
                        <a class="nav-link" href="#" role="button">
                            <i class="fa-solid fa-envelope"></i>
                        </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><i class="fa-solid fa-bag-shopping"></i></a>
                    </li>
                    @if(auth()->user())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                            <li><a class="dropdown-item" href="/user/account/profile">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Account Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Order Status</a></li>
                            <li><a class="dropdown-item" href="#">Vouchers</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" style="cursor: pointer" wire:click="logout">Logout</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
            <ul class="navbar-nav d-lg-none pt-4">
                <li class="nav-item"><a class="dropdown-item nav-link" href="#">Shop Everything</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li class="nav-item"><a class="dropdown-item nav-link" href="#">Sale</a></li>
                <li class="nav-item"><a class="dropdown-item nav-link" href="#">Womenswear</a></li>
                <li class="nav-item"><a class="dropdown-item nav-link" href="#">Menswear</a></li>
                <li class="nav-item"><a class="dropdown-item nav-link" href="#">Kids</a></li>
                <li class="nav-item"><a class="dropdown-item nav-link" href="#">My Messages</a></li>
                <li class="nav-item"><a class="dropdown-item nav-link" href="#">My Hub</a></li>
                <li class="nav-item"><a class="dropdown-item nav-link" href="#">My Wallet</a></li>
                @if(auth()->user())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                            <li><a class="dropdown-item" href="/user/account/profile">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Account Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Order Status</a></li>
                            <li><a class="dropdown-item" href="#">Vouchers</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" style="cursor: pointer" wire:click="logout">Logout</a></li>
                        </ul>
                    </li>
                    @endif
            </ul>
        </div>
    </nav>
</div>
    @script
            <script>
                $wire.on('redirectToShop', (data) => {
                    data.forEach((item, index) => {
                        console.log(item);
                        window.location.href = '/shop?keyword=' + item.keyword;
                    })
                });
            </script>
        @endscript
    </nav>
  
      

</div>
