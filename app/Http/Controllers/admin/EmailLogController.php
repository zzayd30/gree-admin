<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailLog;
use Illuminate\Http\Request;

class EmailLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:View Email Logs')->only(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = EmailLog::with('sender');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by recipient type
        if ($request->filled('recipient_type')) {
            $query->where('recipient_type', $request->recipient_type);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('sent_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('sent_at', '<=', $request->date_to);
        }

        // Search by email or name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('recipient_email', 'like', "%{$search}%")
                  ->orWhere('recipient_name', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $emailLogs = $query->latest('sent_at')->paginate(20);

        return view('admin.email-logs.index', compact('emailLogs'));
    }

    public function show(EmailLog $emailLog)
    {
        $emailLog->load('sender');
        
        return view('admin.email-logs.show', compact('emailLog'));
    }
}
