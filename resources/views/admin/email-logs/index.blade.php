@extends('admin.layout.app')
@section('title', 'Email Logs')

@section('content')
    <style>
        .content-wrapper {
            background-color: var(--secondary-color) !important;
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 800;
        }

        .modern-card {
            background: #ffffff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-top: 20px;
        }

        /* Table Header Fix */
        .modern-table thead th {
            background-color: #243a7f !important;
            color: #ffffff !important;
            padding: 20px 25px !important;
            font-size: 13px !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none !important;
        }

        .modern-table tbody td {
            padding: 18px 25px !important;
            vertical-align: middle;
            border-bottom: 1px solid #f1f4f8 !important;
        }

        .btn-action-sm {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            transition: 0.3s;
            margin: 0 2px;
        }

        .filter-section {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>

    <div class="content-header px-4 pt-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6 text-start">
                    <h1 class="page-title"><i class="fas fa-envelope-open-text me-2"></i> Email Logs</h1>
                    <p class="text-muted small mb-0 mt-1">Track all email communications sent from the system.</p>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <!-- Filters -->
            <div class="filter-section">
                <form method="GET" action="{{ route('email-logs.index') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search email, name, subject..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2">
                            <select name="status" class="form-control">
                                <option value="">All Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="sent" {{ request('status') == 'sent' ? 'selected' : '' }}>Sent
                                </option>
                                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="recipient_type" class="form-control">
                                <option value="">All Types</option>
                                <option value="user" {{ request('recipient_type') == 'user' ? 'selected' : '' }}>
                                    User</option>
                                <option value="customer" {{ request('recipient_type') == 'customer' ? 'selected' : '' }}>
                                    Customer
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="date" name="date_from" class="form-control" placeholder="From Date"
                                value="{{ request('date_from') }}">
                        </div>
                        <div class="col-md-2">
                            <input type="date" name="date_to" class="form-control" placeholder="To Date"
                                value="{{ request('date_to') }}">
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modern-card shadow-sm">
                <div class="table-responsive">
                    <table class="table modern-table mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sent By</th>
                                <th>Recipient</th>
                                <th>Type</th>
                                <th>Subject</th>
                                <th>Purpose</th>
                                <th>Status</th>
                                <th>Sent At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($emailLogs as $log)
                                <tr>
                                    <td class="text-muted">#{{ $log->id }}</td>
                                    <td>
                                        @if ($log->sender)
                                            <div class="fw-bold text-dark">{{ $log->sender->name }}</div>
                                        @else
                                            <span class="text-muted small">System</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark" style="font-size: 14px;">{{ $log->recipient_name }}
                                        </div>
                                        <div class="text-muted small">{{ $log->recipient_email }}</div>
                                    </td>
                                    <td>
                                        @if ($log->recipient_type)
                                            <span
                                                class="badge {{ $log->recipient_type == 'user' ? 'bg-primary' : 'bg-info' }}">
                                                {{ ucfirst($log->recipient_type) }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($log->subject, 40) }}</td>
                                    <td><span class="text-muted small">{{ $log->purpose }}</span></td>
                                    <td>
                                        @if ($log->status == 'sent')
                                            <span class="badge bg-success">Sent</span>
                                        @elseif($log->status == 'failed')
                                            <span class="badge bg-danger">Failed</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td class="text-muted small">
                                        @if ($log->sent_at)
                                            {{ $log->sent_at->format('M d, Y H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('email-logs.show', $log->id) }}" class="btn-action-sm"
                                            style="background-color: #17a2b8; color: #fff;" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-4">
                                        <i class="fas fa-folder-open me-2"></i> No Email Logs Available.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-4 py-3 border-top">
                    {{ $emailLogs->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection
