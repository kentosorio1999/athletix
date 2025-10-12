<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        /* Same header styles as form_a_pdf.blade.php */
        .header { width: 100%; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .logo-container { display: flex; justify-content: space-between; align-items: center; }
        .logo { height: 80px; }
        .institution-info { text-align: center; flex-grow: 1; }
        .institution-name { font-size: 16px; font-weight: bold; margin: 0; }
        .institution-address { font-size: 12px; margin: 2px 0; color: #666; }
        .form-title { text-align: center; font-size: 18px; font-weight: bold; margin: 15px 0; text-decoration: underline; }
        .report-info { text-align: center; font-size: 12px; color: #666; margin-bottom: 20px; }
        
        .sport-section { margin-bottom: 30px; border: 1px solid #ccc; padding: 15px; }
        .sport-title { font-size: 16px; font-weight: bold; margin-bottom: 15px; color: #2c5282; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; }
    </style>
</head>
<body>
    <!-- Header Section (same as form A) -->
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
        
        <div class="form-title">FORM B: SPORTS PROGRAMS</div>
        <div class="report-info">
            Generated on: {{ date('F j, Y') }} | HEI: {{ $institutionalData['hei_name'] ?? 'Cebu Technological University' }}
        </div>
    </div>

    <!-- Form B Content -->
    <div class="content">
        @foreach($sports as $sport)
        <div class="sport-section">
            <div class="sport-title">{{ $sport->sport_name }}</div>
            
            <table>
                <tr>
                    <th>Metric</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>Number of Teams</td>
                    <td>{{ $sport->teams->count() }}</td>
                </tr>
                <tr>
                    <td>Number of Coaches</td>
                    <td>{{ $sport->coaches->count() }}</td>
                </tr>
                <tr>
                    <td>Number of Athletes</td>
                    <td>{{ $sport->athletes->count() }}</td>
                </tr>
                <tr>
                    <td>Number of Events</td>
                    <td>{{ $sport->events->count() }}</td>
                </tr>
                <tr>
                    <td>Gender Distribution</td>
                    <td>
                        Male: {{ $sport->athletes->where('gender', 'Male')->count() }},
                        Female: {{ $sport->athletes->where('gender', 'Female')->count() }}
                    </td>
                </tr>
            </table>
        </div>
        @endforeach
    </div>
</body>
</html>