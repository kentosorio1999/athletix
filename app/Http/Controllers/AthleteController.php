<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Athlete;
use App\Models\Team;

class AthleteController extends Controller
{
    public function deactivateIndex(Request $request)
    {
        $query = Athlete::query()->where('status', 'active'); // Only active athletes

        // Search by name
        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        // Filter by team
        if ($request->filled('team')) {
            $query->whereHas('teams', function ($q) use ($request) {
                $q->where('id', $request->team);
            });
        }

        $athletes = $query->with('teams')->get();

        // Get all teams for filter dropdown
        $teams = Team::all();

        return view('staff.athlete_deactivate', compact('athletes', 'teams'));
    }


    public function deactivate(Request $request, $id)
    {
        $athlete = Athlete::findOrFail($id);
        $athlete->status = 'inactive'; // Archive/deactivate logic
        $athlete->save();

        return redirect()->route('staff.athlete.deactivate')
                         ->with('success', 'Athlete deactivated successfully.');
    }
}
