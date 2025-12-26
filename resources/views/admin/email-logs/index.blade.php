@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Email Logs</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Email Logs</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Email Logs</h3>
                    </div>

                    <!-- Filters -->
                    <div class="card-body">
                        <form method="GET" action="{{ route('email-logs.index') }}" class="mb-3">
                            <div class="row">
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
                                        <option value="customer"
                                            {{ request('recipient_type') == 'customer' ? 'selected' : '' }}>Customer
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
                                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Sent By</th>
                                        <th>Recipient</th>
                                        <th>Type</th>
                                        <th>Subject</th>
                                        <th>Purpose</th>
                                        <th>Status</th>
                                        <th>Sent At</th>
                                        <th style="width: 100px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($emailLogs as $log)
                                        <tr>
                                            <td>{{ $log->id }}</td>
                                            <td>
                                                @if ($log->sender)
                                                    {{ $log->sender->name }}
                                                @else
                                                    <span class="text-muted">System</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div>{{ $log->recipient_name }}</div>
                                                <small class="text-muted">{{ $log->recipient_email }}</small>
                                            </td>
                                            <td>
                                                @if ($log->recipient_type)
                                                    <span
                                                        class="badge badge-{{ $log->recipient_type == 'user' ? 'primary' : 'info' }}">
                                                        {{ ucfirst($log->recipient_type) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ Str::limit($log->subject, 40) }}</td>
                                            <td>{{ $log->purpose }}</td>
                                            <td>
                                                @if ($log->status == 'sent')
                                                    <span class="badge badge-success">Sent</span>
                                                @elseif($log->status == 'failed')
                                                    <span class="badge badge-danger">Failed</span>
                                                @else
                                                    <span class="badge badge-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($log->sent_at)
                                                    {{ $log->sent_at->format('M d, Y H:i') }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('email-logs.show', $log->id) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">No email logs found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer clearfix">
                        {{ $emailLogs->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
