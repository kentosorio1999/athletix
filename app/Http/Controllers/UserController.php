<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username'   => 'required|string|unique:users,username',
            'password'   => 'required|string|min:6',
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'role_id'    => 'required|integer',
            'profile'    => 'nullable|image|max:2048', // profile image optional
        ]);

        $user = new User();
        $user->username   = $request->username;
        $user->password   = Hash::make($request->password);
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->role_id    = $request->role_id;

        if ($request->hasFile('profile')) {
            $path = $request->file('profile')->store('profiles', 'public');
            $user->profile = $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'User created successfully!');
    }
}
