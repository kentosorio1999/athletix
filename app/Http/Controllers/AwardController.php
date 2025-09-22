<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Award;
use App\Models\Athlete;
use App\Models\Event;

class AwardController extends Controller
{
    public function index()
    {
        $coach = Auth::user();

        // Only awards from athletes in coach's sport
        $awards = Award::with(['athlete', 'event'])
            ->whereHas('athlete', function ($q) use ($coach) {
                $q->where('sport_id', $coach->sport_id);
            })
            ->get();

        return view('coach.awards.index', compact('awards'));
    }

    public function create()
    {
        $coach = Auth::user();
        $athletes = Athlete::where('sport_id', $coach->sport_id)->get();
        $events = Event::where('sport_id', $coach->sport_id)->get();

        return view('coach.awards.create', compact('athletes', 'events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'athlete_id' => 'required|exists:athletes,athlete_id',
            'event_id'   => 'required|exists:events,event_id',
            'title'      => 'required|string|max:255',
            'description'=> 'nullable|string',
        ]);

        Award::create($request->all());

        return redirect()->route('coach.awards.index')->with('success', 'Award created successfully.');
    }

    public function edit(Award $award)
    {
        $coach = Auth::user();
        $athletes = Athlete::where('sport_id', $coach->sport_id)->get();
        $events = Event::where('sport_id', $coach->sport_id)->get();

        return view('coach.awards.edit', compact('award', 'athletes', 'events'));
    }

    public function update(Request $request, Award $award)
    {
        $request->validate([
            'athlete_id' => 'required|exists:athletes,athlete_id',
            'event_id'   => 'required|exists:events,event_id',
            'title'      => 'required|string|max:255',
            'description'=> 'nullable|string',
        ]);

        $award->update($request->all());

        return redirect()->route('coach.awards.index')->with('success', 'Award updated successfully.');
    }

    public function destroy(Award $award)
    {
        $award->delete();
        return redirect()->route('coach.awards.index')->with('success', 'Award deleted successfully.');
    }
}
