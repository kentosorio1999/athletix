<!DOCTYPE html>
<html>
<head>
    <title>CHED Athlete Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 6px; text-align: left; }
        h2 { text-align: center; margin-bottom: 0; }
        p { text-align: center; margin-top: 0; }
        .summary { margin-top: 20px; }
        .summary table { width: 50%; margin: auto; }
    </style>
</head>
<body>
    <h2>Cebu Technological University</h2>
    <p>CHED Athlete Report - {{ now()->format('F Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Birthdate</th>
                <th>Gender</th>
                <th>Course/Year</th>
                <th>Sport</th>
                <th>Status</th>
                <th>Awards</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($athletes as $athlete)
                <tr>
                    <td>{{ $athlete->school_id }}</td>
                    <td>{{ $athlete->full_name }}</td>
                    <td>{{ $athlete->birthdate }}</td>
                    <td>{{ $athlete->gender }}</td>
                    <td>
                        {{ $athlete->section && $athlete->section->course ? $athlete->section->course->course_name : '-' }}
                        / {{ $athlete->year_level }}
                    </td>
                    <td>{{ $athlete->sport->sport_name ?? '-' }}</td>
                    <td>{{ ucfirst($athlete->conditions) }}</td>
                    <td>{{ $athlete->awards->pluck('title')->join(', ') }}</td>
                    <td>{{ $athlete->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <h3 style="text-align: center;">Consolidated Summary</h3>
        <table>
            <tr>
                <th>Total Athletes</th>
                <td>{{ $athletes->count() }}</td>
            </tr>
            <tr>
                <th>Male Athletes</th>
                <td>{{ $athletes->where('gender', 'Male')->count() }}</td>
            </tr>
            <tr>
                <th>Female Athletes</th>
                <td>{{ $athletes->where('gender', 'Female')->count() }}</td>
            </tr>
            <tr>
                <th>By Sport</th>
                <td>
                    @foreach($athletes->groupBy(fn($a) => $a->sport->sport_name ?? 'N/A') as $sport => $group)
                        {{ $sport }}: {{ $group->count() }}<br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>By Status</th>
                <td>
                    Active: {{ $athletes->where('conditions', 'active')->count() }}<br>
                    Injured: {{ $athletes->where('conditions', 'injured')->count() }}<br>
                    Graduate: {{ $athletes->where('conditions', 'graduate')->count() }}
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
