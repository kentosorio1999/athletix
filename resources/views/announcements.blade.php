@extends('layouts.app')

@section('title', 'Announcements')
@section('header-actions')
  <button 
    onclick="openAnnouncementModal()"
    class="bg-amber-900 text-white px-6 py-2 rounded-lg hover:bg-amber-800 transition-colors font-semibold shadow-md hover:shadow-lg"
  >
    + Add New Announcement
  </button>
@endsection

@section('content')
  <!-- Announcements List -->
  <div class="space-y-6">
    <!-- World Cup Event -->
    @foreach ($announcements as $announcement)
    <article class="bg-white rounded-lg border-2 border-gray-300 p-6 shadow-sm hover:shadow-md transition-shadow">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-start">
        <div class="md:col-span-1">
          <h3 class="font-semibold text-lg mb-2">Date</h3>
          <p class="text-gray-600">{{ \Carbon\Carbon::parse($announcement->created_at)->format('M d, Y') }}</p>
        </div>
        
        <div class="md:col-span-2">
          <h3 class="font-semibold text-lg mb-2">Events and Announcements</h3>
          <h4 class="font-bold text-xl mb-3">{{ $announcement->title }}</h4>
          <p class="text-gray-700 leading-relaxed mt-2">{{ $announcement->details }}</p>
        </div>
        
        <div class="md:col-span-1">
          <h3 class="font-semibold text-lg mb-2">Venue</h3>
          <p class="text-gray-600">{{ $announcement->venue ?? 'TBA' }}</p>
        </div>
      </div>
    </article>
    @endforeach
  </div>


  <!-- Announcement Modal -->
    <div id="announcementModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">
        <h2 class="text-xl font-bold mb-4">Add New Announcement</h2>

        <!-- Close Button -->
        <button onclick="closeAnnouncementModal()" class="absolute top-3 right-3 text-gray-600 hover:text-black">
          ✖
        </button>

        <!-- Form -->
        <form action="{{ route('announcements.store') }}" method="POST" class="space-y-4">
          @csrf

          <div>
            <label class="block font-semibold mb-1">Date</label>
            <input type="date" name="date" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-amber-300" required>
          </div>

          <div>
            <label class="block font-semibold mb-1">Title</label>
            <input type="text" name="title" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-amber-300" required>
          </div>

          <div>
            <label class="block font-semibold mb-1">Description</label>
            <textarea name="details" rows="4" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-amber-300" required></textarea>
          </div>

          <div>
            <label class="block font-semibold mb-1">Venue</label>
            <input type="text" name="venue" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-amber-300" required>
          </div>

          <div class="flex justify-end">
            <button type="button" onclick="closeAnnouncementModal()" class="mr-3 px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
              Cancel
            </button>
            <button type="submit" class="px-4 py-2 bg-amber-900 text-white rounded-lg hover:bg-amber-800">
              Save
            </button>
          </div>
        </form>
      </div>
    </div>

  
    <script>
      function openAnnouncementModal() {
        document.getElementById('announcementModal').classList.remove('hidden');
      }
      function closeAnnouncementModal() {
        document.getElementById('announcementModal').classList.add('hidden');
      }
    </script>
@endsection
