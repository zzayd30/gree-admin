@extends('admin.layout.app')
@section('title', 'Customer Profile')

@section('content')
    <style>
        /* Content Background */
        .content-wrapper {
            background-color: var(--secondary-color) !important;
        }

        /* Page Header Styles */
        .page-title {
            color: var(--primary-color);
            font-weight: 800;
            margin: 0;
        }

        /* Edit Profile Button - Heavy Solid Style */
        .btn-edit-profile {
            background-color: #243a7f !important;
            color: #ffffff !important;
            padding: 12px 28px !important;
            border-radius: 12px !important;
            font-weight: 700 !important;
            display: inline-flex !important;
            align-items: center !important;
            text-decoration: none !important;
            border: none !important;
            box-shadow: 0 4px 15px rgba(36, 58, 127, 0.2) !important;
            transition: all 0.3s ease !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .btn-edit-profile:hover {
            background-color: #1a2a5e !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 20px rgba(36, 58, 127, 0.3) !important;
            color: #ffffff !important;
        }

        /* Back Button - Professional Outline Style */
        .btn-back-custom {
            background-color: transparent !important;
            color: #64748b !important;
            border: 2px solid #cbd5e1 !important;
            padding: 10px 25px !important;
            border-radius: 12px !important;
            font-weight: 700 !important;
            display: inline-flex !important;
            align-items: center !important;
            text-decoration: none !important;
            transition: 0.3s !important;
        }

        .btn-back-custom:hover {
            background-color: #f1f5f9 !important;
            border-color: #94a3b8 !important;
            color: #1e293b !important;
        }

        /* Card Styling */
        .detail-card {
            background: #fff;
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 25px;
        }

        .detail-header {
            background: var(--primary-color);
            color: #fff;
            padding: 15px 25px;
            font-weight: 700;
            font-size: 16px;
        }

        .info-row {
            display: flex;
            padding: 18px 25px;
            border-bottom: 1px solid #f1f4f8;
        }

        .info-label {
            width: 180px;
            font-weight: 700;
            color: #64748b;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-weight: 600;
            color: #1e293b;
            font-size: 15px;
        }

        .status-badge {
            padding: 6px 15px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
        }
    </style>

    <!-- Page Header -->
    <div class="content-header px-4 pt-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6 text-start">
                    <h1 class="page-title"><i class="fas fa-user-circle me-2"></i> Customer Profile</h1>
                    <p class="text-muted small mb-0 mt-1">View detailed customer information.</p>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn-edit-profile me-2">
                        <i class="fas fa-edit me-2"></i> Edit Profile
                    </a>
                    <a href="{{ route('customers.index') }}" class="btn-back-custom">
                        <i class="fas fa-arrow-left me-2"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Content Section -->
    <section class="content px-4 pb-4">
        <div class="container-fluid">
            <div class="row">
                <!-- Basic Information Card -->
                <div class="col-md-6">
                    <div class="detail-card">
                        <div class="detail-header">
                            <i class="fas fa-user me-2"></i> Basic Information
                        </div>
                        <div class="info-row">
                            <span class="info-label">Customer ID:</span>
                            <span class="info-value">#{{ $customer->id }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Full Name:</span>
                            <span class="info-value">{{ $customer->name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email Address:</span>
                            <span class="info-value">{{ $customer->email }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Company:</span>
                            <span class="info-value">{{ $customer->company ?? 'N/A' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status:</span>
                            <span class="info-value">
                                @if ($customer->status == 'active')
                                    <span class="status-badge bg-success text-white">Active</span>
                                @else
                                    <span class="status-badge bg-danger text-white">Inactive</span>
                                @endif
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Created By Admin:</span>
                            <span class="info-value">
                                @if ($customer->create_by_admin)
                                    <span class="badge bg-primary">Yes</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Account Activity Card -->
                <div class="col-md-6">
                    <div class="detail-card">
                        <div class="detail-header">
                            <i class="fas fa-clock me-2"></i> Account Activity
                        </div>
                        <div class="info-row">
                            <span class="info-label">Account Created:</span>
                            <span class="info-value">{{ $customer->created_at->format('F d, Y') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Last Updated:</span>
                            <span class="info-value">{{ $customer->updated_at->format('F d, Y') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Account Age:</span>
                            <span class="info-value">{{ $customer->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
