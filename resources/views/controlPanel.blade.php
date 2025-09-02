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
            onclick="window.location.href='dashboard.html'"
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
                Dashboard
              </h3>
              <p class="text-gray-500 text-sm">
                View analytics and performance statistics.
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
@endsection
