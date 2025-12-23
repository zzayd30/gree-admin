@extends('admin.layout.app')
@section('title', 'Create New User')

@section('content')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .content-wrapper {
        background-color: var(--secondary-color) !important;
    }

    .page-title {
        color: var(--primary-color);
        font-weight: 800;
    }

    .form-card {
        background: #ffffff;
        border: none;
        border-radius: 25px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(36, 58, 127, 0.08);
        border-top: 5px solid #243a7f;
    }

    .form-label {
        font-weight: 700;
        color: #243a7f;
        text-transform: uppercase;
        font-size: 12px;
        margin-bottom: 8px;
    }

    .custom-input {
        border-radius: 12px !important;
        padding: 12px 15px !important;
        border: 1px solid #e2e8f0 !important;
        background-color: #f8fafc !important;
        width: 100%;
    }

    /* Select2 Modern Design to match your inputs */
    .select2-container--default .select2-selection--single {
        border-radius: 12px !important;
        height: 50px !important;
        padding: 10px !important;
        border: 1px solid #e2e8f0 !important;
        background-color: #f8fafc !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 48px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 28px;
    }

    .select2-dropdown {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    }

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

    .role-tile:hover {
        border-color: #243a7f;
        background-color: #e3e6ef;
    }

    .form-check-input {
        position: static !important;
        width: 1.3em !important;
        height: 1.3em !important;
        margin: 0 !important;
        cursor: pointer;
        flex-shrink: 0;
    }

    .role-name-text {
        margin-left: 15px !important;
        font-weight: 600;
        color: #334155;
        white-space: nowrap;
    }

    .btn-submit-custom {
        background-color: #243a7f !important;
        color: white !important;
        padding: 14px 35px !important;
        border-radius: 12px !important;
        font-weight: 700;
        border: none !important;
        box-shadow: 0 5px 15px rgba(36, 58, 127, 0.3) !important;
    }
</style>

<div class="content-header px-4 pt-4">
    <div class="container-fluid">
        <h1 class="page-title text-start"><i class="fas fa-user-plus me-2"></i> Create New User</h1>
    </div>
</div>

<section class="content px-4">
    <div class="container-fluid">
        <div class="form-card">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-4 text-start">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control custom-input" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-6 mb-4 text-start">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control custom-input" value="{{ old('email') }}" required>
                    </div>
                    {{-- <div class="col-md-6 mb-4 text-start">
                        <label class="form-label">Company Name</label>
                        <input type="text" name="company" class="form-control custom-input" value="{{ old('company') }}" required>
                    </div> --}}
                    {{-- <div class="col-md-6 mb-4 text-start">
                        <label class="form-label">Type of Business</label>
                        <select name="type_of_business" id="search_business" class="form-select select2 shadow-none" required>
                            <option value="" disabled selected>Search Business Type...</option>
                            @foreach ($type_of_business as $bt)
                            <option value="{{ $bt->id }}" {{ old('type_of_business') == $bt->id ? 'selected' : '' }}>{{ $bt->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="col-md-6 mb-4 text-start">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control custom-input" required>
                    </div>
                    <div class="col-md-6 mb-4 text-start">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control custom-input" required>
                    </div>
                </div>

                <div class="mb-4 text-start">
                    <label class="form-label d-block border-bottom pb-2 mb-3">Assign User Roles</label>
                    <div class="row">
                        @foreach ($roles as $role)
                        <div class="col-md-4 mb-3">
                            <label class="role-tile">
                                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}">
                                <span class="role-name-text">{{ $role->name }}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4 text-start border-top pt-4">
                    <button type="submit" class="btn-submit-custom">Create User Account</button>
                    <a href="{{ route('users.index') }}" class="ms-3 text-muted fw-bold text-decoration-none">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- jQuery and Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search_business').select2({
            placeholder: "Search Business Type...",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endsection