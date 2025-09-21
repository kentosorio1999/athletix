@extends('layouts.app')
@section('title', $athlete->full_name)

@section('content')
<div x-data="{ open: false }" class="mb-6">
    {{-- Profile Picture --}}
    <div class="w-24 h-24 rounded-full overflow-hidden border-2 border-gray-300 cursor-pointer" @click="open = true">
        <img src="{{ $athlete->profile_url }}" alt="{{ $athlete->full_name }}" class="w-full h-full object-cover">
    </div>

    {{-- Name --}}
    <h2 class="text-2xl font-bold mt-2">{{ $athlete->full_name }}</h2>

    {{-- Modal --}}
    <div x-show="open" x-transition.opacity
         style="display: none;"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-4 max-w-lg w-full relative">
            <button @click="open = false" class="absolute top-2 right-2 text-gray-700 text-xl">&times;</button>
            <img src="{{ $athlete->profile_url }}" alt="{{ $athlete->full_name }}" class="w-full h-auto object-contain rounded">
        </div>
    </div>
</div>

{{-- Athlete Info + Teams --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h3 class="font-bold mb-2">Athlete Info</h3>
        <p><strong>Sport:</strong> {{ $athlete->sport->sport_name }}</p>
        <p><strong>Year Level:</strong> {{ $athlete->year_level }}</p>
        <p><strong>Gender:</strong> {{ $athlete->gender }}</p>
        <p><strong>Conditions:</strong> {{ $athlete->conditions }}</p>
        <p><strong>Eligibility:</strong> {{ $athlete->eligibility_status ?? 'Not Provided' }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <h3 class="font-bold mb-2">Teams</h3>
        @forelse($athlete->teams as $team)
            <p>{{ $team->team_name }}</p>
        @empty
            <p>No team assignments yet.</p>
        @endforelse
    </div>
</div>

{{-- Participation History --}}
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <h3 class="font-bold mb-4">Participation History</h3>
    @if($athlete->events->isEmpty())
        <p>No participation history yet.</p>
    @else
        <ul class="list-disc list-inside">
            @foreach($athlete->events as $event)
                <li>
                    <strong>{{ $event->event_name }}</strong> – {{ $event->event_date->format('M d, Y') }} 
                    @if($event->status) ({{ $event->status }}) @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>

{{-- Training Notes --}}
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <h3 class="font-bold mb-4">Training Notes</h3>
    @foreach($athlete->trainingNotes as $note)
        <div class="mb-2 p-3 border rounded">
            <p>{{ $note->note }}</p>
            <small class="text-gray-500">By {{ $note->coach->full_name }} on {{ $note->created_at->format('M d, Y') }}</small>
        </div>
    @endforeach

    <form action="{{ route('coach.athletes.notes.store', $athlete->athlete_id) }}" method="POST" class="mt-4">
        @csrf
        <textarea name="note" class="w-full border rounded p-2" rows="3" placeholder="Add a training note" required></textarea>
        <button type="submit" class="mt-2 px-4 py-2 bg-green-600 text-white rounded">Save Note</button>
    </form>
</div>
@endsection
