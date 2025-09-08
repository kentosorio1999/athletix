<!-- Sidebar -->
<aside id="sidebar" class="w-28 bg-[#8C2C08] min-h-screen flex flex-col items-center py-6 fixed md:static md:translate-x-0 transform -translate-x-full transition-transform duration-300 z-50">
  <!-- Logo -->
  <div class="mb-8">
    <img 
      src="https://c.animaapp.com/meod3nrskPlg16/img/logo.png" 
      alt="Organization logo" 
      class="w-16 h-16 object-contain"
    />
  </div>
  
  <!-- Navigation Icons -->
  <nav class="flex flex-col space-y-2 w-full px-2" role="navigation" aria-label="Main navigation">

    <!-- Dashboard -->
    <div class="relative group">
      <a href="{{ route('dashboard') }}" class="w-12 h-12 mx-auto text-white hover:bg-[#3E1F0A] transition-colors flex items-center justify-center">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <rect x="3" y="3" width="8" height="8" rx="1"/>
          <rect x="13" y="3" width="8" height="8" rx="1"/>
          <rect x="3" y="13" width="8" height="8" rx="1"/>
          <rect x="13" y="13" width="8" height="8" rx="1"/>
        </svg>
        @if (request()->routeIs('dashboard'))
          <div class="absolute right-[-8px] top-0 h-full w-1 bg-white rounded-l"></div>
        @endif
        </a>
      <span class="absolute left-14 top-1/2 -translate-y-1/2 whitespace-nowrap bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Dashboard</span>
    </div>

    <!-- Announcements -->
    <div class="relative group">
      <a href="{{ route('announcements') }}" class="w-12 h-12 mx-auto text-white hover:bg-[#3E1F0A] transition-colors flex items-center justify-center">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M4 10v4c0 1.1.9 2 2 2h2l4 5V5L8 9H6c-1.1 0-2 .9-2 2zm10-5v14l7-5V10l-7-5z"/>
        </svg>
        @if (request()->routeIs('announcements'))
          <div class="absolute right-[-8px] top-0 h-full w-1 bg-white rounded-l"></div>
        @endif
      </a>
      <span class="absolute left-14 top-1/2 -translate-y-1/2 whitespace-nowrap bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Announcements</span>
    </div>

    <!-- Control Panel -->
    <div class="relative group">
      <a href="{{ route('control.panel') }}" class="w-12 h-12 mx-auto text-white hover:bg-[#3E1F0A] transition-colors flex items-center justify-center">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
        </svg>
        @if (request()->routeIs('control.panel'))
          <div class="absolute right-[-8px] top-0 h-full w-1 bg-white rounded-l"></div>
        @endif
      </a>
      <span class="absolute left-14 top-1/2 -translate-y-1/2 whitespace-nowrap bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Control Panel</span>
    </div>

    <!-- Performance -->
    <div class="relative group">
      <a href="{{ route('performance') }}" class="w-12 h-12 mx-auto text-white hover:bg-[#3E1F0A] transition-colors flex items-center justify-center">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
        </svg>
        @if (request()->routeIs('performance'))
          <div class="absolute right-[-8px] top-0 h-full w-1 bg-white rounded-l"></div>
        @endif
      </a>
      <span class="absolute left-14 top-1/2 -translate-y-1/2 whitespace-nowrap bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Performance</span>
    </div>

    <!-- Events -->
    <div class="relative group">
      <a href="{{ route('events') }}" class="w-12 h-12 mx-auto text-white hover:bg-[#3E1F0A] transition-colors flex items-center justify-center">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
        </svg>
        @if (request()->routeIs('events'))
          <div class="absolute right-[-8px] top-0 h-full w-1 bg-white rounded-l"></div>
        @endif
      </a>
      <span class="absolute left-14 top-1/2 -translate-y-1/2 whitespace-nowrap bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Events</span>
    </div>

    <!-- Attendance -->
    <div class="relative group">
      <a href="{{ route('attendance') }}" class="w-12 h-12 mx-auto text-white hover:bg-[#3E1F0A] transition-colors flex items-center justify-center">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10"/>
          <path d="m9 12 2 2 4-4"/>
        </svg>
        @if (request()->routeIs('attendance'))
          <div class="absolute right-[-8px] top-0 h-full w-1 bg-white rounded-l"></div>
        @endif
      </a>
      <span class="absolute left-14 top-1/2 -translate-y-1/2 whitespace-nowrap bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Attendance</span>
    </div>

    <!-- Reports -->
    <div class="relative group">
      <a href="{{ route('reports') }}" class="w-12 h-12 mx-auto text-white hover:bg-[#3E1F0A] transition-colors flex items-center justify-center">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
        </svg>
        @if (request()->routeIs('reports'))
          <div class="absolute right-[-8px] top-0 h-full w-1 bg-white rounded-l"></div>
        @endif
      </a>
      <span class="absolute left-14 top-1/2 -translate-y-1/2 whitespace-nowrap bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Reports</span>
    </div>

    <!-- Messages -->
    <div class="relative group">
      <a href="{{ route('messages') }}" class="w-12 h-12 mx-auto text-white hover:bg-[#3E1F0A] transition-colors flex items-center justify-center">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4v3c0 .6.4 1 1 1h.5c.2 0 .5-.1.7-.3L14.6 18H20c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
        </svg>
        @if (request()->routeIs('messages'))
          <div class="absolute right-[-8px] top-0 h-full w-1 bg-white rounded-l"></div>
        @endif
      </a>
      <span class="absolute left-14 top-1/2 -translate-y-1/2 whitespace-nowrap bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Messages</span>
    </div>

    <!-- Schedule -->
    <div class="relative group">
      <a href="{{ route('schedule') }}" class="w-12 h-12 mx-auto text-white hover:bg-[#3E1F0A] transition-colors flex items-center justify-center">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
          <line x1="16" y1="2" x2="16" y2="6"/>
          <line x1="8" y1="2" x2="8" y2="6"/>
          <line x1="3" y1="10" x2="21" y2="10"/>
        </svg>
        @if (request()->routeIs('schedule'))
          <div class="absolute right-[-8px] top-0 h-full w-1 bg-white rounded-l"></div>
        @endif
      </a>
      <span class="absolute left-14 top-1/2 -translate-y-1/2 whitespace-nowrap bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Schedule</span>
    </div>

    <!-- Notifications -->
    <div class="relative group">
      <a href="{{ route('notifications') }}" class="w-12 h-12 mx-auto text-white hover:bg-[#3E1F0A] transition-colors flex items-center justify-center">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
        </svg>
        @if (request()->routeIs('notifications'))
          <div class="absolute right-[-8px] top-0 h-full w-1 bg-white rounded-l"></div>
        @endif
      </a>
      <span class="absolute left-14 top-1/2 -translate-y-1/2 whitespace-nowrap bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Notifications</span>
    </div>

    <!-- Settings -->
    <div class="relative group">
      <a href="{{ route('settings') }}" class="w-12 h-12 mx-auto text-white hover:bg-[#3E1F0A] transition-colors flex items-center justify-center">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/>
        </svg>
        @if (request()->routeIs('settings'))
          <div class="absolute right-[-8px] top-0 h-full w-1 bg-white rounded-l"></div>
        @endif
      </a>
      <span class="absolute left-14 top-1/2 -translate-y-1/2 whitespace-nowrap bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Settings</span>
    </div>
    

    <!-- Logout -->
    <div class="relative group">
      <a href="{{ url('/logout') }}" class="w-12 h-12 mx-auto text-white hover:bg-[#3E1F0A] transition-colors flex items-center justify-center">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
          <polyline points="16,17 21,12 16,7"/>
          <line x1="21" y1="12" x2="9" y2="12"/>
        </svg>
      </a>
      <span class="absolute left-14 top-1/2 -translate-y-1/2 whitespace-nowrap bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Logout</span>
    </div>

  </nav>
</aside>

<!-- Mobile Toggle Button -->
<button id="menu-toggle" class="absolute top-4 left-4 z-50 md:hidden bg-[#5C2E0E] text-white p-2 rounded">
  ☰
</button>

<script>
  // Mobile sidebar toggle
  document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const toggle = document.getElementById("menu-toggle");

    toggle.addEventListener("click", () => {
      sidebar.classList.toggle("-translate-x-full");
    });
  });
</script>
