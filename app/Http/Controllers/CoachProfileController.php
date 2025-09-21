<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CoachProfileController extends Controller
{
    // Show edit form
    public function edit()
    {
        $user = Auth::user();
        $coach = $user->coach; // User hasOne Coach

        return view('coach.profile.edit', compact('user', 'coach'));
    }

    // Update profile
    public function update(Request $request)
    {
        $user = Auth::user();
        $coach = $user->coach;

        $validated = $request->validate([
            'username'       => 'required|string|max:255|unique:users,username,' . $user->user_id . ',user_id',
            'password'       => 'nullable|string|min:6|confirmed',
            'full_name'      => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'sport_id'       => 'nullable|exists:sports,sport_id',
        ]);

        // Update user credentials
        $user->username = $validated['username'];
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        // Update or create coach profile
        $coach = \App\Models\Coach::updateOrCreate(
            ['user_id' => $user->user_id],
            [
                'full_name'      => $validated['full_name'],
                'specialization' => $validated['specialization'] ?? null,
                'sport_id'       => $validated['sport_id'] ?? null,
            ]
        );

        return redirect()->route('coach.profile.edit')->with('success', 'Profile updated successfully.');
    }
}
