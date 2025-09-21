<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\TrainingNote;
use App\Models\Event;
use Illuminate\Http\Request;

class CoachAthleteController extends Controller
{
    public function index(Request $request)
    {
        $coach = auth()->user()->coach;

        $query = Athlete::where('sport_id', $coach->sport_id)
                        ->with('sport');

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('full_name', 'like', "%{$search}%");
        }

        $athletes = $query->paginate(10);

        return view('coach.athletes.index', compact('athletes'));
    }

    public function show(Athlete $athlete)
    {
        $athlete->load(['sport', 'teams', 'events', 'trainingNotes' => function($q){
            $q->latest();
        }]);

        $events = Event::where('sport_id', $athlete->sport_id)->get();

        return view('coach.athletes.show', compact('athlete', 'events'));
    }

    public function storeNote(Request $request, Athlete $athlete)
    {
        $request->validate(['note' => 'required|string']);

        TrainingNote::create([
            'coach_id' => auth()->user()->coach->coach_id,
            'athlete_id' => $athlete->athlete_id,
            'note' => $request->note,
        ]);

        return back()->with('success', 'Training note added.');
    }

    public function assignEvent(Request $request, Athlete $athlete)
    {
        $request->validate(['event_id' => 'required|exists:events,event_id']);

        $athlete->events()->attach($request->event_id);

        return back()->with('success', 'Athlete assigned to event.');
    }
}

