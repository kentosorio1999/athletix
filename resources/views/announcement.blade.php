@extends('layouts.app')

@section('title', 'Announcement')

@section('content')
  <!-- Announcements List -->
  <div class="space-y-6">
    <!-- World Cup Event -->
    <article class="bg-white rounded-lg border-2 border-gray-300 p-6 shadow-sm hover:shadow-md transition-shadow">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-start">
        <div class="md:col-span-1">
          <h3 class="font-semibold text-lg mb-2">Date</h3>
          <p class="text-gray-600">May 03, 2025</p>
        </div>
        
        <div class="md:col-span-2">
          <h3 class="font-semibold text-lg mb-2">Events and Announcements</h3>
          <h4 class="font-bold text-xl mb-3">World Cup</h4>
          <p class="text-gray-700 leading-relaxed">
            The wait is over! The World Cup is back, bringing together the best teams from around the 
            globe for an electrifying tournament filled with passion, skill, and unforgettable moments. 
            Join us as we witness history in the making! Whether you're cheering from the stands or 
            watching from home, this is your chance to be part of the excitement.
          </p>
          <p class="text-gray-700 leading-relaxed mt-2">
            Stay tuned for match schedules, exclusive updates, and behind-the-scenes action. Let's 
            celebrate the beautiful game together!
          </p>
        </div>
        
        <div class="md:col-span-1">
          <h3 class="font-semibold text-lg mb-2">Venue</h3>
          <p class="text-gray-600">School Gymnasium</p>
        </div>
      </div>
    </article>

    <!-- Annual School Sports Day -->
    <article class="bg-white rounded-lg border-2 border-gray-300 p-6 shadow-sm hover:shadow-md transition-shadow">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-start">
        <div class="md:col-span-1">
          <h3 class="font-semibold text-lg mb-2">Date</h3>
          <p class="text-gray-600">May 08, 2025</p>
        </div>
        
        <div class="md:col-span-2">
          <h3 class="font-semibold text-lg mb-2">Events and Announcements</h3>
          <h4 class="font-bold text-xl mb-3">Annual School Sports Day</h4>
          <p class="text-gray-700 leading-relaxed">
            A day filled with track and field events, team sports, and fun activities like sack races and tug-of-war. 
            Encourages teamwork, sportsmanship, and school spirit.
          </p>
        </div>
        
        <div class="md:col-span-1">
          <h3 class="font-semibold text-lg mb-2">Venue</h3>
          <p class="text-gray-600">School Gymnasium</p>
        </div>
      </div>
    </article>

    <!-- Fitness & Wellness Week -->
    <article class="bg-white rounded-lg border-2 border-gray-300 p-6 shadow-sm hover:shadow-md transition-shadow">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-start">
        <div class="md:col-span-1">
          <h3 class="font-semibold text-lg mb-2">Date</h3>
          <p class="text-gray-600">May 25, 2025</p>
        </div>
        
        <div class="md:col-span-2">
          <h3 class="font-semibold text-lg mb-2">Events and Announcements</h3>
          <h4 class="font-bold text-xl mb-3">Fitness & Wellness Week</h4>
          <p class="text-gray-700 leading-relaxed">
            A week-long event promoting physical health through activities like yoga sessions, obstacle 
            courses, and fitness challenges. Includes workshops on nutrition and mental well-being.
          </p>
        </div>
        
        <div class="md:col-span-1">
          <h3 class="font-semibold text-lg mb-2">Venue</h3>
          <p class="text-gray-600">Community Sports Complex</p>
        </div>
      </div>
    </article>
  </div>

  <!-- Add New Announcement Button -->
  <div class="mt-8 flex justify-center">
    <button 
      onclick="openAnnouncementModal()"
      class="bg-amber-900 text-white px-8 py-3 rounded-lg hover:bg-amber-800 transition-colors font-semibold shadow-md hover:shadow-lg"
    >
      + Add New Announcement
    </button>
  </div>
@endsection
