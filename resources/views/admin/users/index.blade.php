@extends('admin.layout.app')
@section('title', 'Users Management')

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

        .user-role-badge {
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
                    <h1 class="page-title"><i class="fas fa-users-cog me-2"></i> Users Management</h1>
                    <p class="text-muted small mb-0 mt-1">Manage system administrators and user access.</p>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('users.create') }}" class="btn-create-custom">
                        <i class="fas fa-user-plus me-1"></i> Create New User
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
                                <th>Assigned Roles</th>
                                <th>Status</th>
                                <th>Joined Date</th>
                                <th class="text-center">Action Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="text-muted">#{{ $user->id }}</td>
                                    <td>
                                        <div class="fw-bold text-dark" style="font-size: 15px;">{{ $user->name }}</div>
                                        <div class="text-muted small">{{ $user->email }}</div>
                                    </td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            <span class="user-role-badge">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($user->status == 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-muted small">{{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            @if (!$user->email_verified_at)
                                                <form action="{{ route('users.send-setup-email', $user->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn-action-sm"
                                                        style="background-color: #10b981; color: #fff;"
                                                        title="Send Setup Email">
                                                        <i class="fas fa-envelope"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('users.show', $user->id) }}" class="btn-action-sm"
                                                style="background-color: #17a2b8; color: #fff;" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if ($user->id !== 1)
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn-action-sm"
                                                    style="background-color: #ffc107; color: #000;" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif
                                            @if ($user->id !== auth()->id())
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-action-sm"
                                                        style="background-color: #dc3545; color: #fff;"
                                                        onclick="confirmDelete(event, 'This user will be deleted!')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="fas fa-folder-open me-2"></i> No Users Available.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-4 py-3 border-top">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection
