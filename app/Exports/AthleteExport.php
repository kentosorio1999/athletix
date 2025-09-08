<?php

namespace App\Exports;

use App\Models\Athlete;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AthleteExport implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = Athlete::with(['sport', 'awards']);

        if (!empty($this->request['year'])) {
            $query->whereYear('created_at', $this->request['year']);
        }

        if (!empty($this->request['sport'])) {
            $query->where('sport_id', $this->request['sport']);
        }

        if (!empty($this->request['status'])) {
            $query->where('status', $this->request['status']);
        }

        $athletes = $query->latest()->get();

        return view('reports.export', compact('athletes'));
    }
}
