@extends('layouts.app')

@section('title', 'Control Panel')

@section('content')
      <!-- Admin Section -->
      <section class="mb-12">
        <h2 class="text-2xl font-bold text-black mb-6">Admin</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Dashboard Card -->
          <article 
            class="bg-gray-50 rounded-lg border border-black p-6 hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:-translate-y-1"
            onclick="openUserModal()"
            role="button"
            tabindex="0"
            aria-label="Dashboard - View analytics and statistics"
          >
            <div class="flex flex-col items-center text-center">
              <div class="mb-4">
                <img
                  src="https://c.animaapp.com/meod3nrskPlg16/img/vector-8.svg"
                  alt="Dashboard icon"
                  class="w-12 h-12"
                />
              </div>
              <h3 class="text-xl font-bold text-black mb-2">
                Manage User
              </h3>
              <p class="text-gray-500 text-sm">
                Add coaches, players or other admin staff.
              </p>
            </div>
          </article>

          <!-- Reports Card -->
          <article 
            class="bg-gray-50 rounded-lg border border-black p-6 hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:-translate-y-1"
            role="button"
            tabindex="0"
            aria-label="View and Export Report - Export performance or attendance reports"
          >
            <div class="flex flex-col items-center text-center">
              <div class="mb-4">
                <img
                  src="https://c.animaapp.com/meod3nrskPlg16/img/vector-2.svg"
                  alt="Report export icon"
                  class="w-12 h-12"
                />
              </div>
              <h3 class="text-xl font-bold text-black mb-2">
                View and Export Report
              </h3>
              <p class="text-gray-500 text-sm">
                Export performance or attendance reports.
              </p>
            </div>
          </article>

          <!-- Facilities Card -->
          <article 
            class="bg-gray-50 rounded-lg border border-black p-6 hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:-translate-y-1"
            role="button"
            tabindex="0"
            aria-label="Manage Schedule and Facilities - Allocate training slots or meeting rooms"
          >
            <div class="flex flex-col items-center text-center">
              <div class="mb-4">
                <img
                  src="https://c.animaapp.com/meod3nrskPlg16/img/vector-1.svg"
                  alt="Facility management icon"
                  class="w-12 h-12"
                />
              </div>
              <h3 class="text-xl font-bold text-black mb-2">
                Manage Schedule and Facilities
              </h3>
              <p class="text-gray-500 text-sm">
                Allocate training slots or meeting rooms.
              </p>
            </div>
          </article>
        </div>
      </section>
      
      <!-- User Modal -->
      <div id="userModal" class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-8 relative">
          <!-- Close Button -->
          <button onclick="closeUserModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            ✕
          </button>

          <h2 class="text-2xl font-bold mb-6 text-center">Add New User</h2>

          <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <!-- Username -->
            <div class="mb-4">
              <label class="block text-gray-700 font-medium mb-2">Username</label>
              <input type="text" name="username" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-amber-200" />
            </div>

            <!-- Password -->
            <div class="mb-4">
              <label class="block text-gray-700 font-medium mb-2">Password</label>
              <input type="password" name="password" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-amber-200" />
            </div>

            <!-- First Name -->
            <div class="mb-4">
              <label class="block text-gray-700 font-medium mb-2">First Name</label>
              <input type="text" name="first_name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-amber-200" />
            </div>

            <!-- Last Name -->
            <div class="mb-4">
              <label class="block text-gray-700 font-medium mb-2">Last Name</label>
              <input type="text" name="last_name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-amber-200" />
            </div>

            <!-- Role -->
            <div class="mb-4">
              <label class="block text-gray-700 font-medium mb-2">Role</label>
              <select name="role_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-amber-200">
                <option value="1">Admin</option>
                <option value="2">Coach</option>
                <option value="3">Team Captain</option>
                <option value="4">Player</option>
              </select>
            </div>

            <!-- Profile -->
            <div class="mb-6">
              <label class="block text-gray-700 font-medium mb-2">Profile</label>
              <input type="file" name="profile" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-amber-200" />
            </div>

            <!-- Submit -->
            <div class="flex justify-center">
              <button type="submit" class="bg-amber-900 text-white px-6 py-2 rounded-lg hover:bg-amber-800 transition-colors">
                Save User
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Coach Section -->
      <section class="mb-12">
        <h2 class="text-2xl font-bold text-black mb-6">Coach</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Schedule Events Card -->
          <article 
            class="bg-gray-50 rounded-lg border border-black p-6 hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:-translate-y-1"
            role="button"
            tabindex="0"
            aria-label="Schedule Events - Plan practices, games and other team events"
          >
            <div class="flex flex-col items-center text-center">
              <div class="mb-4">
                <img
                  src="https://c.animaapp.com/meod3nrskPlg16/img/vector-1.svg"
                  alt="Calendar icon"
                  class="w-12 h-12"
                />
              </div>
              <h3 class="text-xl font-bold text-black mb-2">
                Schedule Events
              </h3>
              <p class="text-gray-500 text-sm">
                Plan practices, games and other team events.
              </p>
            </div>
          </article>

          <!-- Post Announcements Card -->
          <article 
            class="bg-gray-50 rounded-lg border border-black p-6 hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:-translate-y-1"
            onclick="window.location.href='announcements.html'"
            role="button"
            tabindex="0"
            aria-label="Post Announcements - Create and manage announcements"
          >
            <div class="flex flex-col items-center text-center">
              <div class="mb-4">
                <img
                  src="https://c.animaapp.com/meod3nrskPlg16/img/vector-7.svg"
                  alt="Announcement icon"
                  class="w-12 h-12"
                />
              </div>
              <h3 class="text-xl font-bold text-black mb-2">
                Post Announcements
              </h3>
              <p class="text-gray-500 text-sm">
                Create and manage event announcements.
              </p>
            </div>
          </article>

          <!-- Analyze Performance Card -->
          <article 
            class="bg-gray-50 rounded-lg border border-black p-6 hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:-translate-y-1"
            role="button"
            tabindex="0"
            aria-label="Analyze Performance - Review statistics and substitute roles"
          >
            <div class="flex flex-col items-center text-center">
              <div class="mb-4">
                <img
                  src="https://c.animaapp.com/meod3nrskPlg16/img/vector.svg"
                  alt="Performance analysis icon"
                  class="w-12 h-12"
                />
              </div>
              <h3 class="text-xl font-bold text-black mb-2">
                Analyze Performance
              </h3>
              <p class="text-gray-500 text-sm">
                Review statistics and substitute roles.
              </p>
            </div>
          </article>
        </div>
      </section>

      <!-- Team Captain Section -->
      <section>
        <h2 class="text-2xl font-bold text-black mb-6">Team Captain</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Submit Attendance Card -->
          <article 
            class="bg-gray-50 rounded-lg border border-black p-6 hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:-translate-y-1"
            role="button"
            tabindex="0"
            aria-label="Submit Attendance - Mark who attended practices and games"
          >
            <div class="flex flex-col items-center text-center">
              <div class="mb-4">
                <img
                  src="https://c.animaapp.com/meod3nrskPlg16/img/vector-4.svg"
                  alt="Attendance tracking icon"
                  class="w-12 h-12"
                />
              </div>
              <h3 class="text-xl font-bold text-black mb-2">
                Submit Attendance
              </h3>
              <p class="text-gray-500 text-sm">
                Mark who attended practices and games.
              </p>
            </div>
          </article>

          <!-- View Schedule Card -->
          <article 
            class="bg-gray-50 rounded-lg border border-black p-6 hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:-translate-y-1"
            role="button"
            tabindex="0"
            aria-label="View Weekly Game Schedule - Check upcoming matches or practice sessions"
          >
            <div class="flex flex-col items-center text-center">
              <div class="mb-4">
                <img
                  src="https://c.animaapp.com/meod3nrskPlg16/img/vector-1.svg"
                  alt="Schedule viewing icon"
                  class="w-12 h-12"
                />
              </div>
              <h3 class="text-xl font-bold text-black mb-2">
                View Weekly Game Schedule
              </h3>
              <p class="text-gray-500 text-sm">
                Check upcoming matches or practice sessions.
              </p>
            </div>
          </article>

          <!-- Send Messages Card -->
          <article 
            class="bg-gray-50 rounded-lg border border-black p-6 hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:-translate-y-1"
            role="button"
            tabindex="0"
            aria-label="Send Messages to Coach or Team - Use chat or bulletin board features"
          >
            <div class="flex flex-col items-center text-center">
              <div class="mb-4">
                <img
                  src="https://c.animaapp.com/meod3nrskPlg16/img/vector-6.svg"
                  alt="Messaging icon"
                  class="w-12 h-12"
                />
              </div>
              <h3 class="text-xl font-bold text-black mb-2">
                Send Messages to Coach or Team
              </h3>
              <p class="text-gray-500 text-sm">
                Use chat or bulletin board features.
              </p>
            </div>
          </article>
        </div>
      </section>


<!-- User Modal -->
<script>
  function openUserModal() {
    document.getElementById('userModal').classList.remove('hidden');
  }
  function closeUserModal() {
    document.getElementById('userModal').classList.add('hidden');
  }
</script>
@endsection
