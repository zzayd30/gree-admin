<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        if (!session('otp_verified') || !session('email')) {
            return redirect()->route('password.request');
        }
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Verify OTP still exists and is valid
        $record = \DB::table('password_reset_otps')
            ->where('email', $request->email)
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            return back()->withErrors(['email' => 'Session expired. Please request a new OTP.']);
        }

        // Update user's password
        $user = User::where('email', $request->email)->first();
        $user->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        event(new PasswordReset($user));

        // Delete the used OTP
        \DB::table('password_reset_otps')->where('email', $request->email)->delete();

        // Clear session
        $request->session()->forget(['email', 'otp_verified']);

        return redirect()->route('login')
            ->with('status', 'Your password has been reset successfully. Please login with your new password.');
    }
}
