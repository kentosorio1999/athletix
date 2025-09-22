@extends('layouts.app')

@section('title', 'Awards')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Awards</h1>

    <a href="{{ route('coach.awards.create') }}" 
       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">
        + Add Award
    </a>

    <div class="mt-6 bg-white p-4 rounded-lg shadow">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2 border">Athlete</th>
                    <th class="p-2 border">Event</th>
                    <th class="p-2 border">Title</th>
                    <th class="p-2 border">Description</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($awards as $award)
                <tr>
                    <td class="p-2 border">{{ $award->athlete->full_name }}</td>
                    <td class="p-2 border">{{ $award->event->event_name }}</td>
                    <td class="p-2 border">{{ $award->title }}</td>
                    <td class="p-2 border">{{ $award->description }}</td>
                    <td class="p-2 border">
                        <a href="{{ route('coach.awards.edit', $award->id) }}" 
                           class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('coach.awards.destroy', $award->id) }}" 
                              method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:underline ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">No awards yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
