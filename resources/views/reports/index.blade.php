@extends('layouts.app')

@section('title', 'CHED Reports')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Generate Reports</h2>

    <!-- Filters -->
    <form method="GET" action="{{ route('reports') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <input type="number" name="year" value="{{ request('year') }}" placeholder="Year" class="border p-2 rounded">
        <select name="sport" class="border p-2 rounded">
            <option value="">All Sports</option>
            @foreach($sports as $sport)
                <option value="{{ $sport->sport_id }}" {{ request('sport') == $sport->sport_id ? 'selected' : '' }}>{{ $sport->sport_name }}</option>
            @endforeach
        </select>
        <select name="status" class="border p-2 rounded">
            <option value="">All Status</option>
            <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
            <option value="Injured" {{ request('status') == 'Injured' ? 'selected' : '' }}>Injured</option>
            <option value="Graduated" {{ request('status') == 'Graduated' ? 'selected' : '' }}>Graduated</option>
        </select>
        <button type="submit" class="bg-amber-900 hover:bg-amber-800 text-white px-4 py-2 rounded">Filter</button>
    </form>

    <!-- Export Buttons -->
    <!-- <div class="mb-4 flex gap-2">
        <a href="{{ route('reports.export', 'csv') }}?{{ http_build_query(request()->all()) }}" class="bg-yellow-600 text-white px-3 py-2 rounded">Export CSV</a>
    </div> -->

    <div class="mb-4 flex gap-2">
        <a href="{{ route('reports.export', 'csv') }}?{{ http_build_query(request()->all()) }}" class="bg-yellow-600 text-white px-3 py-2 rounded">Export CSV</a>
        <a href="{{ route('reports.export', 'pdf') }}?{{ http_build_query(request()->all()) }}" class="bg-red-600 text-white px-3 py-2 rounded">Export PDF</a>
    </div>

    <!-- Table -->
    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-3 py-2">ID</th>
                <th class="border px-3 py-2">Name</th>
                <th class="border px-3 py-2">Course/Year</th>
                <th class="border px-3 py-2">Sport</th>
                <th class="border px-3 py-2">Status</th>
                <th class="border px-3 py-2">Awards</th>
                <th class="border px-3 py-2">Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($athletes as $athlete)
            <tr>
                <td class="border px-3 py-2">{{ $athlete->school_id }}</td>
                <td class="border px-3 py-2">{{ $athlete->full_name }}</td>
                <td class="border px-3 py-2">{{ $athlete->year_level }}</td>
                <td class="border px-3 py-2">{{ $athlete->sport->sport_name ?? '-' }}</td>
                <td class="border px-3 py-2">{{ $athlete->conditions }}</td>
                <td class="border px-3 py-2">{{ $athlete->awards->pluck('title')->join(', ') }}</td>
                <td class="border px-3 py-2">{{ $athlete->created_at->format('Y-m-d') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center p-4">No records found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
