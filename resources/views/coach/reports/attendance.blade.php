@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6">
    <h2 class="text-2xl font-bold mb-4">Attendance Reports</h2>

    <!-- Filter Form -->
    <form id="attendance-filter" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <select name="athlete_id" class="border rounded p-2">
            <option value="">All Athletes</option>
            @foreach($athletes as $athlete)
                <option value="{{ $athlete->id }}">{{ $athlete->full_name }}</option>
            @endforeach
        </select>

        <select name="event_id" class="border rounded p-2">
            <option value="">All Events</option>
            @foreach($events as $event)
                <option value="{{ $event->id }}">{{ $event->event_name }}</option>
            @endforeach
        </select>

        <input type="date" name="date_from" class="border rounded p-2">
        <input type="date" name="date_to" class="border rounded p-2">

        <input type="hidden" name="report_type" value="attendance">

        <button type="submit" class="bg-[#3E1F0A] text-white px-4 py-2 rounded col-span-1 md:col-span-4">
            Filter
        </button>
    </form>

    <!-- Export Button -->
    <button id="export-attendance" 
        class="mt-4 bg-green-600 text-white px-4 py-2 rounded">
        Export CSV
    </button>

    <!-- Results Table -->
    <div class="mt-6 overflow-x-auto">
        <table class="w-full border text-sm" id="attendance-table">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">Athlete</th>
                    <th class="p-2 border">Event</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Date</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<script>
document.getElementById('attendance-filter').addEventListener('submit', function(e){
    e.preventDefault();

    let formData = new FormData(this);

    fetch("{{ route('coach.reports.filter') }}", {
        method: "POST",
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        let tbody = document.querySelector('#attendance-table tbody');
        tbody.innerHTML = "";
        data.forEach(row => {
            tbody.innerHTML += `
                <tr>
                    <td class="border p-2">${row.athlete.full_name}</td>
                    <td class="border p-2">${row.event.event_name}</td>
                    <td class="border p-2">${row.status}</td>
                    <td class="border p-2">${new Date(row.created_at).toLocaleDateString()}</td>
                </tr>
            `;
        });
    });
});
</script>

<script>
// Export Attendance CSV
document.getElementById('export-attendance').addEventListener('click', function () {
    let table = document.getElementById('attendance-table');
    let rows = table.querySelectorAll('tr');
    let csv = [];

    rows.forEach(row => {
        let cols = row.querySelectorAll('th, td');
        let rowData = [];
        cols.forEach(col => rowData.push(`"${col.innerText}"`));
        csv.push(rowData.join(","));
    });

    let blob = new Blob([csv.join("\n")], { type: "text/csv" });
    let link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = "attendance_report.csv";
    link.click();
});
</script>
@endsection
