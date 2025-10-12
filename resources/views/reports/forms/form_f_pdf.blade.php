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
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
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
        
        <div class="form-title">FORM F: NON-VARSITY SCHOOL-BASED SPORTS ORGANIZATIONS</div>
        <div class="report-info">
            Generated on: {{ date('F j, Y') }} | HEI: {{ $institutionalData['hei_name'] ?? 'Cebu Technological University' }} | Total Clubs: {{ count($nonVarsityClubs) }}
        </div>
    </div>

    <!-- Form F Content -->
    <div class="content">
        <div class="summary">Total Non-Varsity Clubs: {{ count($nonVarsityClubs) }}</div>
        
        <table>
            <thead>
                <tr>
                    <th>Sports</th>
                    <th>Sports (Sex)</th>
                    <th>Sports Club Name</th>
                    <th>Club Moderator</th>
                    <th>Main Program/Activity</th>
                    <th>Secondary Program/Activity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nonVarsityClubs as $club)
                <tr>
                    <td>{{ $club->sport_name }}</td>
                    <td>{{ $club->sports_sex }}</td>
                    <td>{{ $club->sports_club_name }}</td>
                    <td>{{ $club->club_moderator }}</td>
                    <td>{{ $club->main_program_activity }}</td>
                    <td>{{ $club->secondary_program_activity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>