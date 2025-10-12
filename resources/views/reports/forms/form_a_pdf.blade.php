<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        /* Header styles */
        .header { width: 100%; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .logo-container { display: flex; justify-content: space-between; align-items: center; }
        .logo { height: 80px; }
        .institution-info { text-align: center; flex-grow: 1; }
        .institution-name { font-size: 16px; font-weight: bold; margin: 0; }
        .institution-address { font-size: 12px; margin: 2px 0; color: #666; }
        .form-title { text-align: center; font-size: 18px; font-weight: bold; margin: 15px 0; text-decoration: underline; }
        .report-info { text-align: center; font-size: 12px; color: #666; margin-bottom: 20px; }
        
        /* Content styles */
        .section { margin-bottom: 25px; }
        .section-title { font-size: 16px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 5px; }
        .field { margin-bottom: 8px; }
        .field-label { font-weight: bold; display: inline-block; width: 250px; }
        .field-value { display: inline-block; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; }
        .sub-section { margin-left: 20px; margin-bottom: 15px; }
        .sub-section-title { font-weight: bold; color: #555; margin-bottom: 5px; }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="logo-container">
            <!-- CTU Logo -->
            <div>
                @if(file_exists(public_path('images/ctu-logo.png')))
                    <img src="{{ public_path('images/ctu-logo.png') }}" class="logo" alt="CTU Logo">
                @else
                    <div style="width: 80px; height: 80px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center; font-size: 10px;">
                        CTU LOGO
                    </div>
                @endif
            </div>
            
            <!-- Institution Info -->
            <div class="institution-info">
                <p class="institution-name">Cebu Technological University</p>
                <p class="institution-address">M.J. Cuenco Ave, Cor R. Palma Street, Cebu City, 6000 Cebu</p>
                <p class="institution-address">Main Campus</p>
            </div>
            
            <!-- CHED Logo -->
            <div>
                @if(file_exists(public_path('images/ched-logo.png')))
                    <img src="{{ public_path('images/ched-logo.png') }}" class="logo" alt="CHED Logo">
                @else
                    <div style="width: 80px; height: 80px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center; font-size: 10px;">
                        CHED LOGO
                    </div>
                @endif
            </div>
        </div>
        
        <div class="form-title">
            FORM A: INSTITUTIONAL INFORMATION
        </div>
        
        <div class="report-info">
            Generated on: {{ date('F j, Y') }} | HEI: {{ $institutionalData['hei_name'] ?? 'Cebu Technological University' }}
        </div>
    </div>

    <!-- Form A Content -->
    <div class="content">
        <!-- HEI Information -->
        <div class="section">
            <div class="section-title">HEI Information</div>
            <div class="field">
                <span class="field-label">Name of HEI:</span>
                <span class="field-value">{{ $institutionalData['hei_name'] ?? 'Not provided' }}</span>
            </div>
            <div class="field">
                <span class="field-label">HEI Campus:</span>
                <span class="field-value">{{ $institutionalData['hei_campus'] ?? 'Not provided' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Address of HEI:</span>
                <span class="field-value">{{ $institutionalData['hei_address'] ?? 'Not provided' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Name of HEI President:</span>
                <span class="field-value">{{ $institutionalData['hei_president'] ?? 'Not provided' }}</span>
            </div>
        </div>

        <!-- Sports Director Information -->
        <div class="section">
            <div class="section-title">Sports Director Information</div>
            <div class="field">
                <span class="field-label">Name of Sports Director:</span>
                <span class="field-value">{{ $institutionalData['sports_director_name'] ?? 'Not provided' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Email:</span>
                <span class="field-value">{{ $institutionalData['sports_director_email'] ?? 'Not provided' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Mobile Number:</span>
                <span class="field-value">{{ $institutionalData['sports_director_mobile'] ?? 'Not provided' }}</span>
            </div>
        </div>

        <!-- Contact Person Information -->
        <div class="section">
            <div class="section-title">RA 11180 Contact Person</div>
            <div class="field">
                <span class="field-label">Name of Contact Person:</span>
                <span class="field-value">{{ $institutionalData['contact_person_name'] ?? 'Not provided' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Email:</span>
                <span class="field-value">{{ $institutionalData['contact_person_email'] ?? 'Not provided' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Contact Number:</span>
                <span class="field-value">{{ $institutionalData['contact_person_mobile'] ?? 'Not provided' }}</span>
            </div>
        </div>

        <!-- Athlete Demographics Summary -->
        <div class="section">
            <div class="section-title">Athlete Demographics Summary</div>
            <div class="field">
                <span class="field-label">Total Number of Athletes:</span>
                <span class="field-value">{{ $athleteData['total_athletes'] ?? '0' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Male Athletes:</span>
                <span class="field-value">{{ $athleteData['male_count'] ?? '0' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Female Athletes:</span>
                <span class="field-value">{{ $athleteData['female_count'] ?? '0' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Other Gender:</span>
                <span class="field-value">{{ $athleteData['other_gender_count'] ?? '0' }}</span>
            </div>
            
            <!-- Year Level Distribution -->
            <div class="sub-section">
                <div class="sub-section-title">Year Level Distribution:</div>
                <div class="field">
                    <span class="field-label">1st Year:</span>
                    <span class="field-value">{{ $athleteData['year_level_distribution']['1st_year'] ?? '0' }}</span>
                </div>
                <div class="field">
                    <span class="field-label">2nd Year:</span>
                    <span class="field-value">{{ $athleteData['year_level_distribution']['2nd_year'] ?? '0' }}</span>
                </div>
                <div class="field">
                    <span class="field-label">3rd Year:</span>
                    <span class="field-value">{{ $athleteData['year_level_distribution']['3rd_year'] ?? '0' }}</span>
                </div>
                <div class="field">
                    <span class="field-label">4th Year:</span>
                    <span class="field-value">{{ $athleteData['year_level_distribution']['4th_year'] ?? '0' }}</span>
                </div>
                <div class="field">
                    <span class="field-label">Alumni:</span>
                    <span class="field-value">{{ $athleteData['year_level_distribution']['alumni'] ?? '0' }}</span>
                </div>
            </div>
        </div>

        <!-- Competition Level Summary -->
        <div class="section">
            <div class="section-title">Athlete Competition Levels</div>
            <div class="field">
                <span class="field-label">International Level Competitors:</span>
                <span class="field-value">{{ $athleteData['competition_levels']['international'] ?? '0' }}</span>
            </div>
            <div class="field">
                <span class="field-label">National Level Competitors:</span>
                <span class="field-value">{{ $athleteData['competition_levels']['national'] ?? '0' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Regional Level Competitors:</span>
                <span class="field-value">{{ $athleteData['competition_levels']['regional'] ?? '0' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Local Level Competitors:</span>
                <span class="field-value">{{ $athleteData['competition_levels']['local'] ?? '0' }}</span>
            </div>
            <div class="field">
                <span class="field-label">University Level Competitors:</span>
                <span class="field-value">{{ $athleteData['competition_levels']['university'] ?? '0' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Intramurals Participants:</span>
                <span class="field-value">{{ $athleteData['competition_levels']['intramurals'] ?? '0' }}</span>
            </div>
        </div>

        <!-- Scholarship Support Summary -->
        <div class="section">
            <div class="section-title">Athlete Scholarship Support</div>
            <div class="field">
                <span class="field-label">Full Scholarship Athletes:</span>
                <span class="field-value">{{ $athleteData['scholarship_status']['full'] ?? '0' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Partial Scholarship Athletes:</span>
                <span class="field-value">{{ $athleteData['scholarship_status']['partial'] ?? '0' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Non-scholar Athletes:</span>
                <span class="field-value">{{ $athleteData['scholarship_status']['non_scholar'] ?? '0' }}</span>
            </div>
            
            <!-- Support Services -->
            <div class="sub-section">
                <div class="sub-section-title">Support Services Provided:</div>
                <div class="field">
                    <span class="field-label">Board & Lodging Support:</span>
                    <span class="field-value">{{ $athleteData['support_services']['board_lodging'] ?? '0' }} athletes</span>
                </div>
                <div class="field">
                    <span class="field-label">Medical Insurance Support:</span>
                    <span class="field-value">{{ $athleteData['support_services']['medical_insurance'] ?? '0' }} athletes</span>
                </div>
                <div class="field">
                    <span class="field-label">Training Uniforms Support:</span>
                    <span class="field-value">{{ $athleteData['support_services']['training_uniforms'] ?? '0' }} athletes</span>
                </div>
                <div class="field">
                    <span class="field-label">Playing Uniforms Sponsorship:</span>
                    <span class="field-value">{{ $athleteData['support_services']['playing_uniforms'] ?? '0' }} athletes</span>
                </div>
                <div class="field">
                    <span class="field-label">Playing Gears Sponsorship:</span>
                    <span class="field-value">{{ $athleteData['support_services']['playing_gears'] ?? '0' }} athletes</span>
                </div>
            </div>
        </div>

        <!-- Training & Academic Support -->
        <div class="section">
            <div class="section-title">Training & Academic Support</div>
            <div class="field">
                <span class="field-label">Average Training Days per Week:</span>
                <span class="field-value">{{ $athleteData['training_summary']['avg_days_per_week'] ?? '0' }} days</span>
            </div>
            <div class="field">
                <span class="field-label">Average Hours per Training Day:</span>
                <span class="field-value">{{ $athleteData['training_summary']['avg_hours_per_day'] ?? '0' }} hours</span>
            </div>
            
            <!-- Academic Support -->
            <div class="sub-section">
                <div class="sub-section-title">Academic Support Provided:</div>
                <div class="field">
                    <span class="field-label">Excused from Academic Obligations:</span>
                    <span class="field-value">{{ $athleteData['academic_support']['excused_obligations'] ?? '0' }} athletes</span>
                </div>
                <div class="field">
                    <span class="field-label">Flexible Academic Schedule:</span>
                    <span class="field-value">{{ $athleteData['academic_support']['flexible_schedule'] ?? '0' }} athletes</span>
                </div>
                <div class="field">
                    <span class="field-label">Academic Tutorials Support:</span>
                    <span class="field-value">{{ $athleteData['academic_support']['tutorials_support'] ?? '0' }} athletes</span>
                </div>
            </div>
        </div>

        <!-- Intramurals Activities -->
        <div class="section">
            <div class="section-title">Intramurals Activities</div>
            <div class="field">
                <span class="field-label">Departmental Intramurals:</span>
                <span class="field-value">{{ $institutionalData['departmental_intramurals'] ?? false ? 'Yes' : 'No' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Interdepartmental Intramurals:</span>
                <span class="field-value">{{ $institutionalData['interdepartmental_intramurals'] ?? false ? 'Yes' : 'No' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Inter-campus Intramurals:</span>
                <span class="field-value">{{ $institutionalData['intercampus_intramurals'] ?? false ? 'Yes' : 'No' }}</span>
            </div>
        </div>

        <!-- Facilities -->
        <div class="section">
            <div class="section-title">Sports Facilities</div>
            <div class="field">
                <span class="field-label">Other Training Venues:</span>
                <span class="field-value">{{ $institutionalData['other_facilities'] ?? 'Not specified' }}</span>
            </div>
        </div>

        <!-- Athlete Status Summary -->
        <div class="section">
            <div class="section-title">Athlete Status Overview</div>
            <div class="field">
                <span class="field-label">Active Athletes:</span>
                <span class="field-value">{{ $athleteData['status_overview']['active'] ?? '0' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Injured Athletes:</span>
                <span class="field-value">{{ $athleteData['status_overview']['injured'] ?? '0' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Graduated Athletes:</span>
                <span class="field-value">{{ $athleteData['status_overview']['graduate'] ?? '0' }}</span>
            </div>
        </div>
    </div>
</body>
</html>