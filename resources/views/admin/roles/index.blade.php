@extends('admin.layout.app')
@section('title', 'Roles Management')

@section('content')
    <style>
        /* Global Background Fix */
        .content-wrapper {
            background-color: var(--secondary-color) !important;
        }

        /* Table Header Force Fix */
        /* .roles-card {
            background: #ffffff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            margin-top: 30px;
            overflow: hidden;
        } */

        

        /* Permission Pills */
        .permission-badge {
            display: inline-block;
            background-color: #e3e6ef;
            color: #243a7f;
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            margin: 3px;
            border: 1px solid rgba(36, 58, 127, 0.1);
        }

        /* Action Buttons */
        .btn-custom-action {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            transition: 0.2s;
        }
    </style>

    <div class="content-header px-4 pt-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 style="color: #243a7f; font-weight: 800; margin: 0;">
                        <i class="fas fa-user-tag me-2"></i> Roles Management
                    </h1>
                    <p class="text-muted small mb-0 mt-1">Gree Pakistan - System Access Control</p>
                </div>
                <div class="col-sm-6 text-end">
                    <!-- INLINE STYLES: Ye styles koi bhi framework override nahi kar sakta -->
                    <a href="{{ route('roles.create') }}"
                        style="background-color: #243a7f !important; 
                          color: white !important; 
                          display: inline-block !important; 
                          padding: 12px 25px !important; 
                          border-radius: 12px !important; 
                          font-weight: 700 !important; 
                          opacity: 1 !important; 
                          visibility: visible !important; 
                          text-decoration: none !important;
                          box-shadow: 0 4px 15px rgba(36, 58, 127, 0.3) !important;">
                        <i class="fas fa-plus-circle me-2"></i> Create New Role
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="content px-4">
        <div class="container-fluid">

            <div class="roles-card shadow-sm">
                <div class="table-responsive">
                    <table class="table modern-table mb-0">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Permissions Allowed</th>
                                <th class="text-center">Action Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="fw-bold text-dark">{{ $role->name }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap">
                                            @foreach ($role->permissions as $permission)
                                                <span class="permission-badge">
                                                    <i class="fas fa-check me-1"></i> {{ $permission->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('roles.edit', $role->id) }}" class="btn-custom-action"
                                                style="background-color: #ffc107; color: #000;" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-custom-action"
                                                    style="background-color: #dc3545; color: #fff;"
                                                    onclick="confirmDelete(event, 'This role will be deleted!')">
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
            </div>
        </div>
    </section>
@endsection
