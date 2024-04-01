<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link rel="shortcut icon" href="{{ asset('assets/img/buudl_orange.png') }}" type="image/x-icon">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css" integrity="sha512-d0olNN35C6VLiulAobxYHZiXJmq+vl+BGIgAxQtD5+kqudro/xNMvv2yIHAciGHpExsIbKX3iLg+0B6d0k4+ZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://unpkg.com/swiper@6.8.4/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
  <script defer src="https://unpkg.com/swiper@6.8.4/swiper-bundle.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  @livewireStyles
</head>

<body>

  <div id="app">
    <livewire:components.nav>
      <main>
        @if(request()->path() != 'download')
            <div x-data="{ open: true }" x-init="setTimeout(() => open = true, 50)">
          @else
            <div x-data="{ open: false }">
          @endif
          <!-- Modal Background -->
          <div x-show="open" @click.away="open = false" style="background-color: rgba(0,0,0,.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; z-index:999;">
              <!-- Modal -->
              <div style="background-color: white; padding: 20px; border-radius: 5px; position:absolute; top:50%; left:50%; transform:translateX(-50%); height:200px">
                  <h2 class="mt-3">Download the App</h2>
                  <p>Get our app for the best experience</p>
                  <!-- Close Button -->
                  <button @click="open = false" style="border:none !important; position:absolute; top: 10px; right:10px;"><i class="fa-solid fa-xmark"></i></button>
                  <a href="/download" class="d-block text-center" x-on:click="open = false">Click me</a>
              </div>
          </div>
      </div>

        {{ $slot }}
      </main>
  </div>
  @livewireScripts
</body>
<livewire:components.footer>

</html>
