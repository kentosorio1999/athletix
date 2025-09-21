@extends('layouts.app')
@section('title', 'Manage Athletes')

@section('content')
<div class="overflow-x-auto bg-white rounded-lg shadow-lg p-6">

    {{-- Search Form --}}
    <form method="GET" action="{{ route('coach.athletes.index') }}" class="mb-4 flex gap-2">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Search athletes..." 
            class="border rounded p-2 flex-1"
        />
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Search</button>
    </form>

    @if($athletes->isEmpty())
        <p>No athletes found.</p>
    @else
        <table class="w-full text-left border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 border">Name</th>
                    <th class="p-3 border">Sport</th>
                    <th class="p-3 border">Year Level</th>
                    <th class="p-3 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($athletes as $athlete)
                <tr>
                    <td class="p-3 border">{{ $athlete->full_name }}</td>
                    <td class="p-3 border">{{ $athlete->sport->sport_name }}</td>
                    <td class="p-3 border">{{ $athlete->year_level }}</td>
                    <td class="p-3 border">
                        <a href="{{ route('coach.athletes.show', $athlete->athlete_id) }}" class="px-3 py-1 bg-blue-600 text-white rounded">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $athletes->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection
