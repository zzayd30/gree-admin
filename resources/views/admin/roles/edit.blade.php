@extends('admin.layout.app')
@section('title', 'Edit Role')

@section('content')
<style>
    /* Background setup */
    .content-wrapper {
        background-color: var(--secondary-color) !important;
    }

    .page-title {
        color: var(--primary-color);
        font-weight: 800;
    }

    /* Modern Form Card */
    .form-card {
        background: #ffffff;
        border: none;
        border-radius: 25px;
        box-shadow: 0 15px 35px rgba(36, 58, 127, 0.08);
        padding: 40px;
        border-top: 5px solid #243a7f;
    }

    .form-label {
        font-weight: 700;
        color: #243a7f;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
    }

    /* Custom Input Styling */
    .custom-input {
        border-radius: 12px !important;
        padding: 14px 18px !important;
        border: 1px solid #e2e8f0 !important;
        background-color: #f8fafc !important;
    }

    .custom-input:focus {
        border-color: #243a7f !important;
        box-shadow: 0 0 0 4px rgba(36, 58, 127, 0.1) !important;
        background-color: #fff !important;
    }

    /* Permission Tile Styling (Using Label for better click) */
    .permission-tile {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 15px;
        transition: 0.3s;
        cursor: pointer;
        display: flex;
        align-items: center;
        width: 100%;
    }

    .permission-tile:hover {
        border-color: #243a7f;
        background-color: #e3e6ef;
    }

    .form-check-input {
        width: 1.3em !important;
        height: 1.3em !important;
        cursor: pointer;
        margin-right: 12px !important;
        margin-top: 0 !important;
        margin-left: 0 !important;
    }
    
    .form-check-input:checked {
        background-color: #243a7f !important;
        border-color: #243a7f !important;
    }

    .permission-label {
        font-weight: 600;
        color: #475569;
        cursor: pointer;
        margin-bottom: 0;
        margin-left: 30px;
    }
</style>

<div class="content-header px-4 pt-4">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6 text-start">
                <h1 class="page-title"><i class="fas fa-edit me-2"></i> Edit Role: {{ $role->name }}</h1>
                <p class="text-muted small mb-0 mt-1">Modify access levels and permissions for this role.</p>
            </div>
        </div>
    </div>
</div>

<section class="content px-4 mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <div class="form-card">
                    <form method="POST" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Role Name -->
                        <div class="mb-5">
                            <label class="form-label">Update Role Name</label>
                            <input type="text" name="name" class="form-control custom-input" 
                                   placeholder="Role Name" value="{{ old('name', $role->name) }}" required>
                            <x-input-error :messages="$errors->get('name')" class="text-danger small mt-2 ml-1"/>
                        </div>

                        <!-- Permissions Grid -->
                        <div class="mb-4">
                            <label class="form-label d-block border-bottom pb-3 mb-4 text-muted">Modify Permissions</label>
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="col-md-4">
                                        <!-- Div ki jagah Label use kiya ha taake tiles par bhi click ho -->
                                        <label class="permission-tile">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" 
                                                   value="{{ $permission->name }}" 
                                                   @checked(in_array($permission->name, $rolePermissions))>
                                            <span class="permission-label">
                                                {{ $permission->name }}
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Form Actions - Fixed with Inline Styles -->
                        <div class="mt-5 pt-4 border-top d-flex align-items-center">
                            <button type="submit" 
                                    style="background-color: #243a7f !important; 
                                           color: white !important; 
                                           padding: 14px 35px !important; 
                                           border-radius: 12px !important; 
                                           font-weight: 700 !important; 
                                           border: none !important; 
                                           opacity: 1 !important; 
                                           visibility: visible !important;
                                           box-shadow: 0 5px 15px rgba(36, 58, 127, 0.3) !important;
                                           cursor: pointer !important;">
                                <i class="fas fa-save me-2"></i> Update Role Settings
                            </button>
                            
                            <a href="{{ route('roles.index') }}" 
                               style="color: #64748b !important; 
                                      text-decoration: none !important; 
                                      font-weight: 600 !important; 
                                      margin-left: 25px !important;">
                                <i class="fas fa-arrow-left me-1"></i> Back to List
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection