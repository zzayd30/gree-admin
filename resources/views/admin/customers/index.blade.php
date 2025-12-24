@extends('admin.layout.app')
@section('title', 'Customers Management')

@section('content')
    <style>
        .content-wrapper {
            background-color: var(--secondary-color) !important;
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 800;
        }

        /* Button Fix (Always Visible) */
        .btn-create-custom {
            background-color: #243a7f !important;
            color: white !important;
            padding: 10px 25px !important;
            border-radius: 12px !important;
            font-weight: 700 !important;
            display: inline-block !important;
            opacity: 1 !important;
            visibility: visible !important;
            text-decoration: none !important;
            box-shadow: 0 4px 12px rgba(36, 58, 127, 0.2) !important;
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

        .customer-status-badge {
            background-color: var(--primary-color-light);
            color: var(--primary-color);
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
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
    </style>

    <div class="content-header px-4 pt-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6 text-start">
                    <h1 class="page-title"><i class="fas fa-users me-2"></i> Customers Management</h1>
                    <p class="text-muted small mb-0 mt-1">Manage customers and their accounts.</p>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('customers.create') }}" class="btn-create-custom">
                        <i class="fas fa-user-plus me-1"></i> Create New Customer
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="modern-card shadow-sm">
                <div class="table-responsive">
                    <table class="table modern-table mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name & Email</th>
                                <th>Company</th>
                                <th>Status</th>
                                <th>Created By Admin</th>
                                <th>Joined Date</th>
                                <th class="text-center">Action Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse  ($customers as $customer)
                                <tr>
                                    <td class="text-muted">#{{ $customer->id }}</td>
                                    <td>
                                        <div class="fw-bold text-dark" style="font-size: 15px;">{{ $customer->name }}</div>
                                        <div class="text-muted small">{{ $customer->email }}</div>
                                    </td>
                                    <td class="text-muted">{{ $customer->company ?? 'N/A' }}</td>
                                    <td>
                                        @if ($customer->status == 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($customer->create_by_admin)
                                            <span class="badge bg-primary">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                    <td class="text-muted small">{{ $customer->created_at->format('M d, Y') }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('customers.show', $customer->id) }}" class="btn-action-sm"
                                                style="background-color: #17a2b8; color: #fff;" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn-action-sm"
                                                style="background-color: #ffc107; color: #000;" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-action-sm"
                                                    style="background-color: #dc3545; color: #fff;"
                                                    onclick="return confirm('Delete this customer?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fas fa-folder-open me-2"></i> No Customers Available.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-4 py-3 border-top">
                    {{ $customers->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection
