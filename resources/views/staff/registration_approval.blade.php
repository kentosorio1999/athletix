@extends('layouts.app')

@section('title', 'Registration Approval')

@section('content')
<div class="space-y-6">

    <h2 class="text-2xl font-bold text-gray-800 mb-4">Pending Athlete Registrations</h2>

    <!-- Search & Filters -->
    <form method="GET" action="{{ route('staff.approval.index') }}" class="mb-4 flex flex-wrap gap-3 items-center">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Search by name or school ID"
               class="border rounded px-3 py-2">

        <select name="year_level" class="border rounded px-3 py-2">
            <option value="">All Year Levels</option>
            @foreach(['1st Year','2nd Year','3rd Year','4th Year','Alumni'] as $level)
                <option value="{{ $level }}" {{ request('year_level')==$level ? 'selected' : '' }}>{{ $level }}</option>
            @endforeach
        </select>

        <select name="gender" class="border rounded px-3 py-2">
            <option value="">All Genders</option>
            @foreach(['Male','Female','Other'] as $gender)
                <option value="{{ $gender }}" {{ request('gender')==$gender ? 'selected' : '' }}>{{ $gender }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
        <a href="{{ route('staff.approval.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">Reset</a>
    </form>
    

    <div class="bg-white rounded-lg shadow-lg p-6">
        @if($pendingAthletes->isEmpty())
            <p class="text-gray-500">No pending registrations at the moment.</p>
        @else
            <div class="overflow-x-auto max-h-[70vh]">
                <table class="w-full text-left border">
                    <thead class="sticky top-0 bg-gray-100 z-10">
                        <tr>
                            <th class="p-3 border">Full Name</th>
                            <th class="p-3 border">School ID</th>
                            <th class="p-3 border">Year Level</th>
                            <th class="p-3 border">Gender</th>
                            <th class="p-3 border">Sport</th>
                            <th class="p-3 border">Submitted At</th>
                            <th class="p-3 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingAthletes as $athlete)
                        <tr>
                            <td class="p-3 border">{{ $athlete->full_name }}</td>
                            <td class="p-3 border">{{ $athlete->school_id }}</td>
                            <td class="p-3 border">{{ $athlete->year_level }}</td>
                            <td class="p-3 border">{{ $athlete->gender }}</td>
                            <td class="p-3 border">{{ $athlete->sport->sport_name ?? 'N/A' }}</td>
                            <td class="p-3 border">{{ $athlete->created_at->format('M d, Y') }}</td>
                            <td class="p-3 border space-x-2">
                                <form action="{{ route('staff.approval.approve', $athlete->athlete_id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded">Approve</button>
                                </form>

                                <form action="{{ route('staff.approval.reject', $athlete->athlete_id) }}" method="POST" class="inline" onsubmit="return confirm('Reject this registration?');">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded">Reject</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
