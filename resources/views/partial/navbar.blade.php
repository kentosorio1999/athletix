<nav class="absolute w-[117px] h-[720px] top-0 left-0 bg-[#8c2c08] border border-solid"
     role="navigation" aria-label="Main navigation">

  <!-- Logo -->
  <img class="absolute w-[73px] h-[72px] top-2 left-5"
       src="{{ asset('assets/logo.png') }}"
       alt="Organization logo" />

  <!-- Example links -->
  <ul class="absolute top-[100px] left-5 space-y-6 text-white">
    <li>
      <a href="{{ route('control') }}"
         class="{{ Route::is('control') ? 'font-bold underline' : '' }}">
         Control Panel
      </a>
    </li>
    <li>
      <a href="{{ route('announcement') }}"
         class="{{ Route::is('announcement') ? 'font-bold underline' : '' }}">
         Announcements
      </a>
    </li>
  </ul>
</nav>
