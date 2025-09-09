<?php 

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Sport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReportController extends Controller
{
    // Show report page
    public function index(Request $request)
    {
        $athletes = Athlete::with(['sport', 'awards'])
            ->when($request->year, fn($q) => $q->whereYear('created_at', $request->year))
            ->when($request->sport, fn($q) => $q->where('sport_id', $request->sport))
            ->when($request->status, fn($q) => $q->where('conditions', $request->status))
            ->get();

        $sports = Sport::all();

        return view('reports.index', compact('athletes', 'sports'));
    }

    // Export function
    public function export(Request $request, $format)
    {
        $athletes = Athlete::with(['sport', 'awards'])
            ->when($request->year, fn($q) => $q->whereYear('created_at', $request->year))
            ->when($request->sport, fn($q) => $q->where('sport_id', $request->sport))
            ->when($request->status, fn($q) => $q->where('conditions', $request->status))
            ->get();

        // CSV Export
        if ($format === 'csv') {
            $fileName = "athletes_report.csv";

            return response()->stream(function () use ($athletes) {
                $handle = fopen('php://output', 'w');

                // CSV header
                fputcsv($handle, ['ID', 'Name', 'Birthdate', 'Course/Year', 'Sport', 'Status', 'Awards', 'Created At']);

                foreach ($athletes as $athlete) {
                    fputcsv($handle, [
                        $athlete->school_id,
                        $athlete->full_name,
                        $athlete->birthdate ?? '-',
                        ($athlete->section && $athlete->section->course ? $athlete->section->course->course_name : '-') 
                        . ' / ' . $athlete->year_level,
                        $athlete->sport->sport_name ?? '-',
                        ucfirst($athlete->conditions),
                        $athlete->awards->pluck('title')->join(', '),
                        $athlete->created_at->format('Y-m-d'),
                    ]);
                }

                fclose($handle);
            }, 200, [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName"
            ]);
        }

        // Excel Export (requires maatwebsite/excel)
        if ($format === 'xlsx') {
            return Excel::download(new \App\Exports\AthleteReportExport($athletes), 'athletes_report.xlsx');
        }

        // PDF Export (requires barryvdh/laravel-dompdf)
        if ($format === 'pdf') {
            $pdf = PDF::loadView('reports.pdf', compact('athletes'));
            return $pdf->download('athletes_report.pdf');
        }

        abort(404);
    }

    public function exportPDF()
    {
        $athletes = Athlete::with(['section', 'sport', 'participations', 'scholarships'])
            ->where('removed', 0)
            ->get();

        $pdf = PDF::loadView('reports.pdf', compact('athletes'));
        return $pdf->download('ched_athlete_report.pdf');
    }
}
