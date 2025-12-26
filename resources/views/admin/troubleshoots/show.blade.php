@extends('admin.layout.app')
@section('title', 'View Troubleshoot Error Code')

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

        /* Edit Button - Heavy Solid Style */
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
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .bg-active {
            background-color: #d1fae5;
            color: #065f46;
        }

        .bg-inactive {
            background-color: #f1f5f9;
            color: #64748b;
        }

        /* Modern Table for Steps */
        .modern-table thead th {
            background-color: #243a7f !important;
            color: #ffffff !important;
            padding: 15px 20px !important;
            font-size: 12px !important;
            text-transform: uppercase;
            border: none !important;
        }

        .modern-table tbody td {
            padding: 15px 20px !important;
            vertical-align: middle !important;
            border-bottom: 1px solid #f1f4f8 !important;
        }
    </style>

    <div class="content-header px-4 pt-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6 text-start">
                    <h1 class="page-title"><i class="fas fa-eye me-2"></i> Troubleshoot Error Code Details</h1>
                    <p class="text-muted small mb-0 mt-1">Complete information about this diagnostic code.</p>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('troubleshoots.edit', $troubleshoot->id) }}" class="btn-edit-profile">
                        <i class="fas fa-edit me-2"></i> Edit Code
                    </a>
                    <a href="{{ route('troubleshoots.index') }}" class="btn-back-custom ms-2">
                        <i class="fas fa-arrow-left me-2"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-card">
                        <div class="detail-header">
                            <i class="fas fa-info-circle me-2"></i> Code Information
                        </div>
                        <div class="info-row">
                            <span class="info-label">Code Name</span>
                            <span class="info-value">{{ $troubleshoot->name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status</span>
                            <span class="info-value">
                                @if ($troubleshoot->status == 'active')
                                    <span class="status-badge bg-active">Active</span>
                                @else
                                    <span class="status-badge bg-inactive">Inactive</span>
                                @endif
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Created By</span>
                            <span class="info-value">{{ $troubleshoot->creator->name ?? 'N/A' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Created At</span>
                            <span class="info-value">{{ $troubleshoot->created_at->format('M d, Y h:i A') }}</span>
                        </div>
                        <div class="info-row" style="border-bottom: none;">
                            <span class="info-label">Last Updated</span>
                            <span class="info-value">{{ $troubleshoot->updated_at->format('M d, Y h:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            @if ($troubleshoot->steps->count() > 0)
                <div class="detail-card mt-4">
                    <div class="detail-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-list-ol me-2"></i> Troubleshoot Steps
                            ({{ $troubleshoot->steps->count() }})</span>
                        <a href="{{ route('troubleshoots.steps.create', $troubleshoot->id) }}" class="btn btn-sm btn-light">
                            <i class="fas fa-plus me-1"></i> Add Step
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table modern-table mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width: 100px">Step Number</th>
                                    <th>Action</th>
                                    <th>Sensor Type</th>
                                    <th>Tips</th>
                                    <th style="width: 120px" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($troubleshoot->steps as $step)
                                    <tr>
                                        <td class="text-muted">{{ $loop->iteration }}</td>
                                        <td><span class="badge bg-primary">Step {{ $step->step_number }}</span></td>
                                        <td class="fw-bold">{{ $step->action }}</td>
                                        <td><span class="badge bg-info">{{ $step->sensor_type }}</span></td>
                                        <td>
                                            @if (is_array($step->tips))
                                                <ul class="mb-0 ps-3">
                                                    @foreach ($step->tips as $tip)
                                                        <li class="small">{{ $tip }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <span class="small">{{ $step->tips }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('troubleshoots.steps.edit', [$troubleshoot->id, $step->id]) }}"
                                                class="btn btn-sm btn-warning" title="Edit Step">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form
                                                action="{{ route('troubleshoots.steps.destroy', [$troubleshoot->id, $step->id]) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="confirmDelete(event, 'This step will be deleted!')"
                                                    title="Delete Step">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="detail-card mt-4">
                    <div class="detail-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-list-ol me-2"></i> Troubleshoot Steps</span>
                        <a href="{{ route('troubleshoots.steps.create', $troubleshoot->id) }}"
                            class="btn btn-sm btn-light">
                            <i class="fas fa-plus me-1"></i> Add Step
                        </a>
                    </div>
                    <div class="p-5 text-center">
                        <i class="fas fa-info-circle text-muted" style="font-size: 48px;"></i>
                        <p class="text-muted mt-3 mb-0">No troubleshoot steps found for this error code.</p>
                        <a href="{{ route('troubleshoots.steps.create', $troubleshoot->id) }}"
                            class="btn btn-primary mt-3">
                            <i class="fas fa-plus me-1"></i> Add First Step
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
