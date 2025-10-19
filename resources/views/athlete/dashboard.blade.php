@extends('layouts.app')
@section('title', 'Athlete Dashboard')

@section('content')
<div class="flex h-screen">

    <!-- Main Dashboard -->
    <main class="flex-1 p-8 bg-gray-100 ml-28"> <!-- added ml-28 to offset sidebar width -->
        
        <!-- Application Status Alert -->
        @if(auth()->user()->athlete && auth()->user()->athlete->status === 'pending')
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded-lg shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        <strong>Application Status: Pending</strong> - Kindly update your details in the 
                        <a href="{{ route('athlete.profile.edit') }}" class="font-medium underline text-yellow-700 hover:text-yellow-600">
                            Settings
                        </a> 
                        to complete your registration and improve approval chances.
                    </p>
                </div>
            </div>
        </div>
        @endif

        <!-- Welcome and Status Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Welcome Card -->
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-xl font-semibold mb-2">👋 Welcome, {{ auth()->user()->username }}!</h3>
                <p class="text-gray-700 mb-4">Welcome to your athlete dashboard. Manage your profile, events, and registrations here.</p>
                
                <!-- Quick Action Button -->
                <a href="{{ route('athlete.profile.edit') }}" 
                   class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Update Profile
                </a>
            </div>

            <!-- Status Card -->
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-xl font-semibold mb-4">📋 Application Status</h3>
                @if(auth()->user()->athlete)
                    @php
                        $status = auth()->user()->athlete->status;
                        $statusConfig = [
                            'pending' => ['color' => 'bg-yellow-100 text-yellow-800', 'icon' => '⏳'],
                            'approved' => ['color' => 'bg-green-100 text-green-800', 'icon' => '✅'],
                            'rejected' => ['color' => 'bg-red-100 text-red-800', 'icon' => '❌'],
                            'in review' => ['color' => 'bg-blue-100 text-blue-800', 'icon' => '🔍']
                        ];
                        $config = $statusConfig[$status] ?? ['color' => 'bg-gray-100 text-gray-800', 'icon' => '❓'];
                    @endphp
                    
                    <div class="flex items-center mb-3">
                        <span class="text-2xl mr-3">{{ $config['icon'] }}</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $config['color'] }}">
                            {{ ucfirst($status) }}
                        </span>
                    </div>
                    
                    @if($status === 'pending')
                    <p class="text-sm text-gray-600">
                        Your application is under review. Please ensure your profile information is complete and up-to-date.
                    </p>
                    @elseif($status === 'approved')
                    <p class="text-sm text-gray-600">
                        Your application has been approved! You can now register for events.
                    </p>
                    @elseif($status === 'rejected')
                    <p class="text-sm text-gray-600">
                        Your application was not approved. Please contact administration for more information.
                    </p>
                    @elseif($status === 'in review')
                    <p class="text-sm text-gray-600">
                        Your application is currently being reviewed by our team.
                    </p>
                    @endif
                @else
                    <div class="flex items-center mb-3">
                        <span class="text-2xl mr-3">❓</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            Not Registered
                        </span>
                    </div>
                    <p class="text-sm text-gray-600">
                        Please complete your athlete registration to get started.
                    </p>
                @endif
            </div>
        </div>

        <!-- Quick Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-xl font-semibold mb-2">📅 Upcoming Events</h3>
                <p class="text-2xl font-bold text-gray-800">{{ $upcomingEvents->count() }}</p>
                <p class="text-gray-600 text-sm">Scheduled Events</p>
            </div>
            
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-xl font-semibold mb-2">📢 Announcements</h3>
                <p class="text-2xl font-bold text-gray-800">{{ $announcements->count() }}</p>
                <p class="text-gray-600 text-sm">New Updates</p>
            </div>
            
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-xl font-semibold mb-2">🏆 Registrations</h3>
                <p class="text-2xl font-bold text-gray-800">
                    {{ auth()->user()->athlete && auth()->user()->athlete->status === 'approved' ? 'Available' : 'Pending' }}
                </p>
                <p class="text-gray-600 text-sm">
                    @if(auth()->user()->athlete && auth()->user()->athlete->status === 'approved')
                        Ready to Register
                    @else
                        Complete Approval First
                    @endif
                </p>
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="bg-white shadow-md rounded-xl p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Upcoming Events</h2>
                @if(auth()->user()->athlete && auth()->user()->athlete->status === 'approved')
                <a href="{{ route('athlete.events.index') }}" 
                   class="text-yellow-600 hover:text-yellow-700 font-medium text-sm">
                    View All Events →
                </a>
                @endif
            </div>
            
            @if($upcomingEvents->isEmpty())
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-gray-500">No upcoming events scheduled.</p>
                </div>
            @else
                <ul class="space-y-3">
                    @foreach($upcomingEvents as $event)
                        <li class="p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors"
                            data-modal-target="eventModal{{ $event->event_id }}"
                            data-modal-toggle="eventModal{{ $event->event_id }}">
                            <div class="flex justify-between items-start">
                                <div>
                                    <strong class="text-lg text-gray-800">{{ $event->event_name }}</strong>
                                    <div class="flex items-center mt-2 text-sm text-gray-600 space-x-4">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            </svg>
                                            {{ $event->location }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded">
                                    {{ ucfirst($event->event_type) }}
                                </span>
                            </div>
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
                                <div class="space-y-3">
                                    <p><strong>📍 Location:</strong> {{ $event->location }}</p>
                                    <p><strong>📅 Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}</p>
                                    <p><strong>🏅 Type:</strong> {{ ucfirst($event->event_type) }}</p>
                                    @if($event->description)
                                        <p><strong>📝 Description:</strong> {{ $event->description }}</p>
                                    @endif
                                </div>
                                
                                @if(auth()->user()->athlete && auth()->user()->athlete->status === 'approved')
                                <div class="mt-6 pt-4 border-t border-gray-200">
                                    <a href="{{ route('athlete.events.register', $event->event_id) }}" 
                                       class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded-lg text-center block transition-colors">
                                        Register for this Event
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Announcements -->
        <div class="bg-white shadow-md rounded-xl p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Latest Announcements</h2>
                <a href="{{ route('athlete.notifications.index') }}" 
                   class="text-yellow-600 hover:text-yellow-700 font-medium text-sm">
                    View All Notifications →
                </a>
            </div>
            
            @if($announcements->isEmpty())
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-gray-500">No announcements at the moment.</p>
                </div>
            @else
                <ul class="space-y-3">
                    @foreach($announcements as $announcement)
                        <li class="p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors"
                            data-modal-target="announcementModal{{ $announcement->announcement_id }}"
                            data-modal-toggle="announcementModal{{ $announcement->announcement_id }}">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <strong class="text-lg text-gray-800 block mb-1">{{ $announcement->title }}</strong>
                                    <p class="text-gray-600 text-sm mb-2">{{ Str::limit($announcement->message, 80) }}</p>
                                    <div class="flex items-center text-xs text-gray-500 space-x-4">
                                        <span>📅 {{ $announcement->created_at->format('M d, Y') }}</span>
                                        <span>👤 {{ $announcement->poster->name ?? 'Administrator' }}</span>
                                        @if($announcement->sport)
                                            <span>🏅 {{ $announcement->sport->sport_name }}</span>
                                        @endif
                                    </div>
                                </div>
                                <span class="ml-4 px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded">
                                    New
                                </span>
                            </div>
                        </li>

                        <!-- Announcement Modal -->
                        <div id="announcementModal{{ $announcement->announcement_id }}" tabindex="-1" aria-hidden="true"
                            class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                            <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative max-h-[90vh] overflow-y-auto">
                                <button type="button" 
                                        class="absolute top-3 right-3 text-gray-400 hover:text-gray-600"
                                        data-modal-hide="announcementModal{{ $announcement->announcement_id }}">
                                    ✖
                                </button>

                                <!-- Title -->
                                <h3 class="text-2xl font-bold mb-4 text-gray-800">{{ $announcement->title }}</h3>

                                <!-- Message (Full Text) -->
                                <div class="prose max-w-none mb-6">
                                    <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $announcement->message }}</p>
                                </div>

                                <!-- Meta Info -->
                                <div class="border-t border-gray-200 pt-4 mt-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                                        <div>
                                            <p><strong class="text-gray-700">📅 Posted on:</strong> {{ $announcement->created_at->format('F d, Y h:i A') }}</p>
                                            <p><strong class="text-gray-700">👤 Posted by:</strong> {{ $announcement->poster->name ?? 'Administrator' }}</p>
                                        </div>
                                        <div>
                                            <p><strong class="text-gray-700">🎯 Target:</strong> {{ ucfirst($announcement->target) }}</p>
                                            @if($announcement->sport)
                                                <p><strong class="text-gray-700">🏅 Sport:</strong> {{ $announcement->sport->sport_name }}</p>
                                            @endif
                                            @if($announcement->section)
                                                <p><strong class="text-gray-700">📚 Section:</strong> {{ $announcement->section->section_name }}</p>
                                            @endif
                                        </div>
                                    </div>
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
