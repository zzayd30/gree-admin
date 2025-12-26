<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:View Users')->only(['index', 'show']);
        $this->middleware('permission:Create Users')->only(['create', 'store']);
        $this->middleware('permission:Edit Users')->only(['edit', 'update']);
        $this->middleware('permission:Delete Users')->only('destroy');
    }

    public function index()
    {
        $users = User::with('roles')->where('deleted', false)->paginate(10);
        // dd($users);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'status' => ['required', 'in:active,inactive'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['exists:roles,name'],
        ]);

        // Generate temporary password
        $temporaryPassword = Str::random(12);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->roles ? $request->roles[0] : null,
            'status' => $request->status,
            'password' => Hash::make($temporaryPassword),
            'created_by' => Auth::id(),
        ]);

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function sendSetupEmail(User $user)
    {
        if ($user->email_verified_at) {
            return redirect()->route('users.index')->with('error', 'This user has already verified their email.');
        }

        // Generate a temporary password
        $temporaryPassword = Str::random(12);
        $user->update([
            'password' => Hash::make($temporaryPassword),
        ]);

        try {
            // Send email notification
            $user->notify(new \App\Notifications\UserAccountCreated($temporaryPassword));

            // Log the email
            EmailLog::create([
                'sent_by' => Auth::id(),
                'recipient_email' => $user->email,
                'recipient_name' => $user->name,
                'recipient_type' => 'user',
                'recipient_id' => $user->id,
                'subject' => 'Your Account Has Been Created',
                'body' => "Hello {$user->name},\n\nYour account has been created successfully.\nYour temporary password is: {$temporaryPassword}\n\nPlease use the link in your email to set up your permanent password.\n\nThis link will expire in 48 hours.",
                'purpose' => 'Account Setup Email',
                'status' => 'sent',
                'sent_at' => now(),
            ]);

            return redirect()->route('users.index')->with('success', 'Setup email sent successfully to ' . $user->email);
        } catch (\Exception $e) {
            // Log failed email
            EmailLog::create([
                'sent_by' => Auth::id(),
                'recipient_email' => $user->email,
                'recipient_name' => $user->name,
                'recipient_type' => 'user',
                'recipient_id' => $user->id,
                'subject' => 'Your Account Has Been Created',
                'body' => "Hello {$user->name},\n\nYour account has been created successfully.\nYour temporary password is: {$temporaryPassword}\n\nPlease use the link in your email to set up your permanent password.\n\nThis link will expire in 48 hours.",
                'purpose' => 'Account Setup Email',
                'status' => 'failed',
                'error_message' => $e->getMessage(),
                'sent_at' => now(),
            ]);

            return redirect()->route('users.index')->with('error', 'Failed to send setup email: ' . $e->getMessage());
        }
    }

    public function show(User $user)
    {
        $user->load('roles.permissions');

        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('name')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'status' => ['required', 'in:active,inactive'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['exists:roles,name'],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->roles ? $request->roles[0] : null,
            'status' => $request->status,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Sync roles
        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        } else {
            $user->syncRoles([]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Prevent deleting own account
        if ($user->id === auth()->user()->id) {
            return redirect()->route('users.index')->with('error', 'You cannot delete your own account.');
        }

        $user->update(['deleted' => true]);

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
