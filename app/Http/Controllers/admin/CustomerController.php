<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\TypeOfBusiness;
use App\Notifications\CustomerAccountCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class CustomerController extends Controller
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
        $customers = Customer::where('deleted', false)->paginate(10);

        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        $type_of_business = TypeOfBusiness::where('deleted', false)
            ->orderBy('name')
            ->get();

        return view('admin.customers.create', compact('type_of_business'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'phone' => ['required', 'string', 'max:20'],
            'company' => ['nullable', 'string', 'max:255'],
            'type_of_business' => ['nullable', 'exists:type_of_business,id'],
            'password' => ['required', Rules\Password::defaults()],
            'status' => ['required', 'in:active,inactive'],
            'send_email' => ['nullable', 'boolean'],
        ]);

        // Store the plain password for email
        $plainPassword = $request->password;

        // Determine status: if send_email is checked, set to inactive; otherwise use selected status
        $customerStatus = $request->has('send_email') ? 'inactive' : $request->status;

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'type_of_business_id' => $request->type_of_business,
            'status' => $customerStatus,
            'create_by_admin' => true,
            'password' => Hash::make($plainPassword),
        ]);

        // Send email if checkbox is checked
        if ($request->has('send_email')) {
            $customer->notify(new CustomerAccountCreated($plainPassword));
        }

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    public function show(Customer $customer)
    {
        return view('admin.customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        $type_of_business = TypeOfBusiness::where('deleted', false)
            ->orderBy('name')
            ->get();

        return view('admin.customers.edit', compact('customer', 'type_of_business'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers,email,'.$customer->id],
            'company' => ['nullable', 'string', 'max:255'],
            'type_of_business' => ['nullable', 'exists:type_of_business,id'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'company' => $request->company,
            'type_of_business_id' => $request->type_of_business,
            'status' => $request->status,
        ]);

        if ($request->filled('password')) {
            $customer->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->update(['deleted' => true]);

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
