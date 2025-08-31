<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'AthletiX')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css') {{-- optional, if using Vite --}}
  </head>
  <body>
    <main class="bg-white grid justify-items-center [align-items:start] w-screen">
      <div class="bg-white overflow-hidden border border-solid border-black w-[1280px] h-[720px] relative">

        {{-- Navbar (reusable partial) --}}
        @include('partials.navbar')

        {{-- Page Content --}}
        @yield('content')

      </div>
    </main>
  </body>
</html>
