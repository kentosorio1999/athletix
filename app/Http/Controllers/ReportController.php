<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Athlete;
use App\Models\Sport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AthleteExport;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Athlete::with(['sport', 'awards']);

        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        if ($request->filled('sport')) {
            $query->where('sport_id', $request->sport);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $athletes = $query->latest()->get();
        $sports = Sport::all();

        return view('reports.index', compact('athletes', 'sports'));
    }

    public function export(Request $request, $format)
    {
        $filename = 'ched_report_' . now()->format('Y_m_d_His') . '.' . $format;
        return Excel::download(new AthleteExport($request), $filename);
    }
}
