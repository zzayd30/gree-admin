<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;

class OtpPasswordResetController extends Controller
{
    /**
     * Display the forgot password form.
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send OTP to the user's email.
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        // Generate 6-digit OTP
        $otp = sprintf('%06d', mt_rand(0, 999999));

        // Delete any existing OTPs for this email
        DB::table('password_reset_otps')->where('email', $request->email)->delete();

        // Store OTP (expires in 10 minutes)
        DB::table('password_reset_otps')->insert([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10),
            'created_at' => now(),
        ]);

        // Send OTP via email
        try {
            Mail::raw("Your OTP for password reset is: {$otp}\n\nThis code will expire in 10 minutes.", function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Password Reset OTP - Gree Admin');
            });

            return redirect()->route('password.verify-otp.show')
                ->with('email', $request->email)
                ->with('status', 'OTP has been sent to your email address.');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send OTP. Please try again.']);
        }
    }

    /**
     * Display the OTP verification form.
     */
    public function showVerifyOtpForm()
    {
        if (! session('email')) {
            return redirect()->route('password.request');
        }

        return view('auth.verify-otp');
    }

    /**
     * Verify the OTP.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $record = DB::table('password_reset_otps')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (! $record) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        return redirect()->route('password.reset.show')
            ->with('email', $request->email)
            ->with('otp_verified', true)
            ->with('status', 'OTP verified successfully. Please set your new password.');
    }

    /**
     * Display the reset password form.
     */
    public function showResetPasswordForm()
    {
        if (! session('otp_verified') || ! session('email')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password');
    }

    /**
     * Reset the user's password.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Verify OTP still exists and is valid
        $record = DB::table('password_reset_otps')
            ->where('email', $request->email)
            ->where('expires_at', '>', now())
            ->first();

        if (! $record) {
            return back()->withErrors(['email' => 'Session expired. Please request a new OTP.']);
        }

        // Update user's password
        $user = User::where('email', $request->email)->first();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Delete the used OTP
        DB::table('password_reset_otps')->where('email', $request->email)->delete();

        // Clear session
        $request->session()->forget(['email', 'otp_verified']);

        return redirect()->route('login')
            ->with('status', 'Your password has been reset successfully. Please login with your new password.');
    }
}
