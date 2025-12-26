<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserPasswordResetController extends Controller
{
    /**
     * Show the password reset form.
     */
    public function showSetPasswordForm(Request $request)
    {
        // Verify the signed URL
        if (!$request->hasValidSignature()) {
            abort(403, 'This password reset link has expired or is invalid.');
        }

        $email = $request->query('email');
        
        // Verify user exists
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            abort(404, 'User not found.');
        }

        // Store the validated email in session to verify during password submission
        session(['user_password_reset_email' => $email]);
        session(['user_password_reset_expires' => now()->addMinutes(30)]);

        return view('auth.set-password', [
            'email' => $email,
        ]);
    }

    /**
     * Handle the password reset.
     */
    public function setPassword(Request $request)
    {
        // Verify session has the validated email and it hasn't expired
        $sessionEmail = session('user_password_reset_email');
        $sessionExpires = session('user_password_reset_expires');
        
        if (!$sessionEmail || !$sessionExpires || now()->greaterThan($sessionExpires)) {
            return redirect()->route('login')->with('error', 'This password reset session has expired. Please request a new password reset link.');
        }

        if ($sessionEmail !== $request->email) {
            return back()->with('error', 'Invalid email address.');
        }
        
        // Validate the request
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Find the user
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        // Update password, set status to active, and verify email
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->status = 'active';
        $user->save();

        // Clear the session
        session()->forget(['user_password_reset_email', 'user_password_reset_expires']);

        return redirect()->route('login')->with('success', 'Your password has been set successfully. You can now log in.');
    }
}
