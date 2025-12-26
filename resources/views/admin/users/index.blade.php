@extends('admin.layout.app')
@section('title', 'Users Management')

@section('content')
<style>
    .content-wrapper { background-color: var(--secondary-color) !important; }
    .page-title { color: var(--primary-color); font-weight: 800; }

    /* 1. Sharp Edges - Sab kuch square (No border radius) */
    
    /* 4. Custom Badges & Buttons (Sharp) */
    .user-role-badge {
        background-color: var(--primary-color-light);
        color: var(--primary-color);
        padding: 4px 10px;
        font-size: 11px;
        font-weight: 700;
        border: 0;
    }

    .btn-action-sm {
        width: 35px; height: 35px; 
        display: inline-flex; align-items: center; justify-content: center;
        border: none; transition: 0.3s; margin: 0 2px;
    }

    /* Create User Button Specific */
    .btn-create-custom {
        background-color: #243a7f !important;
        color: white !important;
        padding: 12px 25px !important;
        font-weight: 700 !important;
        border: none !important;
        box-shadow: 0 4px 12px rgba(36, 58, 127, 0.2) !important;
    }
</style>
<div class="content-header px-4 pt-4">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6 text-start">
                <h1 class="page-title"><i class="fas fa-users-cog me-2"></i> Users Management</h1>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('users.create') }}" class="btn-create-custom">
                    <i class="fas fa-user-plus me-1"></i> Create New User
                </a>
            </div>
        </div>
    </div>
</div>

<section class="content px-4">
    <div class="container-fluid">
        <div class="modern-card">
            <div class="table-responsive">
                <table class="table modern-table mb-0 border-0">
                    <thead>
                        <tr>
                            <th style="border-radius: 0px !important;">ID</th>
                            <th>Name & Email</th>
                            <th>Assigned Roles</th>
                            <th>Status</th>
                            <th>Joined Date</th>
                            <th class="text-center" style="border-radius: 0px !important;">Action Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
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
                                <td><span class="badge bg-success" style="border-radius: 0px;">Active</span></td>
                                <td class="text-muted small">{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('users.show', $user->id) }}" class="btn-action-sm" style="background-color: #17a2b8; color: #fff;"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn-action-sm" style="background-color: #ffc107; color: #000;"><i class="fas fa-edit"></i></a>
                                        <button class="btn-action-sm" style="background-color: #dc3545; color: #fff;"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection