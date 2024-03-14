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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css" integrity="sha512-d0olNN35C6VLiulAobxYHZiXJmq+vl+BGIgAxQtD5+kqudro/xNMvv2yIHAciGHpExsIbKX3iLg+0B6d0k4+ZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="//unpkg.com/alpinejs" defer></script>
        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        @livewireStyles
    </head>

    <style>
        .otp-input {
    width: 40px; /* Width of each box */
    height: 40px; /* Height of each box */
    margin: 0 5px; /* Spacing between boxes */
    text-align: center;
    border: 1px solid #ccc; /* Border of the boxes */
    font-size: 20px;
    border-radius: 4px; /* Optional: for rounded corners */

    /* Improves mobile experience */
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
    </style>
    <body>
        <div id="app">
            <livewire:components.nav>
            <main> 
                {{ $slot }}
            </main>
        </div>
        @livewireScripts
        <livewire:components.footer>
    </body>
</html>
