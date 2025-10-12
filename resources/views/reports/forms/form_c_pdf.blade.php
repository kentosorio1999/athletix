<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        /* Same header styles */
        .header { width: 100%; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .logo-container { display: flex; justify-content: space-between; align-items: center; }
        .logo { height: 80px; }
        .institution-info { text-align: center; flex-grow: 1; }
        .institution-name { font-size: 16px; font-weight: bold; margin: 0; }
        .institution-address { font-size: 12px; margin: 2px 0; color: #666; }
        .form-title { text-align: center; font-size: 18px; font-weight: bold; margin: 15px 0; text-decoration: underline; }
        .report-info { text-align: center; font-size: 12px; color: #666; margin-bottom: 20px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 10px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; }
        .summary { margin-bottom: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="logo-container">
            <div>CTU LOGO</div>
            <div class="institution-info">
                <p class="institution-name">Cebu Technological University</p>
                <p class="institution-address">M.J. Cuenco Ave, Cor R. Palma Street, Cebu City, 6000 Cebu</p>
                <p class="institution-address">Main Campus</p>
            </div>
            <div>CHED LOGO</div>
        </div>
        
        <div class="form-title">FORM C: STUDENT-ATHLETES INFORMATION</div>
        <div class="report-info">
            Generated on: {{ date('F j, Y') }} | HEI: {{ $institutionalData['hei_name'] ?? 'Cebu Technological University' }} | Total Records: {{ $athletes->count() }}
        </div>
    </div>

    <!-- Form C Content -->
    <div class="content">
        <div class="summary">Total Athletes: {{ $athletes->count() }}</div>
        
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Sports Program</th>
                    <th>Gender</th>
                    <th>Academic Course</th>
                    <th>Year Level</th>
                    <th>Competition Level</th>
                    <th>Scholarship Status</th>
                    <th>Monthly Allowance</th>
                </tr>
            </thead>
            <tbody>
                @foreach($athletes as $athlete)
                <tr>
                    <td>{{ $athlete->full_name }}</td>
                    <td>{{ $athlete->age ?? '-' }}</td>
                    <td>{{ $athlete->sport->sport_name ?? '-' }}</td>
                    <td>{{ $athlete->gender ?? '-' }}</td>
                    <td>{{ $athlete->academic_course ?? '-' }}</td>
                    <td>{{ $athlete->year_level }}</td>
                    <td>{{ $athlete->highest_competition_level ?? '-' }}</td>
                    <td>{{ $athlete->scholarship_status ?? 'None' }}</td>
                    <td>
                        @if($athlete->monthly_living_allowance)
                            ₱{{ number_format($athlete->monthly_living_allowance, 2) }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>