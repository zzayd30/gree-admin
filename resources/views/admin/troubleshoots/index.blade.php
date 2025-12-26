@extends('admin.layout.app')
@section('title', 'Troubleshoot Error Codes')

@section('content')
    <style>
        .content-wrapper {
            background-color: var(--secondary-color) !important;
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 800;
        }

        /* Button Fix */
        .btn-create-custom {
            background-color: #243a7f !important;
            color: white !important;
            padding: 10px 25px !important;
            border-radius: 12px !important;
            font-weight: 700 !important;
            display: inline-block !important;
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

        /* Table Header Force Blue */
        .modern-table thead th {
            background-color: #243a7f !important;
            color: #ffffff !important;
            padding: 20px 25px !important;
            font-size: 13px !important;
            text-transform: uppercase !important;
            border: none !important;
        }

        .modern-table tbody td {
            padding: 18px 25px !important;
            vertical-align: middle !important;
            border-bottom: 1px solid #f1f4f8 !important;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .bg-active {
            background-color: #d1fae5;
            color: #065f46;
        }

        .bg-inactive {
            background-color: #f1f5f9;
            color: #64748b;
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
                    <h1 class="page-title"><i class="fas fa-tools me-2"></i> Troubleshoot Error Codes</h1>
                    <p class="text-muted small mb-0 mt-1">Manage diagnostic procedures and error codes.</p>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('troubleshoots.create') }}" class="btn-create-custom">
                        <i class="fas fa-plus me-1"></i> Create New Code
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
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th class="text-center">Action Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($troubleshoots as $troubleshoot)
                                <tr>
                                    <td class="text-muted">#{{ $troubleshoot->id }}</td>
                                    <td>
                                        <div class="fw-bold text-dark" style="font-size: 15px;">{{ $troubleshoot->name }}
                                        </div>
                                    </td>
                                    <td>
                                        @if ($troubleshoot->status == 'active')
                                            <span class="status-badge bg-active">Active</span>
                                        @else
                                            <span class="status-badge bg-inactive">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-muted">{{ $troubleshoot->creator->name ?? 'N/A' }}</td>
                                    <td class="text-muted small">{{ $troubleshoot->created_at->format('M d, Y') }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('troubleshoots.show', $troubleshoot->id) }}"
                                                class="btn-action-sm" style="background-color: #17a2b8; color: #fff;"
                                                title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('troubleshoots.edit', $troubleshoot->id) }}"
                                                class="btn-action-sm" style="background-color: #ffc107; color: #000;"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('troubleshoots.destroy', $troubleshoot->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-sm"
                                                    style="background-color: #dc3545; color: #fff;"
                                                    onclick="confirmDelete(event, 'This troubleshoot error code will be deleted!')"
                                                    title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="fas fa-folder-open me-2"></i> No Troubleshoot Error Codes Available.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-4 py-3 border-top">
                    {{ $troubleshoots->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection
