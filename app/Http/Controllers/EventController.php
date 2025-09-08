<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Sport;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('removed', 0)->with('sport')->get();
        $sports = Sport::where('removed', 0)->get();

        return view('events', compact('events', 'sports'));
    }

     // Store new event
    public function storeEvent(Request $request)
    {
        $request->validate([
            'sport_id' => 'required|exists:sports,sport_id',
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_type' => 'required|in:Training,Competition,Meeting',
        ]);

        Event::create($request->all());

        return redirect()->back()->with('success', 'Event added successfully.');
    }

    // Update event
    public function updateEvent(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'sport_id' => 'required|exists:sports,sport_id',
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_type' => 'required|in:Training,Competition,Meeting',
        ]);

        $event->update($request->all());

        return redirect()->back()->with('success', 'Event updated successfully.');
    }

    // Soft delete
    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);
        $event->update(['removed' => 1]);

        return redirect()->back()->with('success', 'Event removed successfully.');
    }
}
