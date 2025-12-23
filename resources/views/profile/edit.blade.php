@extends('admin.layout.app')
@section('title', 'My Account Settings')

@section('content')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .content-wrapper {
            background-color: var(--secondary-color) !important;
            padding-bottom: 50px;
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 800;
            margin: 0;
        }

        /* Card Fixes */
        .form-card {
            background: #ffffff;
            border: none;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border-top: 5px solid #243a7f;
            margin-bottom: 20px;
            /* Space between cards */
        }

        .form-label {
            font-weight: 700;
            color: #243a7f;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            display: block;
        }

        /* Input Styling */
        .custom-input {
            border-radius: 10px !important;
            padding: 12px 15px !important;
            border: 1px solid #e2e8f0 !important;
            background-color: #f8fafc !important;
            width: 100% !important;
        }

        /* Avatar Box Fix */
        .avatar-container {
            text-align: center;
            padding: 10px 0;
        }

        .avatar-preview-box {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: #f1f5f9;
            border: 4px solid #fff;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            margin: 0 auto 15px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar-preview-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Button Styling - Solid Fix */
        .btn-save-profile {
            background-color: #243a7f !important;
            color: white !important;
            padding: 12px 30px !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(36, 58, 127, 0.2) !important;
            display: inline-block !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .btn-update-password {
            background-color: #ffc107 !important;
            color: #000 !important;
            padding: 12px 20px !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            border: none !important;
            width: 100% !important;
            box-shadow: 0 4px 10px rgba(255, 193, 7, 0.2) !important;
        }

        /* Select2 Heights Fix */
        .select2-container--default .select2-selection--single {
            border-radius: 10px !important;
            height: 48px !important;
            border: 1px solid #e2e8f0 !important;
            background-color: #f8fafc !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 45px !important;
            padding-left: 15px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 46px !important;
        }
    </style>

    <div class="content-header px-4 pt-4">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 text-start">
                    <h1 class="page-title"><i class="fas fa-user-cog me-2"></i> Account Settings</h1>
                    <p class="text-muted small mt-1">Manage your personal profile and security preferences.</p>
                </div>
            </div>
        </div>
    </div>

    <section class="content px-4">
        <div class="container-fluid">
            <div class="row">

                <!-- LEFT COLUMN: Profile Info (col-lg-8) -->
                <div class="col-lg-8">
                    <div class="form-card">
                        <h5 class="fw-bold mb-4 text-dark border-bottom pb-2">Basic Information</h5>

                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                <div class="col-md-6 mb-4 text-start">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control custom-input"
                                        value="{{ old('name', $user->name) }}" required>
                                </div>
                                <div class="col-md-6 mb-4 text-start">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control custom-input"
                                        value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4 text-start">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" name="company" class="form-control custom-input"
                                        value="{{ old('company', $user->company) }}" required>
                                </div>
                                <div class="col-md-6 mb-4 text-start">
                                    <label class="form-label">Type of Business</label>
                                    <select name="type_of_business" id="profile_biz_select" class="form-select select2"
                                        required>
                                        @foreach ($type_of_business as $bt)
                                            <option value="{{ $bt->id }}"
                                                {{ old('type_of_business', $user->type_of_business_id) == $bt->id ? 'selected' : '' }}>
                                                {{ $bt->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4 text-start">
                                <label class="form-label">Profile Picture (Avatar)</label>
                                <input type="file" name="profile_picture" class="form-control custom-input"
                                    accept="image/*">
                                <small class="text-muted d-block mt-2 font-italic">Format: JPG, PNG (Max 2MB)</small>
                            </div>

                            <div class="mt-4 pt-3 border-top text-start">
                                <button type="submit" class="btn-save-profile">
                                    <i class="fas fa-check-circle me-2"></i> Update Profile Details
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- RIGHT COLUMN: Avatar Preview & Password (col-lg-4) -->
                <div class="col-lg-4">

                    <!-- Avatar Preview Card -->
                    <div class="form-card text-center">
                        <div class="avatar-container">
                            <div class="avatar-preview-box">
                                @if ($user->profile_picture)
                                    {{-- <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"
                                        class="img-fluid rounded-circle"
                                        style="width: 150px; height: 150px; object-fit: cover; margin: auto;"> --}}
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Avatar">
                                @else
                                    <i class="fas fa-user fa-3x text-muted opacity-50"></i>
                                @endif
                            </div>
                            <h5 class="fw-bold text-dark mb-0">{{ $user->name }}</h5>
                            <p class="text-muted small mb-0">{{ $user->email }}</p>
                        </div>
                    </div>

                    <!-- Password Update Card -->
                    <div class="form-card">
                        <h6 class="fw-bold mb-4 text-dark border-bottom pb-2">Security & Password</h6>
                        <form action="{{ route('profile.password') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3 text-start">
                                <label class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-control custom-input" required>
                            </div>

                            <div class="mb-3 text-start">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control custom-input" required>
                            </div>

                            <div class="mb-4 text-start">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control custom-input"
                                    required>
                            </div>

                            <button type="submit" class="btn-update-password shadow-sm">
                                <i class="fas fa-shield-alt me-2"></i> Update Password
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- jQuery and Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#profile_biz_select').select2({
                placeholder: "Select Business Type",
                width: '100%'
            });
        });
    </script>
@endsection
