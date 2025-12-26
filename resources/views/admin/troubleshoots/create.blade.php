@extends('admin.layout.app')
@section('title', 'Create New Troubleshoot Error Code')

@section('content')
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

        .btn-submit-custom {
            background: linear-gradient(135deg, #243a7f 0%, #1a2a5e 100%);
            color: white;
            padding: 14px 35px;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            transition: 0.3s;
            box-shadow: 0 6px 15px rgba(36, 58, 127, 0.3);
        }

        .btn-submit-custom:hover {
            box-shadow: 0 8px 25px rgba(36, 58, 127, 0.5);
            transform: translateY(-2px);
        }
    </style>

    <div class="content-header px-4 pt-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6 text-start">
                    <h1 class="page-title"><i class="fas fa-plus-circle me-2"></i> Create Troubleshoot Code</h1>
                    <p class="text-muted small mb-0 mt-1">Add a new diagnostic error code to the system.</p>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="form-card">
                <form action="{{ route('troubleshoots.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-4 text-start">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control custom-input @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" placeholder="Enter troubleshoot error code name"
                                required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-4 text-start">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control custom-input @error('status') is-invalid @enderror" name="status"
                                required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 text-start border-top pt-4">
                        <button type="submit" class="btn-submit-custom">
                            <i class="fas fa-save me-1"></i> Create Error Code
                        </button>
                        <a href="{{ route('troubleshoots.index') }}" class="ms-3 text-muted fw-bold text-decoration-none">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
