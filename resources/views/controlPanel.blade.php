@extends('layouts.app')

@section('title', 'AthletiX - Control Panel')

@section('content')
<header class="absolute w-[296px] h-[97px] top-6 left-[145px]">
  <h1 class="font-bold text-[#8c2c08] text-2xl">Control Panel</h1>
  <div class="absolute top-[69px] left-[59px] font-bold text-black text-2xl">
    Admin
  </div>
</header>

<section class="absolute top-[150px] left-[145px] grid grid-cols-3 gap-6" aria-label="Admin dashboard functions">
  <div class="bg-gray-200 p-6 rounded-lg shadow w-[250px] h-[150px] flex items-center justify-center">
    Manage Users
  </div>
  <div class="bg-gray-200 p-6 rounded-lg shadow w-[250px] h-[150px] flex items-center justify-center">
    Schedule Events
  </div>
  <div class="bg-gray-200 p-6 rounded-lg shadow w-[250px] h-[150px] flex items-center justify-center">
    Reports
  </div>
</section>
@endsection
    