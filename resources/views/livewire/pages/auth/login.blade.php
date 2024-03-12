<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  @vite('resources/css/app.css')
</head>

<body>
  <!-- component -->
  <div class="flex min-h-screen items-center justify-content-end bg-white p-12" style="background-image:url('{{ asset('assets/img/loginBg.png') }}'); background-repeat:no-repeat; background-position:center;">
    <form action="">
      <div class="max-w-sm">
        <div class="rounded-[calc(1.5rem-1px)] bg-transarent px-10 p-12">
          <div>
            <p class="text-2xl text-center tracking-wide font-black">Hello, We're happy to see you here again!</p>
          </div>

          <div class="mt-8 space-y-8">
            <form action="{{ route('login') }}" 
            wire:submit.prevent="submit">
            @csrf
            <div class="space-y-6">
              <input class="w-full bg-white text-gray-600 rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-600 invalid:border-red-500" 

              placeholder="Email or Username" 
              type="username" 
              name="username" 
              id="username" />
              <a href="" class="LoginPhone underline">Login in with Phone Number</a>

              <input class="w-full bg-white text-gray-600 rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-600 invalid:border-red-500" 
              placeholder="Password" type="password" name="password" id="password" />
              <a href="" class="ForgotPassword underline">Forgot Password</a>
            </div>

            <button 
            type="button"
            wire:click="LogIn"
            class="h-9 px-3 w-full bg-orange-600 rounded-md text-white">
              Signin
            </button>
          </form>

            
          </div>
        </div>
      </div>
    </form>
  </div>
</body>

</html>