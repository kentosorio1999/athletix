<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Sport;
use App\Models\Athlete;
use App\Models\Attendance;
use App\Models\Performance;
use App\Models\EventRegistration;
use App\Models\AthleteTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AthleteNotification;
use App\Models\Coach;

class CoachController extends Controller
{
    public function index()
    {
        // Get the logged-in coach based on the user_id
        $coach = Coach::where('user_id', Auth::id())->first();

        if (!$coach) {
            // If coach not found, return empty or handle error
            return view('coach.events.index', ['events' => collect()]);
        }

        // Get TryOut events for the coach's sport only
        $events = Event::with('sport')
            ->where('removed', 0)
            ->where('event_type', 'TryOut')
            ->where('sport_id', $coach->sport_id)
            ->get();

        return view('coach.events.index', compact('events'));
    }

    public function create()
    {
        $sports = Sport::where('removed', 0)->get();
        return view('coach.events.create', compact('sports'));
    }

    public function store(Request $request)
    {
        $event = Event::create($request->all());
        return redirect()->route('coach.events.index')->with('success', 'Event created successfully.');
    }

    public function attendance(Event $event)
    {
        $athletes = Athlete::whereHas('eventRegistrations', function($q) use ($event) {
            $q->where('event_id', $event->event_id)->where('status', 'approved');
        })->get();

        return view('coach.events.attendance', compact('event', 'athletes'));
    }

    public function updateAttendance(Request $request, Event $event)
    {
        foreach ($request->attendance as $athleteId => $status) {
            Attendance::updateOrCreate(
                ['event_id' => $event->event_id, 'athlete_id' => $athleteId],
                ['status' => $status]
            );
        }
        return back()->with('success', 'Attendance updated.');
    }

    public function performance(Event $event)
    {
        $athletes = Athlete::whereHas('eventRegistrations', function($q) use ($event) {
            $q->where('event_id', $event->event_id)->where('status', 'approved');
        })->get();

        return view('coach.events.performance', compact('event', 'athletes'));
    }

    public function updatePerformance(Request $request, Event $event)
    {
        foreach ($request->performance as $athleteId => $data) {
            Performance::updateOrCreate(
                ['event_id' => $event->event_id, 'athlete_id' => $athleteId],
                ['score' => $data['score'], 'remarks' => $data['remarks']]
            );
        }
        return back()->with('success', 'Performance updated.');
    }

    public function registrations(Event $event)
    {
        $registrations = EventRegistration::with('athlete')
            ->where('event_id', $event->event_id)
            ->get();

        return view('coach.events.registrations', compact('event', 'registrations'));
    }

    public function approve(Event $event, Athlete $athlete)
    {
        EventRegistration::where('event_id', $event->event_id)
            ->where('athlete_id', $athlete->athlete_id)
            ->update(['status' => 'approved']);

        AthleteTeam::create([
            'athlete_id' => $athlete->athlete_id,
            'team_id' => $event->sport_id
        ]);

        // Send notification/email
        Mail::to($athlete->user->email)->send(new AthleteNotification($athlete, 'approved'));

        return back()->with('success', 'Athlete approved and added to team.');
    }

    public function reject(Event $event, Athlete $athlete)
    {
        EventRegistration::where('event_id', $event->event_id)
            ->where('athlete_id', $athlete->athlete_id)
            ->update(['status' => 'rejected']);

        Mail::to($athlete->user->email)->send(new AthleteNotification($athlete, 'rejected'));

        return back()->with('success', 'Athlete rejected.');
    }
}
