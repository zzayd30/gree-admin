<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TroubleshootErrorCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TroubleshootErrorCodeController extends Controller
{
    public function index()
    {
        $troubleshoots = TroubleshootErrorCode::with('creator')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.troubleshoots.index', compact('troubleshoots'));
    }

    public function create()
    {
        return view('admin.troubleshoots.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['created_by'] = Auth::id();

        TroubleshootErrorCode::create($validated);

        return redirect()->route('troubleshoots.index')
            ->with('success', 'Troubleshoot error code created successfully.');
    }

    public function show(TroubleshootErrorCode $troubleshoot)
    {
        $troubleshoot->load('steps', 'creator');
        return view('admin.troubleshoots.show', compact('troubleshoot'));
    }

    public function edit(TroubleshootErrorCode $troubleshoot)
    {
        return view('admin.troubleshoots.edit', compact('troubleshoot'));
    }

    public function update(Request $request, TroubleshootErrorCode $troubleshoot)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $troubleshoot->update($validated);

        return redirect()->route('troubleshoots.index')
            ->with('success', 'Troubleshoot error code updated successfully.');
    }

    public function destroy(TroubleshootErrorCode $troubleshoot)
    {
        $troubleshoot->steps()->delete(); // Delete associated steps
        $troubleshoot->delete();

        return redirect()->route('troubleshoots.index')
            ->with('success', 'Troubleshoot error code deleted successfully.');
    }
}
