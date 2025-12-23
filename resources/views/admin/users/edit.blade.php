@extends('admin.layout.app')
@section('title', 'Edit User Account')

@section('content')
<style>
    .content-wrapper { background-color: var(--secondary-color) !important; }
    .page-title { color: var(--primary-color); font-weight: 800; }
    
    .form-card {
        background: #ffffff; border: none; border-radius: 25px;
        padding: 40px; box-shadow: 0 15px 35px rgba(36, 58, 127, 0.08);
        border-top: 5px solid #243a7f;
    }
    .form-label { font-weight: 700; color: #243a7f; text-transform: uppercase; font-size: 12px; margin-bottom: 8px; }
    .custom-input { border-radius: 12px !important; padding: 12px 15px !important; border: 1px solid #e2e8f0 !important; background-color: #f8fafc !important; width: 100%; }
    
    /* ROLES SECTION FIX - Wahi jo Create page par kaam kar gaya */
    .role-tile {
        background: #f8fafc; 
        border: 1px solid #e2e8f0; 
        border-radius: 12px;
        padding: 15px 20px !important; 
        cursor: pointer;
        display: flex !important; 
        align-items: center !important; 
        transition: 0.3s;
        height: 100%;
        margin-bottom: 0;
        position: relative;
    }
    .role-tile:hover { border-color: #243a7f; background-color: #e3e6ef; }
    
    /* Checkbox Position Fix */
    .form-check-input { 
        position: static !important; /* AdminLTE ki absolute position khatam karne ke liye */
        width: 1.3em !important; 
        height: 1.3em !important; 
        margin: 0 !important; 
        cursor: pointer;
        flex-shrink: 0;
    }
    .role-name-text {
        margin-left: 15px !important; /* Checkbox aur text ke darmiyan gap */
        font-weight: 600;
        color: #334155;
        white-space: nowrap; 
    }

    .btn-submit-custom {
        background-color: #243a7f !important; color: white !important;
        padding: 14px 35px !important; border-radius: 12px !important;
        font-weight: 700 !important; border: none !important;
        box-shadow: 0 5px 15px rgba(36, 58, 127, 0.3) !important;
        opacity: 1 !important; visibility: visible !important;
    }
</style>

<div class="content-header px-4 pt-4">
    <div class="container-fluid">
        <h1 class="page-title text-start"><i class="fas fa-user-edit me-2"></i> Edit User: {{ $user->name }}</h1>
    </div>
</div>

<section class="content px-4">
    <div class="container-fluid">
        <div class="form-card">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Full Name -->
                    <div class="col-md-6 mb-4 text-start">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control custom-input" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <!-- Email -->
                    <div class="col-md-6 mb-4 text-start">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control custom-input" value="{{ old('email', $user->email) }}" required>
                    </div>
                    <!-- Company -->
                    <div class="col-md-6 mb-4 text-start">
                        <label class="form-label">Company Name</label>
                        <input type="text" name="company" class="form-control custom-input" value="{{ old('company', $user->company) }}" required>
                    </div>
                    <!-- Business Type -->
                    <div class="col-md-6 mb-4 text-start">
                        <label class="form-label">Type of Business</label>
                        <select name="type_of_business" class="form-select custom-input shadow-none" required>
                            @foreach ($type_of_business as $bt)
                                <option value="{{ $bt->id }}" {{ old('type_of_business', $user->type_of_business_id) == $bt->id ? 'selected' : '' }}>{{ $bt->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Password Fields -->
                    <div class="col-md-6 mb-4 text-start">
                        <label class="form-label">Password (Blank to keep current)</label>
                        <input type="password" name="password" class="form-control custom-input">
                    </div>
                    <div class="col-md-6 mb-4 text-start">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control custom-input">
                    </div>
                </div>

                <!-- FIXED ROLES SECTION FOR EDIT -->
                <div class="mb-4 text-start">
                    <label class="form-label d-block border-bottom pb-2 mb-3">Update User Roles</label>
                    <div class="row">
                        @foreach ($roles as $role)
                            <div class="col-md-4 mb-3">
                                <label class="role-tile">
                                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" 
                                    {{ in_array($role->name, old('roles', $userRoles)) ? 'checked' : '' }}>
                                    <span class="role-name-text">{{ $role->name }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="mt-4 text-start border-top pt-4">
                    <button type="submit" class="btn-submit-custom">Update User Profile</button>
                    <a href="{{ route('users.index') }}" class="ms-3 text-muted fw-bold text-decoration-none">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection