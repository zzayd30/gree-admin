<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rules;

class CustomerPasswordResetController extends Controller
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
        
        // Verify customer exists
        $customer = Customer::where('email', $email)->first();
        
        if (!$customer) {
            abort(404, 'Customer not found.');
        }

        return view('customer.auth.set-password', [
            'email' => $email,
            'signature' => $request->query('signature'),
            'expires' => $request->query('expires'),
        ]);
    }

    /**
     * Handle the password reset.
     */
    public function setPassword(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => ['required', 'email', 'exists:customers,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'signature' => ['required'],
            'expires' => ['required'],
        ]);

        // Reconstruct the signed URL to verify it
        $url = URL::to('/customer/set-password', [
            'email' => $request->email,
            'signature' => $request->signature,
            'expires' => $request->expires,
        ]);

        // Find the customer
        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            return back()->with('error', 'Customer not found.');
        }

        // Update password and activate account
        $customer->update([
            'password' => Hash::make($request->password),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Your password has been set successfully. You can now log in.');
    }
}
