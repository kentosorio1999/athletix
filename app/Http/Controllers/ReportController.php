<?php 

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Coach;
use App\Models\Sport;
use App\Models\Team;
use App\Models\Event;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // Show report page
    public function index(Request $request)
    {
        $athletes = $this->getFilteredAthletes($request);
        $coaches = $this->getFilteredCoaches($request);
        $sports = Sport::where('removed', 0)->get();

        // FORM F: Non-Varsity Clubs Data using Eloquent
        $nonVarsityClubs = $this->getNonVarsityClubs();

        // Get institutional data for header
        $institutionalData = session('institutional_data') ?? [];

        return view('reports.index', compact('athletes', 'coaches', 'sports', 'nonVarsityClubs', 'institutionalData'));
    }

    // Export function for individual forms
    public function exportForm(Request $request, $form, $format)
    {
        $institutionalData = session('institutional_data') ?? [];
        
        switch($form) {
            case 'A':
                return $this->exportFormA($format, $institutionalData);
            case 'B':
                return $this->exportFormB($format, $institutionalData);
            case 'C':
                return $this->exportFormC($request, $format, $institutionalData);
            case 'D':
                return $this->exportFormD($request, $format, $institutionalData);
            case 'E':
                return $this->exportFormE($format, $institutionalData);
            case 'F':
                return $this->exportFormF($request, $format, $institutionalData);
            case 'G':
                return $this->exportFormG($format, $institutionalData);
            default:
                abort(404, 'Form not found');
        }
    }

    // FORM A Export
    private function exportFormA($format, $institutionalData)
    {
        if ($format === 'pdf') {
            $pdf = PDF::loadView('reports.forms.form_a_pdf', compact('institutionalData'));
            return $pdf->download('CHED_FORM_A_Institutional_Info_' . date('Y-m-d') . '.pdf');
        }

        if ($format === 'csv') {
            $fileName = "CHED_FORM_A_Institutional_Info_" . date('Y-m-d_H-i-s') . ".csv";

            return response()->stream(function () use ($institutionalData) {
                $handle = fopen('php://output', 'w');
                fwrite($handle, "\xEF\xBB\xBF");

                fputcsv($handle, ['CHED FORM A: INSTITUTIONAL INFORMATION']);
                fputcsv($handle, ['Generated on: ' . date('F j, Y')]);
                fputcsv($handle, []);
                
                fputcsv($handle, ['HEI Information']);
                fputcsv($handle, ['Name of HEI:', $institutionalData['hei_name'] ?? 'Not provided']);
                fputcsv($handle, ['HEI Campus:', $institutionalData['hei_campus'] ?? 'Not provided']);
                fputcsv($handle, ['Address:', $institutionalData['hei_address'] ?? 'Not provided']);
                fputcsv($handle, ['HEI President:', $institutionalData['hei_president'] ?? 'Not provided']);
                fputcsv($handle, []);
                
                fputcsv($handle, ['Sports Director Information']);
                fputcsv($handle, ['Name:', $institutionalData['sports_director_name'] ?? 'Not provided']);
                fputcsv($handle, ['Email:', $institutionalData['sports_director_email'] ?? 'Not provided']);
                fputcsv($handle, ['Mobile:', $institutionalData['sports_director_mobile'] ?? 'Not provided']);
                fputcsv($handle, []);
                
                fputcsv($handle, ['Contact Person Information']);
                fputcsv($handle, ['Name:', $institutionalData['contact_person_name'] ?? 'Not provided']);
                fputcsv($handle, ['Email:', $institutionalData['contact_person_email'] ?? 'Not provided']);
                fputcsv($handle, ['Mobile:', $institutionalData['contact_person_mobile'] ?? 'Not provided']);

                fclose($handle);
            }, 200, [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName"
            ]);
        }

        abort(404, 'Export format not supported');
    }

    // FORM B Export
    private function exportFormB($format, $institutionalData)
    {
        $sports = Sport::with(['teams', 'coaches', 'athletes', 'events'])
            ->where('removed', 0)
            ->get();

        if ($format === 'pdf') {
            $pdf = PDF::loadView('reports.forms.form_b_pdf', compact('sports', 'institutionalData'));
            return $pdf->download('CHED_FORM_B_Sports_Programs_' . date('Y-m-d') . '.pdf');
        }

        if ($format === 'csv') {
            $fileName = "CHED_FORM_B_Sports_Programs_" . date('Y-m-d_H-i-s') . ".csv";

            return response()->stream(function () use ($sports, $institutionalData) {
                $handle = fopen('php://output', 'w');
                fwrite($handle, "\xEF\xBB\xBF");

                fputcsv($handle, ['CHED FORM B: SPORTS PROGRAMS']);
                fputcsv($handle, ['Generated on: ' . date('F j, Y')]);
                fputcsv($handle, ['HEI: ' . ($institutionalData['hei_name'] ?? 'Not specified')]);
                fputcsv($handle, []);

                foreach ($sports as $sport) {
                    fputcsv($handle, ['Sport: ' . $sport->sport_name]);
                    fputcsv($handle, ['Number of Teams:', $sport->teams->count()]);
                    fputcsv($handle, ['Number of Coaches:', $sport->coaches->count()]);
                    fputcsv($handle, ['Number of Athletes:', $sport->athletes->count()]);
                    fputcsv($handle, ['Number of Events:', $sport->events->count()]);
                    fputcsv($handle, []);
                }

                fclose($handle);
            }, 200, [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName"
            ]);
        }

        abort(404, 'Export format not supported');
    }

    // FORM C Export
    private function exportFormC(Request $request, $format, $institutionalData)
    {
        $athletes = $this->getFilteredAthletes($request);

        if ($format === 'pdf') {
            $pdf = PDF::loadView('reports.forms.form_c_pdf', compact('athletes', 'institutionalData'));
            return $pdf->download('CHED_FORM_C_Student_Athletes_' . date('Y-m-d') . '.pdf');
        }

        if ($format === 'csv') {
            $fileName = "CHED_FORM_C_Student_Athletes_" . date('Y-m-d_H-i-s') . ".csv";

            return response()->stream(function () use ($athletes, $institutionalData) {
                $handle = fopen('php://output', 'w');
                fwrite($handle, "\xEF\xBB\xBF");

                fputcsv($handle, ['CHED FORM C: STUDENT-ATHLETES INFORMATION']);
                fputcsv($handle, ['Generated on: ' . date('F j, Y')]);
                fputcsv($handle, ['HEI: ' . ($institutionalData['hei_name'] ?? 'Not specified')]);
                fputcsv($handle, ['Total Records: ' . $athletes->count()]);
                fputcsv($handle, []);

                fputcsv($handle, [
                    'Name',
                    'Age',
                    'Sports Program',
                    'Gender',
                    'Academic Course',
                    'Year Level',
                    'Competition Level',
                    'Scholarship Status',
                    'Monthly Allowance'
                ]);

                foreach ($athletes as $athlete) {
                    fputcsv($handle, [
                        $athlete->full_name,
                        $athlete->age ?? '',
                        $athlete->sport->sport_name ?? '',
                        $athlete->gender ?? '',
                        $athlete->academic_course ?? '',
                        $athlete->year_level,
                        $athlete->highest_competition_level ?? '',
                        $athlete->scholarship_status ?? '',
                        $athlete->monthly_living_allowance ? '₱' . number_format($athlete->monthly_living_allowance, 2) : ''
                    ]);
                }

                fclose($handle);
            }, 200, [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName"
            ]);
        }

        abort(404, 'Export format not supported');
    }

    // FORM D Export
    private function exportFormD(Request $request, $format, $institutionalData)
    {
        $coaches = $this->getFilteredCoaches($request);

        if ($format === 'pdf') {
            $pdf = PDF::loadView('reports.forms.form_d_pdf', compact('coaches', 'institutionalData'));
            return $pdf->download('CHED_FORM_D_Sports_Personnel_' . date('Y-m-d') . '.pdf');
        }

        if ($format === 'csv') {
            $fileName = "CHED_FORM_D_Sports_Personnel_" . date('Y-m-d_H-i-s') . ".csv";

            return response()->stream(function () use ($coaches, $institutionalData) {
                $handle = fopen('php://output', 'w');
                fwrite($handle, "\xEF\xBB\xBF");

                fputcsv($handle, ['CHED FORM D: SPORTS PERSONNEL']);
                fputcsv($handle, ['Generated on: ' . date('F j, Y')]);
                fputcsv($handle, ['HEI: ' . ($institutionalData['hei_name'] ?? 'Not specified')]);
                fputcsv($handle, ['Total Records: ' . $coaches->count()]);
                fputcsv($handle, []);

                fputcsv($handle, [
                    'Name',
                    'Age',
                    'Gender',
                    'Sports Program',
                    'Position Title',
                    'Employment Status',
                    'Monthly Salary',
                    'Years Experience'
                ]);

                foreach ($coaches as $coach) {
                    fputcsv($handle, [
                        $coach->full_name,
                        $coach->age ?? '',
                        $coach->gender ?? '',
                        $coach->sport->sport_name ?? '',
                        $coach->current_position_title ?? 'Coach',
                        $coach->employment_status ?? '',
                        $coach->monthly_salary ? '₱' . number_format($coach->monthly_salary, 2) : '',
                        $coach->years_experience ?? ''
                    ]);
                }

                fclose($handle);
            }, 200, [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName"
            ]);
        }

        abort(404, 'Export format not supported');
    }

    // FORM E Export
    private function exportFormE($format, $institutionalData)
    {
        $budgetData = session('budget_data') ?? [];

        if ($format === 'pdf') {
            $pdf = PDF::loadView('reports.forms.form_e_pdf', compact('budgetData', 'institutionalData'));
            return $pdf->download('CHED_FORM_E_Budget_Expenditure_' . date('Y-m-d') . '.pdf');
        }

        if ($format === 'csv') {
            $fileName = "CHED_FORM_E_Budget_Expenditure_" . date('Y-m-d_H-i-s') . ".csv";

            return response()->stream(function () use ($budgetData, $institutionalData) {
                $handle = fopen('php://output', 'w');
                fwrite($handle, "\xEF\xBB\xBF");

                fputcsv($handle, ['CHED FORM E: BUDGET AND EXPENDITURE']);
                fputcsv($handle, ['Generated on: ' . date('F j, Y')]);
                fputcsv($handle, ['HEI: ' . ($institutionalData['hei_name'] ?? 'Not specified')]);
                fputcsv($handle, []);

                // Add budget data here based on your form structure
                fputcsv($handle, ['Budget data will be populated here']);

                fclose($handle);
            }, 200, [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName"
            ]);
        }

        abort(404, 'Export format not supported');
    }

    // FORM F Export
    private function exportFormF(Request $request, $format, $institutionalData)
    {
        $nonVarsityClubs = $this->getNonVarsityClubs();

        if ($format === 'pdf') {
            $pdf = PDF::loadView('reports.forms.form_f_pdf', compact('nonVarsityClubs', 'institutionalData'));
            return $pdf->download('CHED_FORM_F_NonVarsity_Clubs_' . date('Y-m-d') . '.pdf');
        }

        if ($format === 'csv') {
            $fileName = "CHED_FORM_F_NonVarsity_Clubs_" . date('Y-m-d_H-i-s') . ".csv";

            return response()->stream(function () use ($nonVarsityClubs, $institutionalData) {
                $handle = fopen('php://output', 'w');
                fwrite($handle, "\xEF\xBB\xBF");

                fputcsv($handle, ['CHED FORM F: NON-VARSITY SCHOOL-BASED SPORTS ORGANIZATIONS']);
                fputcsv($handle, ['Generated on: ' . date('F j, Y')]);
                fputcsv($handle, ['HEI: ' . ($institutionalData['hei_name'] ?? 'Not specified')]);
                fputcsv($handle, ['Total Clubs: ' . count($nonVarsityClubs)]);
                fputcsv($handle, []);

                fputcsv($handle, [
                    'Sports',
                    'Sports (Sex)',
                    'Sports Club Name',
                    'Club Moderator',
                    'Main Program/Activity',
                    'Secondary Program/Activity'
                ]);

                foreach ($nonVarsityClubs as $club) {
                    fputcsv($handle, [
                        $club->sport_name,
                        $club->sports_sex,
                        $club->sports_club_name,
                        $club->club_moderator,
                        $club->main_program_activity,
                        $club->secondary_program_activity
                    ]);
                }

                fclose($handle);
            }, 200, [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName"
            ]);
        }

        abort(404, 'Export format not supported');
    }

    // FORM G Export
    private function exportFormG($format, $institutionalData)
    {
        $feedbackData = session('feedback_data') ?? [];

        if ($format === 'pdf') {
            $pdf = PDF::loadView('reports.forms.form_g_pdf', compact('feedbackData', 'institutionalData'));
            return $pdf->download('CHED_FORM_G_Feedback_' . date('Y-m-d') . '.pdf');
        }

        if ($format === 'csv') {
            $fileName = "CHED_FORM_G_Feedback_" . date('Y-m-d_H-i-s') . ".csv";

            return response()->stream(function () use ($feedbackData, $institutionalData) {
                $handle = fopen('php://output', 'w');
                fwrite($handle, "\xEF\xBB\xBF");

                fputcsv($handle, ['CHED FORM G: FEEDBACK']);
                fputcsv($handle, ['Generated on: ' . date('F j, Y')]);
                fputcsv($handle, ['HEI: ' . ($institutionalData['hei_name'] ?? 'Not specified')]);
                fputcsv($handle, []);

                fputcsv($handle, ['1. How can these templates be improved?']);
                fputcsv($handle, [$feedbackData['template_improvements'] ?? 'No response']);
                fputcsv($handle, []);

                fputcsv($handle, ['2. What other important sports data should be captured/measured?']);
                fputcsv($handle, [$feedbackData['additional_data'] ?? 'No response']);
                fputcsv($handle, []);

                fputcsv($handle, ['3. What items were the most difficult to find data on?']);
                fputcsv($handle, [$feedbackData['difficult_data'] ?? 'No response']);
                fputcsv($handle, []);

                fputcsv($handle, ['4. What items were the most easiest to find data on?']);
                fputcsv($handle, [$feedbackData['easy_data'] ?? 'No response']);
                fputcsv($handle, []);

                fputcsv($handle, ['5. Additional Comments or Suggestions']);
                fputcsv($handle, [$feedbackData['additional_comments'] ?? 'No response']);
                fputcsv($handle, []);

                fputcsv($handle, ['Respondent Information']);
                fputcsv($handle, ['Name:', $feedbackData['respondent_name'] ?? 'Not provided']);
                fputcsv($handle, ['Email:', $feedbackData['respondent_email'] ?? 'Not provided']);

                fclose($handle);
            }, 200, [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName"
            ]);
        }

        abort(404, 'Export format not supported');
    }

    // Helper Methods
    private function getFilteredAthletes(Request $request)
    {
        return Athlete::with(['sport', 'awards', 'section.course'])
            ->where('removed', 0)
            ->when($request->year, fn($q) => $q->whereYear('created_at', $request->year))
            ->when($request->sport, fn($q) => $q->where('sport_id', $request->sport))
            ->when($request->status, fn($q) => $q->where('conditions', $request->status))
            ->when($request->year_level, fn($q) => $q->where('year_level', $request->year_level))
            ->get();
    }

    private function getFilteredCoaches(Request $request)
    {
        return Coach::with(['sport'])
            ->where('removed', 0)
            ->when($request->sport, fn($q) => $q->where('sport_id', $request->sport))
            ->get();
    }

    private function getNonVarsityClubs()
    {
        return Sport::with(['teams', 'coaches', 'athletes', 'events'])
            ->where('removed', 0)
            ->get()
            ->map(function ($sport) {
                $maleAthletes = $sport->athletes->where('gender', 'Male')->count();
                $femaleAthletes = $sport->athletes->where('gender', 'Female')->count();
                
                $sportsSex = 'Mixed';
                if ($maleAthletes > 0 && $femaleAthletes === 0) $sportsSex = 'Men';
                elseif ($femaleAthletes > 0 && $maleAthletes === 0) $sportsSex = 'Women';

                $eventTypes = $sport->events()
                    ->where('removed', 0)
                    ->select('event_type')
                    ->groupBy('event_type')
                    ->orderByRaw('COUNT(*) DESC')
                    ->pluck('event_type')
                    ->toArray();

                return (object) [
                    'sport_name' => $sport->sport_name,
                    'sports_sex' => $sportsSex,
                    'sports_club_name' => $sport->teams->first()->team_name ?? $sport->sport_name . ' Club',
                    'club_moderator' => $sport->coaches->first()->full_name ?? 'TBD - Assign Coach',
                    'main_program_activity' => $eventTypes[0] ?? 'No activities scheduled',
                    'secondary_program_activity' => $eventTypes[1] ?? 'No secondary activity'
                ];
            });
    }

    // Legacy methods (keep for backward compatibility)
    public function export(Request $request, $format)
    {
        // This can now redirect to the specific form export or handle bulk export
        return $this->exportFormC($request, $format, session('institutional_data') ?? []);
    }

    public function exportPDF(Request $request)
    {
        $athletes = $this->getFilteredAthletes($request);
        $coaches = $this->getFilteredCoaches($request);
        $pdf = PDF::loadView('reports.ched_pdf', compact('athletes', 'coaches'));
        return $pdf->download('ched_comprehensive_report.pdf');
    }

    public function saveInstitutional(Request $request)
    {
        $validated = $request->validate([
            'hei_name' => 'required|string|max:255',
            'hei_campus' => 'nullable|string|max:255',
            'hei_address' => 'required|string',
            'hei_president' => 'required|string|max:255',
            'sports_director_name' => 'required|string|max:255',
            'sports_director_email' => 'required|email',
            'sports_director_alt_email' => 'nullable|email',
            'sports_director_mobile' => 'required|string|max:20',
            'contact_person_name' => 'required|string|max:255',
            'contact_person_email' => 'required|email',
            'contact_person_alt_email' => 'nullable|email',
            'contact_person_mobile' => 'required|string|max:20',
            'departmental_intramurals' => 'nullable|boolean',
            'interdepartmental_intramurals' => 'nullable|boolean',
            'intercampus_intramurals' => 'nullable|boolean',
            'other_facilities' => 'nullable|string',
        ]);

        session(['institutional_data' => $validated]);
        return redirect()->route('reports')->with('success', 'Institutional information saved successfully.');
    }

    public function saveFeedback(Request $request)
    {
        $validated = $request->validate([
            'template_improvements' => 'nullable|string|max:2000',
            'additional_data' => 'nullable|string|max:2000',
            'difficult_data' => 'nullable|string|max:2000',
            'easy_data' => 'nullable|string|max:2000',
            'additional_comments' => 'nullable|string|max:2000',
            'respondent_name' => 'nullable|string|max:255',
            'respondent_email' => 'nullable|email|max:255',
        ]);

        session(['feedback_data' => $validated]);
        return redirect()->route('reports')->with('success', 'Thank you for your feedback!');
    }
}