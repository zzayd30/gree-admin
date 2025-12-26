<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TroubleshootErrorCode;
use App\Models\TroubleshootStep;
use Illuminate\Http\Request;

class TroubleshootStepController extends Controller
{
    public function create(TroubleshootErrorCode $troubleshoot)
    {
        return view('admin.troubleshoots.steps.create', compact('troubleshoot'));
    }

    public function store(Request $request, TroubleshootErrorCode $troubleshoot)
    {
        $validated = $request->validate([
            'step_number' => 'required|integer|min:1',
            'action' => 'required|string',
            'sensor_type' => 'required|string|max:255',
            'tips' => 'nullable|array',
            'tips.*' => 'nullable|string',
        ]);

        // Filter out empty tips
        if (isset($validated['tips'])) {
            $validated['tips'] = array_filter($validated['tips'], function($tip) {
                return !empty(trim($tip));
            });
            $validated['tips'] = array_values($validated['tips']); // Re-index array
        }

        $validated['troubleshoot_error_code_id'] = $troubleshoot->id;

        TroubleshootStep::create($validated);

        return redirect()->route('troubleshoots.show', $troubleshoot->id)
            ->with('success', 'Step added successfully.');
    }

    public function edit(TroubleshootErrorCode $troubleshoot, TroubleshootStep $step)
    {
        return view('admin.troubleshoots.steps.edit', compact('troubleshoot', 'step'));
    }

    public function update(Request $request, TroubleshootErrorCode $troubleshoot, TroubleshootStep $step)
    {
        $validated = $request->validate([
            'step_number' => 'required|integer|min:1',
            'action' => 'required|string',
            'tips' => 'nullable|array',
            'tips.*' => 'nullable|string',
        ]);

        // Filter out empty tips
        if (isset($validated['tips'])) {
            $validated['tips'] = array_filter($validated['tips'], function($tip) {
                return !empty(trim($tip));
            });
            $validated['tips'] = array_values($validated['tips']); // Re-index array
        }

        $step->update($validated);

        return redirect()->route('troubleshoots.show', $troubleshoot->id)
            ->with('success', 'Step updated successfully.');
    }

    public function destroy(TroubleshootErrorCode $troubleshoot, TroubleshootStep $step)
    {
        $step->delete();

        return redirect()->route('troubleshoots.show', $troubleshoot->id)
            ->with('success', 'Step deleted successfully.');
    }
}
