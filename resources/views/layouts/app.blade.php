<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'AthletiX')</title>
    <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>
  <body class="bg-white min-h-screen">
    <div class="flex">
        {{-- Navbar (reusable partial) --}}
        @include('partials.navbar')
        <main class="flex-1 p-8 bg-white justify-items-between min-h-screen w-screen">
          <header class="flex justify-between items-start mb-1">
            <h1 class="text-4xl font-bold text-brown-primary font-inknut">
              @yield('title')
            </h1>
            @yield('header-actions')
            <!-- <a href="index.html" class="text-brown-primary hover:underline">
              ← Back to Control Panel
            </a> -->
          </header>
            @yield('content')
        </main>
    </div>
  </body>
</html>
<!-- <div class="absolute right-[-8px] top-0 h-full w-1 bg-white rounded-l"></div> -->