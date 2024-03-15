<nav class="navbar navbar-expand-md  navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img class="buudl-logo" src="{{ asset('assets/img/buudl_brown.svg') }}" alt="logo">
    </a>
      <button  class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
      </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <div class="navbar-nav">
        <div class="search">
          <div x-data="{ open: false }">
            <a type="button" x-on:click="open = ! open"  class="searchBtn"><i class="fa fa-search"></i></a>
          <span x-show="open" x-transition><input type="search" class="form-control" autofocus></span>
        </div>
      </div>
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link navBtn" role="button" href="{{ route('login') }}">Sell</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link navBtn" href="{{ route('register') }}" role="button">
            thrift
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}"><i class="fa-solid fa-bag-shopping"></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>