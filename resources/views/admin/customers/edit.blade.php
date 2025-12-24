@extends('admin.layout.app')
@section('title', 'Edit Customer Account')

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

        /* Select2 Modern Design */
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
            <h1 class="page-title text-start"><i class="fas fa-user-edit me-2"></i> Edit Customer: {{ $customer->name }}</h1>
        </div>
    </div>

    <section class="content px-4">
        <div class="container-fluid">
            <div class="form-card">
                <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-4 text-start">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control custom-input"
                                value="{{ old('name', $customer->name) }}" required>
                        </div>
                        <div class="col-md-6 mb-4 text-start">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control custom-input"
                                value="{{ old('email', $customer->email) }}" required>
                        </div>
                        <div class="col-md-6 mb-4 text-start">
                            <label class="form-label">Company Name (Optional)</label>
                            <input type="text" name="company" class="form-control custom-input"
                                value="{{ old('company', $customer->company) }}">
                        </div>
                        <div class="col-md-6 mb-4 text-start">
                            <label class="form-label">Type of Business (Optional)</label>
                            <select name="type_of_business" id="search_business_edit"
                                class="form-select select2 shadow-none">
                                <option value="">Search Business Type...</option>
                                @foreach ($type_of_business as $bt)
                                    <option value="{{ $bt->id }}"
                                        {{ old('type_of_business', $customer->type_of_business_id) == $bt->id ? 'selected' : '' }}>
                                        {{ $bt->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-4 text-start">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select custom-input" required>
                                <option value="active" {{ old('status', $customer->status) == 'active' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="inactive"
                                    {{ old('status', $customer->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4 text-start border-top pt-4">
                        <h5 class="fw-bold text-dark mb-3">Change Password (Optional)</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control custom-input"
                                    placeholder="Leave blank to keep current">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control custom-input">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-start border-top pt-4">
                        <button type="submit" class="btn-submit-custom">Update Customer Profile</button>
                        <a href="{{ route('customers.index') }}"
                            class="ms-3 text-muted fw-bold text-decoration-none">Cancel</a>
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
            $('#search_business_edit').select2({
                placeholder: "Search Business Type...",
                width: '100%'
            });
        });
    </script>
@endsection
