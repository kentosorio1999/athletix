<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class AuthController extends Controller
{
    // Register new user
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|email|unique:users,username', // username IS the email
            'password' => 'required|string|min:6|confirmed', // 👈 make sure you also have password_confirmation field
        ]);

        // 1. Save the new user
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        // 2. Generate OTP (6 digits)
        $otp = rand(100000, 999999);

        // 3. Store OTP
        DB::table('otps')->insert([
            'user_id'    => $user->user_id,
            'otp'        => $otp,
            'expires_at' => now()->addMinutes(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. Send OTP via email
        Mail::to($user->username)->send(new OtpMail($otp));

        return response()->json([
            'success' => true,
            'message' => 'Registration successful. Please verify OTP sent to your email.',
            'user_id' => $user->user_id,
            'redirect_url' => route('verify.otp.page', ['user_id' => $user->user_id])
        ]);
    }



    // Login user
    public function login(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find the user by the username
        $user = User::where('username', $request->username)->first();

        // Check if user exists and password is correct
        if ($user && Hash::check($request->password, $user->password)) {
            // Log the user in
            Auth::login($user);

            // Return a JSON response with success and redirect URL
            return response()->json([
                'success' => true,
                'redirect_url' => route('announcement')
            ]);
        }

        // If the login fails, return validation errors
        return response()->json([
            'success' => false,
            'errors' => [
                'username' => ['These credentials do not match our records.'],
            ]
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'otp' => 'required|numeric',
        ]);

        $record = DB::table('otps')
            ->where('user_id', $request->user_id)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP.'
            ]);
        }

        // ✅ Mark user as active
        DB::table('users')->where('user_id', $request->user_id)->update(['status' => 'active']);

        // ✅ Delete OTP after use
        DB::table('otps')->where('user_id', $request->user_id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully!',
            'redirect_url' => route('dashboard') // 👈 change this to your landing page
        ]);
    }

    public function showOtpPage($user_id)
    {
        // Pass the user_id to the view so you can include it in the form
        return view('auth.verify-otp', compact('user_id'));
    }

    public function resendOtp(Request $request)
    {
        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found']);
        }

        // Generate new OTP
        $otp = rand(100000, 999999);

        // Upsert OTP in the otps table
        DB::table('otps')->updateOrInsert(
            ['user_id' => $user->user_id],
            [
                'otp'        => $otp,
                'expires_at' => now()->addMinutes(10),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        // Send OTP via email
        Mail::to($user->username)->send(new OtpMail($otp));

        return response()->json([
            'success' => true,
            'message' => 'A new OTP has been sent!'
        ]);
    }


}
