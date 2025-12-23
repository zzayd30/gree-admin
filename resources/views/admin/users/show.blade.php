@extends('admin.layout.app')
@section('title', 'User Profile')

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
        background-color: #243a7f !important; /* Gree Primary Blue */
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
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
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

    .permission-badge {
        background: #f1f5f9;
        color: var(--primary-color);
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        margin: 4px;
        border: 1px solid rgba(36,58,127,0.1);
    }
</style>

<div class="content-header px-4 pt-4">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6 text-start">
                <h1 class="page-title"><i class="fas fa-id-card me-2"></i> User Profile</h1>
                <p class="text-muted small mt-1">Detailed view of user account and access roles.</p>
            </div>
            <div class="col-sm-6 text-end">
                <!-- Back Button -->
                <a href="{{ route('users.index') }}" class="btn-back-custom me-2">
                    <i class="fas fa-arrow-left me-2"></i> Back
                </a>
                
                <!-- Edit Profile Button -->
                <a href="{{ route('users.edit', $user->id) }}" class="btn-edit-profile">
                    <i class="fas fa-user-edit me-2"></i> Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>

<section class="content px-4 mt-3">
    <div class="container-fluid">
        <div class="row">
            <!-- General Information -->
            <div class="col-md-7">
                <div class="detail-card">
                    <div class="detail-header">General Information</div>
                    <div class="card-body p-0">
                        <div class="info-row">
                            <div class="info-label">Full Name</div>
                            <div class="info-value text-dark">{{ $user->name }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Email Address</div>
                            <div class="info-value">{{ $user->email }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Company</div>
                            <div class="info-value">{{ $user->company ?? 'Not Assigned' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Business Type</div>
                            <div class="info-value">{{ $user->typeOfBusiness->name ?? 'Not Assigned' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Account Created</div>
                            <div class="info-value text-muted">{{ $user->created_at->format('M d, Y - H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Roles & Permissions -->
            <div class="col-md-5">
                <div class="detail-card">
                    <div class="detail-header">Roles & System Access</div>
                    <div class="p-4">
                        @forelse($user->roles as $role)
                            <div class="mb-4 pb-3 border-bottom last-child-border-0">
                                <h6 class="fw-bold text-primary mb-3" style="font-size: 13px; letter-spacing: 1px;">
                                    <i class="fas fa-user-shield me-2"></i>{{ strtoupper($role->name) }}
                                </h6>
                                <div class="d-flex flex-wrap">
                                    @foreach($role->permissions as $perm)
                                        <span class="permission-badge">
                                            <i class="fas fa-check-circle me-1 opacity-50"></i>{{ $perm->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <p class="text-muted text-center py-4">No roles assigned to this user.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection