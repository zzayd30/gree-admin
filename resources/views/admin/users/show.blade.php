@extends('admin.layout.app')
@section('title', 'User Details')

@section('content')
<style>
    .content-wrapper { background-color: var(--secondary-color) !important; }
    .detail-card { background: #fff; border-radius: 20px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.05); overflow: hidden; }
    .detail-header { background: #243a7f; color: #fff; padding: 15px 25px; font-weight: 700; }
    .info-row { display: flex; padding: 15px 25px; border-bottom: 1px solid #f1f4f8; }
    .info-label { width: 150px; font-weight: 700; color: #64748b; font-size: 13px; text-transform: uppercase; }
    .info-value { font-weight: 600; color: #1e293b; }
    .permission-badge { background: #f1f5f9; color: #243a7f; padding: 5px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; margin: 3px; border: 1px solid rgba(36,58,127,0.1); }
</style>

<div class="content-header px-4 pt-4">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6"><h1 class="page-title">User Profile</h1></div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Back</a>
                <a href="{{ route('users.edit', $user->id) }}" class="btn-create-custom ms-2" style="padding: 8px 25px !important;">Edit Profile</a>
            </div>
        </div>
    </div>
</div>

<section class="content px-4 mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7 mb-4">
                <div class="detail-card">
                    <div class="detail-header">General Information</div>
                    <div class="info-row"><div class="info-label">Full Name</div><div class="info-value">{{ $user->name }}</div></div>
                    <div class="info-row"><div class="info-label">Email Address</div><div class="info-value">{{ $user->email }}</div></div>
                    <div class="info-row"><div class="info-label">Company</div><div class="info-value">{{ $user->company ?? 'N/A' }}</div></div>
                    <div class="info-row"><div class="info-label">Business Type</div><div class="info-value">{{ $user->typeOfBusiness->name ?? 'N/A' }}</div></div>
                    <div class="info-row"><div class="info-label">Joined On</div><div class="info-value">{{ $user->created_at->format('M d, Y H:i') }}</div></div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="detail-card">
                    <div class="detail-header">Roles & Permissions</div>
                    <div class="p-4">
                        @foreach($user->roles as $role)
                            <div class="mb-3 pb-3 border-bottom last-child-border-0">
                                <h6 class="fw-bold text-primary mb-2 text-uppercase tracking-wider" style="font-size: 12px;">{{ $role->name }}</h6>
                                <div class="d-flex flex-wrap">
                                    @foreach($role->permissions as $perm)
                                        <span class="permission-badge">{{ $perm->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection