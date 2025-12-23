@extends('admin.layout.app')
@section('title', 'System Permissions')

@section('content')
<style>
    .content-wrapper { background-color: var(--secondary-color) !important; }
    .page-title { color: var(--primary-color); font-weight: 800; }

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

    .permission-name { font-weight: 700; color: #334155; font-size: 15px; }

    /* Action Buttons */
    .btn-action-sm {
        width: 35px; height: 35px; border-radius: 8px;
        display: inline-flex; align-items: center; justify-content: center;
        border: none; transition: 0.3s;
    }
</style>

<div class="content-header px-4 pt-4">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6 text-start">
                <h1 class="page-title"><i class="fas fa-key me-2 text-primary"></i> Permissions</h1>
                <p class="text-muted small mb-0 mt-1">Manage individual system access capabilities.</p>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('permissions.create') }}" class="btn-create-custom">
                    <i class="fas fa-plus-circle me-1"></i> Create Permission
                </a>
            </div>
        </div>
    </div>
</div>

<section class="content px-4">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 mt-3">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="modern-card">
            <div class="table-responsive">
                <table class="table modern-table mb-0">
                    <thead>
                        <tr>
                            <th>Permission Name</th>
                            <th class="text-center">Action Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td class="permission-name">
                                    <i class="fas fa-lock-open me-2 opacity-50 text-primary" style="font-size: 12px;"></i>
                                    {{ $permission->name }}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn-action-sm" style="background-color: #ffc107; color: #000;" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-sm" style="background-color: #dc3545; color: #fff;" onclick="return confirm('Delete this permission?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 border-top">
                {{ $permissions->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</section>
@endsection