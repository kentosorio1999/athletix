<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Staff;

class StaffProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $staff = Staff::where('user_id', $user->user_id)->firstOrFail();

        return view('staff.profile', compact('user', 'staff'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $staff = Staff::where('user_id', $user->user_id)->firstOrFail();

        $request->validate([
            'username' => 'required|string|max:100|unique:users,username,' . $user->user_id . ',user_id',
            'password' => 'nullable|string|min:6|confirmed',
            'full_name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
        ]);

        // Update user credentials
        $user->username = $request->username;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Update staff details
        $staff->full_name = $request->full_name;
        $staff->position = $request->position;
        $staff->save();

        return redirect()->route('staff.profile.edit')->with('success', 'Profile updated successfully.');
    }
}
