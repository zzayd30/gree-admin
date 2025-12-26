@extends('admin.layout.app')
@section('title', 'Troubleshoot Details')

@section('content')
<style>
    /* 1. Global Setup */
    .content-wrapper { background-color: var(--secondary-color) !important; padding-bottom: 50px; }
    .page-title { color: var(--primary-color); font-weight: 850; text-transform: uppercase; letter-spacing: -1px; }

    /* 2. Sharp Edges (Strictly 0px) */
    .modern-card, .btn, .badge, .status-badge, .gradient-header, .info-group {
        border-radius: 0px !important;
    }

    /* 3. Header Buttons */
    .btn-edit-main {
        background-color: #243a7f !important; color: white !important;
        padding: 10px 25px; font-weight: 700; border: none !important;
        box-shadow: 0 4px 12px rgba(36, 58, 127, 0.2);
    }
    .btn-back-outline {
        border: 1px solid #cbd5e1 !important; color: #64748b !important;
        padding: 9px 20px; font-weight: 700; background: #fff !important;
    }

    /* 4. Modern Technical Cards */
    .modern-card {
        background: #ffffff; border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        margin-top: 20px; overflow: hidden;
        height: 100%; /* Height balance karne ke liye */
    }

    /* 5. Continuous Linear Gradient Header (Unified) */
    .gradient-header {
        background: linear-gradient(90deg, #1a2d5a 0%, #243a7f 100%) !important;
        color: white !important; padding: 16px 25px; font-weight: 700;
        font-size: 14px; text-transform: uppercase; letter-spacing: 1.5px;
        display: flex; align-items: center;
    }

    /* 6. Info Rows */
    .info-group { display: flex; padding: 18px 25px; border-bottom: 1px solid #f1f4f8; align-items: center; }
    .info-key { width: 160px; font-weight: 700; color: #64748b; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; }
    .info-val { font-weight: 600; color: #1e293b; font-size: 15px; flex: 1; }

    /* 7. Status Badges */
    .status-badge { padding: 5px 15px; font-size: 10px; font-weight: 800; text-transform: uppercase; border: 1px solid rgba(0,0,0,0.05); }
    .bg-active { background-color: #d1fae5; color: #065f46; }
    .bg-inactive { background-color: #fee2e2; color: #991b1b; }

    /* 8. Summary Items */
    .summary-item { padding: 15px 0; border-bottom: 1px dashed #e2e8f0; }
    .summary-item:last-child { border-bottom: none; }
    
    /* 9. Validation Box Fix */
    .validation-box {
        background: #f8fafc; border: 1px solid #e2e8f0; padding: 20px;
        text-align: center; margin-top: 10px;
    }
</style>

<div class="content-header px-4 pt-4 text-start">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-8">
                <h1 class="page-title"><i class="fas fa-microchip me-3"></i>ERROR CODE: {{ strtoupper($troubleshoot->name) }}</h1>
                <p class="text-muted small mt-1 ml-5">Technical diagnostic data and resolution protocols.</p>
            </div>
            <div class="col-sm-4 text-end">
                <a href="{{ route('troubleshoots.index') }}" class="btn-back-outline me-2">
                    <i class="fas fa-arrow-left me-2"></i> BACK TO LIST
                </a>
                <a href="{{ route('troubleshoots.edit', $troubleshoot->id) }}" class="btn-edit-main">
                    <i class="fas fa-edit me-2"></i> EDIT CODE
                </a>
            </div>
        </div>
    </div>
</div>

<section class="content px-4">
    <div class="container-fluid text-start">
        <div class="row">
            <!-- Left: Code Info -->
            <div class="col-lg-7 mb-4">
                <div class="modern-card">
                    <div class="gradient-header"><i class="fas fa-file-invoice me-2"></i> Basic Specifications</div>
                    <div class="info-group">
                        <div class="info-key">Reference Name</div>
                        <div class="info-val" style="color: #243a7f; font-size: 18px;">{{ $troubleshoot->name }}</div>
                    </div>
                    <div class="info-group">
                        <div class="info-key">System Status</div>
                        <div class="info-val">
                            <span class="status-badge {{ $troubleshoot->status == 'active' ? 'bg-active' : 'bg-inactive' }}">
                                {{ $troubleshoot->status }}
                            </span>
                        </div>
                    </div>
                    <div class="info-group">
                        <div class="info-key">Registered By</div>
                        <div class="info-val">{{ $troubleshoot->creator->name ?? 'System Admin' }}</div>
                    </div>
                    <div class="info-group" style="border-bottom: none;">
                        <div class="info-key">Record Date</div>
                        <div class="info-val text-muted">{{ $troubleshoot->created_at->format('M d, Y | h:i A') }}</div>
                    </div>
                </div>
            </div>

            <!-- Right: Summary (Fixed Header & Verified Status) -->
            <div class="col-lg-5 mb-4">
                <div class="modern-card">
                    <!-- Added Matching Header -->
                    <div class="gradient-header"><i class="fas fa-chart-pie me-2"></i> System Summary</div>
                    <div class="p-4">
                        <div class="row text-center mb-4">
                            <div class="col-6 border-end">
                                <h1 class="fw-bold mb-0 text-primary">{{ $troubleshoot->steps->count() }}</h1>
                                <small class="text-muted fw-bold">TOTAL STEPS</small>
                            </div>
                            <div class="col-6">
                                <h1 class="fw-bold mb-0 text-success"><i class="fas fa-shield-alt"></i></h1>
                                <small class="text-muted fw-bold">SECURITY LEVEL</small>
                            </div>
                        </div>

                        <!-- Professional Validation Section -->
                        <div class="validation-box">
                            <div class="d-flex align-items-center justify-content-center text-success mb-2">
                                <i class="fas fa-check-circle me-2"></i>
                                <span class="fw-bold small">VERIFIED DIAGNOSTIC</span>
                            </div>
                            <p class="text-muted small mb-0">This error code has been verified and is ready for field deployment.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Troubleshoot Steps (Fixed Header) -->
        <div class="modern-card mt-2">
            <div class="gradient-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-stream me-2"></i> Technical Recovery Steps</span>
                <a href="{{ route('troubleshoots.steps.create', $troubleshoot->id) }}" class="btn btn-sm btn-light border fw-bold px-3" style="font-size: 11px;">
                    <i class="fas fa-plus me-1"></i> ADD STEP
                </a>
            </div>

            @if ($troubleshoot->steps->count() > 0)
                <div class="table-responsive">
                    <table class="table modern-table mb-0">
                        <thead style="background: #f8fafc !important;">
                            <tr>
                                <th style="color: #64748b !important; width: 60px;">#</th>
                                <th style="color: #64748b !important;">Order</th>
                                <th style="color: #64748b !important;">Recovery Action</th>
                                <th style="color: #64748b !important;">Sensor</th>
                                <th style="color: #64748b !important; text-align: center;">Modify</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($troubleshoot->steps as $step)
                                <tr>
                                    <td class="text-muted">#{{ $loop->iteration }}</td>
                                    <td><span class="badge bg-light text-primary border px-3">STEP {{ $step->step_number }}</span></td>
                                    <td class="fw-bold">{{ $step->action }}</td>
                                    <td><span class="badge bg-info" style="background-color: #e0f2fe !important; color: #0369a1 !important;">{{ $step->sensor_type }}</span></td>
                                    <td class="text-center">
                                        <a href="{{ route('troubleshoots.steps.edit', [$troubleshoot->id, $step->id]) }}" class="btn btn-sm btn-warning me-1"><i class="fas fa-edit"></i></a>
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-5 text-center">
                    <i class="fas fa-folder-open text-muted fa-3x mb-3"></i>
                    <p class="text-muted fw-bold">No recovery steps defined for this protocol.</p>
                    <a href="{{ route('troubleshoots.steps.create', $troubleshoot->id) }}" class="btn btn-primary btn-sm px-4 mt-2">CREATE FIRST STEP</a>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection