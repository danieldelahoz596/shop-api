<nav class="navbar navbar-expand-lg  navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img class="buudl-logo img-fluid" src="{{ asset('assets/img/buudl_brown.svg') }}" alt="logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <div class="navbar-nav-container position-relative flex-column flex-lg-row">
        <div class="search w-100 w-lg-50">
          <div class="d-flex align-items-center justify-content-end" x-data="{ open: false }">
            <span class="input-span my-2 my-lg-0" x-show="open" style="visibility: visible;"><input placeholder="Search" type="search" class="form-control border border-black" autofocus></span>
            <span class="input-span my-2 my-lg-0" x-show="!open" style="visibility: hidden;"><input type="search" class="form-control" autofocus></span>
            <a type="button" x-on:click="open = !open" class="searchBtn ps-2 h3 m-0"><i class="fa fa-search"></i></a>
          </div>
        </div>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav d-flex align-items-center flex-row">
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
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><a class="dropdown-item" href="#">Account Settings</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Order Status</a></li>
              <li><a class="dropdown-item" href="#">Vouchers</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="/">Logout</a></li>
            </ul>
          </li>
          @endif
        </ul>
      </div>
    </div>
</nav>