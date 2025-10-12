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
        
        .question { margin-bottom: 20px; }
        .question-title { font-weight: bold; margin-bottom: 5px; }
        .answer { margin-left: 20px; padding: 10px; border-left: 3px solid #ccc; background-color: #f9f9f9; }
        .respondent-info { margin-top: 30px; padding: 15px; background-color: #f0f0f0; }
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
        
        <div class="form-title">FORM G: FEEDBACK</div>
        <div class="report-info">
            Generated on: {{ date('F j, Y') }} | HEI: {{ $institutionalData['hei_name'] ?? 'Cebu Technological University' }}
        </div>
    </div>

    <!-- Form G Content -->
    <div class="content">
        <div class="question">
            <div class="question-title">1. How can these templates be improved?</div>
            <div class="answer">{{ $feedbackData['template_improvements'] ?? 'No response provided' }}</div>
        </div>

        <div class="question">
            <div class="question-title">2. What other important sports data should be captured/measured?</div>
            <div class="answer">{{ $feedbackData['additional_data'] ?? 'No response provided' }}</div>
        </div>

        <div class="question">
            <div class="question-title">3. What items were the most difficult to find data on?</div>
            <div class="answer">{{ $feedbackData['difficult_data'] ?? 'No response provided' }}</div>
        </div>

        <div class="question">
            <div class="question-title">4. What items were the most easiest to find data on? (i.e. had readily available data)</div>
            <div class="answer">{{ $feedbackData['easy_data'] ?? 'No response provided' }}</div>
        </div>

        <div class="question">
            <div class="question-title">5. Additional Comments or Suggestions</div>
            <div class="answer">{{ $feedbackData['additional_comments'] ?? 'No response provided' }}</div>
        </div>

        <div class="respondent-info">
            <strong>Respondent Information:</strong><br>
            Name: {{ $feedbackData['respondent_name'] ?? 'Not provided' }}<br>
            Email: {{ $feedbackData['respondent_email'] ?? 'Not provided' }}
        </div>
    </div>
</body>
</html>