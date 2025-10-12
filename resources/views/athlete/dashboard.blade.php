@extends('layouts.app')
@section('title', 'Athlete Dashboard')

@section('content')
<div class="flex h-screen">

    <!-- Main Dashboard -->
    <main class="flex-1 p-8 bg-gray-100 ml-28"> <!-- added ml-28 to offset sidebar width -->
        <!-- Quick Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-xl font-semibold mb-2">📋 Registration Status</h3>
                <p class="text-gray-700">
                    {{ $registrationStatus->status ?? 'Not Registered' }}
                </p>
            </div>
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-xl font-semibold mb-2">📅 Upcoming Events</h3>
                <p class="text-gray-700">{{ $upcomingEvents->count() }} Scheduled</p>
            </div>
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-xl font-semibold mb-2">📢 Announcements</h3>
                <p class="text-gray-700">{{ $announcements->count() }} New</p>
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="bg-white shadow-md rounded-xl p-6 mb-6">
            <h2 class="text-2xl font-bold mb-4">Upcoming Events</h2>
            @if($upcomingEvents->isEmpty())
                <p class="text-gray-500">No upcoming events.</p>
            @else
                <ul class="space-y-2">
                    @foreach($upcomingEvents as $event)
                        <li class="p-4 border-b cursor-pointer hover:bg-gray-100"
                            data-modal-target="eventModal{{ $event->event_id }}"
                            data-modal-toggle="eventModal{{ $event->event_id }}">
                            <strong>{{ $event->event_name }}</strong> <br>
                            <span class="text-gray-600">
                                📍 {{ $event->location }} | 📅 {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}
                            </span>
                        </li>

                        <!-- Event Modal -->
                        <div id="eventModal{{ $event->event_id }}" tabindex="-1" aria-hidden="true"
                            class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
                                <button type="button" 
                                        class="absolute top-3 right-3 text-gray-400 hover:text-gray-600"
                                        data-modal-hide="eventModal{{ $event->event_id }}">
                                    ✖
                                </button>
                                <h3 class="text-2xl font-bold mb-4">{{ $event->event_name }}</h3>
                                <p><strong>📍 Location:</strong> {{ $event->location }}</p>
                                <p><strong>📅 Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}</p>
                                <p><strong>🏅 Type:</strong> {{ ucfirst($event->event_type) }}</p>
                            </div>
                        </div>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Announcements -->
        <div class="bg-white shadow-md rounded-xl p-6">
            <h2 class="text-2xl font-bold mb-4">Latest Announcements</h2>
            @if($announcements->isEmpty())
                <p class="text-gray-500">No announcements at the moment.</p>
            @else
                <ul class="space-y-2">
                    @foreach($announcements as $announcement)
                        <li class="p-4 border-b cursor-pointer hover:bg-gray-100"
                            data-modal-target="announcementModal{{ $announcement->announcement_id }}"
                            data-modal-toggle="announcementModal{{ $announcement->announcement_id }}">
                            <strong>{{ $announcement->title }}</strong><br>
                            <span class="text-gray-600">{{ Str::limit($announcement->message, 60) }}</span>
                        </li>

                        <!-- Announcement Modal -->
                        <div id="announcementModal{{ $announcement->announcement_id }}" tabindex="-1" aria-hidden="true"
                            class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
                                <button type="button" 
                                        class="absolute top-3 right-3 text-gray-400 hover:text-gray-600"
                                        data-modal-hide="announcementModal{{ $announcement->announcement_id }}">
                                    ✖
                                </button>

                                <!-- Title -->
                                <h3 class="text-2xl font-bold mb-4">{{ $announcement->title }}</h3>

                                <!-- Message (Full Text) -->
                                <p class="text-gray-700 whitespace-pre-line">{{ $announcement->message }}</p>

                                <!-- Meta Info -->
                                <div class="mt-4 text-sm text-gray-500 space-y-1">
                                    <p><strong>📅 Posted on:</strong> {{ $announcement->created_at->format('F d, Y h:i A') }}</p>
                                    <p><strong>👤 Posted by:</strong> {{ $announcement->poster->name ?? 'Unknown' }}</p>
                                    <p><strong>🎯 Target:</strong> {{ ucfirst($announcement->target) }}</p>

                                    @if($announcement->sport)
                                        <p><strong>🏅 Sport:</strong> {{ $announcement->sport->sport_name }}</p>
                                    @endif

                                    @if($announcement->section)
                                        <p><strong>📚 Section:</strong> {{ $announcement->section->section_name }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>
            @endif
        </div>
    </main>
</div>

<!-- ✅ Flowbite/Alpine modal toggle script (if not already included) -->
<script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>

@endsection
