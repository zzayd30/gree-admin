@extends('admin.layout.app')
@section('title', 'Edit Permission')

@section('content')
<style>
    .content-wrapper { background-color: var(--secondary-color) !important; }
    
    .form-card {
        background: #ffffff;
        border: none;
        border-radius: 25px;
        box-shadow: 0 15px 35px rgba(36, 58, 127, 0.08);
        padding: 40px;
        border-top: 5px solid #243a7f;
        max-width: 700px;
    }

    .form-label { font-weight: 700; color: #243a7f; text-transform: uppercase; font-size: 13px; margin-bottom: 12px; }

    .custom-input {
        border-radius: 12px !important;
        padding: 14px 18px !important;
        border: 1px solid #e2e8f0 !important;
        background-color: #f8fafc !important;
    }

    /* Solid Blue Button */
    .btn-update {
        background-color: #243a7f !important;
        color: white !important;
        padding: 14px 35px !important;
        border-radius: 12px !important;
        font-weight: 700 !important;
        border: none !important;
        display: inline-block !important;
        opacity: 1 !important;
        visibility: visible !important;
        box-shadow: 0 5px 15px rgba(36, 58, 127, 0.3) !important;
    }
</style>

<div class="content-header px-4 pt-4 text-start">
    <div class="container-fluid">
        <h1 style="color: #243a7f; font-weight: 800;">
            <i class="fas fa-edit me-2"></i> Edit Permission
        </h1>
        <p class="text-muted">Change the name of the system access level.</p>
    </div>
</div>

<section class="content px-4 mt-3">
    <div class="container-fluid">
        <div class="form-card">
            <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                @csrf
                @method('PUT') <!-- Update ke liye PUT lazmi hai -->

                <div class="mb-4">
                    <label class="form-label">Permission Name</label>
                    <input type="text" name="name" class="form-control custom-input" 
                           value="{{ old('name', $permission->name) }}" required>
                    <x-input-error :messages="$errors->get('name')" class="text-danger small mt-2"/>
                </div>

                <div class="mt-5 d-flex align-items-center">
                    <button type="submit" class="btn-update">
                        <i class="fas fa-save me-2"></i> Update Permission
                    </button>
                    
                    <a href="{{ route('permissions.index') }}" class="ms-4 text-muted font-weight-bold text-decoration-none">
                        <i class="fas fa-times me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection