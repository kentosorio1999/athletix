<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    // Show all announcements
    public function index()
    {
        $announcements = Announcement::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('announcements', compact('announcements'));
    }

    // Store new announcement
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'required|string',
            'venue' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);

        Announcement::create([
            'title' => $request->title,
            'details' => $request->details,
            'venue' => $request->venue,
            'date' => $request->date,
            'posted_by' => auth()->id(), // assuming user is logged in
        ]);

        return redirect()->route('announcements.index')->with('success', 'Announcement added successfully.');
    }

}
