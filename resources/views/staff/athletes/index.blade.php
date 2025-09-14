@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-semibold mb-4">Athletes</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Search Bar --}}
    <div class="mb-4">
        <input 
            type="text" 
            id="searchInput" 
            placeholder="Search athletes..." 
            class="w-full md:w-1/3 border px-3 py-2 rounded focus:ring focus:ring-blue-300"
            onkeyup="filterAthletes()"
        >
    </div>

    {{-- Scrollable Table --}}
    <div class="overflow-y-auto max-h-[500px] border rounded">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-3 py-2">Name</th>
                    <th class="px-3 py-2">Year Level</th>
                    <th class="px-3 py-2">Status</th>
                    <th class="px-3 py-2">Action</th>
                </tr>
            </thead>
            <tbody id="athleteTable">
                @foreach($athletes as $athlete)
                <tr class="border-t">
                    <td class="px-3 py-2">{{ $athlete->full_name }}</td>
                    <td class="px-3 py-2">{{ $athlete->year_level }}</td>
                    <td class="px-3 py-2">{{ $athlete->status }}</td>
                    <td class="px-3 py-2">
                        <!-- Button triggers modal -->
                        <button onclick="openModal({{ $athlete->athlete_id }})" 
                                class="bg-blue-600 text-white px-3 py-1 rounded">
                            Edit
                        </button>
                    </td>
                </tr>

                <!-- Modal -->
                <div id="modal-{{ $athlete->athlete_id }}" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg w-96 p-6">
                        <h3 class="text-lg font-semibold mb-4">Edit Athlete</h3>
                        <form method="POST" action="{{ route('staff.athletes.update', $athlete->athlete_id) }}">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label class="block text-sm">Full Name</label>
                                <input type="text" name="full_name" value="{{ $athlete->full_name }}" class="w-full border px-3 py-2 rounded">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm">Birthdate</label>
                                <input type="date" name="birthdate" value="{{ $athlete->birthdate }}" class="w-full border px-3 py-2 rounded">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm">Gender</label>
                                <select name="gender" class="w-full border px-3 py-2 rounded">
                                    <option value="Male" {{ $athlete->gender=='Male'?'selected':'' }}>Male</option>
                                    <option value="Female" {{ $athlete->gender=='Female'?'selected':'' }}>Female</option>
                                    <option value="Other" {{ $athlete->gender=='Other'?'selected':'' }}>Other</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm">Year Level</label>
                                <select name="year_level" class="w-full border px-3 py-2 rounded">
                                    <option {{ $athlete->year_level=='1st Year'?'selected':'' }}>1st Year</option>
                                    <option {{ $athlete->year_level=='2nd Year'?'selected':'' }}>2nd Year</option>
                                    <option {{ $athlete->year_level=='3rd Year'?'selected':'' }}>3rd Year</option>
                                    <option {{ $athlete->year_level=='4th Year'?'selected':'' }}>4th Year</option>
                                    <option {{ $athlete->year_level=='Alumni'?'selected':'' }}>Alumni</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm">Password</label>
                                <input type="password" name="password" class="w-full border px-3 py-2 rounded">
                                <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded mt-2" placeholder="Confirm Password">
                            </div>

                            <div class="flex justify-end space-x-2">
                                <button type="button" onclick="closeModal({{ $athlete->athlete_id }})" class="bg-gray-500 text-white px-3 py-1 rounded">Cancel</button>
                                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById('modal-' + id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById('modal-' + id).classList.add('hidden');
    }

    // Simple search filter
    function filterAthletes() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let rows = document.querySelectorAll("#athleteTable tr");

        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(input) ? "" : "none";
        });
    }
</script>
@endsection
