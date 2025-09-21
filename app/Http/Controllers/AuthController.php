<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Models\Notification;

class AuthController extends Controller
{
    // Register new user
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|email|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // 1. Save the new user
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        // Notify Super Admins
        $this->notifySuperAdmins('New User Registered', "A new user registered: {$user->username}");

        // 2. Generate OTP
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
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            // Redirect URL based on role
            switch ($user->role) {
                case 'SuperAdmin':
                    $redirectUrl = route('dashboard');
                    break;

                case 'Staff':
                    $redirectUrl = route('dashboard');
                    break;

                case 'Coach':
                    $redirectUrl = route('coach.dashboard.index');
                    break;

                case 'Athlete':
                    $redirectUrl = route('athlete.dashboard.index');
                    break;

                default:
                    $redirectUrl = route('dashboard'); // fallback
            }

            return response()->json([
                'success' => true,
                'redirect_url' => $redirectUrl
            ]);
        }

        // Failed login notification
        $this->notifySuperAdmins(
            'Failed Login Attempt',
            "Failed login attempt with username: {$request->username}",
            'warning'
        );

        return response()->json([
            'success' => false,
            'errors' => [
                'username' => ['These credentials do not match our records.'],
            ]
        ]);
    }

    // Verify OTP
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

        DB::table('users')->where('user_id', $request->user_id)->update(['status' => 'active']);
        DB::table('otps')->where('user_id', $request->user_id)->delete();

        // OTP verified notification
        $this->notifySuperAdmins('OTP Verified', "User ID {$request->user_id} has successfully verified their OTP.");

        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully!',
            'redirect_url' => route('dashboard')
        ]);
    }

    // Show OTP page
    public function showOtpPage($user_id)
    {
        return view('auth.verify-otp', compact('user_id'));
    }

    // Resend OTP
    public function resendOtp(Request $request)
    {
        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found']);
        }

        $otp = rand(100000, 999999);

        DB::table('otps')->updateOrInsert(
            ['user_id' => $user->user_id],
            [
                'otp'        => $otp,
                'expires_at' => now()->addMinutes(10),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        Mail::to($user->username)->send(new OtpMail($otp));

        // OTP resend notification
        $this->notifySuperAdmins('OTP Resent', "A new OTP has been sent to user: {$user->username}");

        return response()->json([
            'success' => true,
            'message' => 'A new OTP has been sent!'
        ]);
    }

    // Helper function to notify all Super Admins
    protected function notifySuperAdmins($title, $message, $type = 'info')
    {
        $superAdmins = User::where('role', 'SuperAdmin')->get();

        foreach ($superAdmins as $admin) {
            Notification::create([
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'user_id' => $admin->user_id,
            ]);
        }
    }
}
