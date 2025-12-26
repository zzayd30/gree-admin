@extends('admin.layout.app')
@section('title', 'Email Log Details')

@section('content')
    <style>
        .content-wrapper {
            background-color: var(--secondary-color) !important;
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 800;
            margin: 0;
        }

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

        .email-body-preview {
            background: #f8f9fa;
            border-left: 4px solid var(--primary-color);
            padding: 20px;
            border-radius: 8px;
            font-family: monospace;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>

    <div class="content-header px-4 pt-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6 text-start">
                    <h1 class="page-title"><i class="fas fa-envelope-open-text me-2"></i> Email Log Details</h1>
                    <p class="text-muted small mb-0 mt-1">Detailed information about email #{{ $emailLog->id }}</p>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('email-logs.index') }}" class="btn-back-custom">
                        <i class="fas fa-arrow-left me-1"></i> Back to Email Logs
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- Sender Information -->
                    <div class="detail-card">
                        <div class="detail-header">
                            <i class="fas fa-user-circle me-2"></i> Sender Information
                        </div>
                        <div class="info-row">
                            <div class="info-label">Sent By:</div>
                            <div class="info-value">
                                @if ($emailLog->sender)
                                    {{ $emailLog->sender->name }}
                                @else
                                    <span class="text-muted">System</span>
                                @endif
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Sent At:</div>
                            <div class="info-value">
                                @if ($emailLog->sent_at)
                                    {{ $emailLog->sent_at->format('F d, Y h:i:s A') }}
                                @else
                                    <span class="text-muted">Not sent yet</span>
                                @endif
                            </div>
                        </div>
                        <div class="info-row" style="border-bottom: none;">
                            <div class="info-label">Status:</div>
                            <div class="info-value">
                                @if ($emailLog->status == 'sent')
                                    <span class="badge bg-success">Sent</span>
                                @elseif($emailLog->status == 'failed')
                                    <span class="badge bg-danger">Failed</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Recipient Information -->
                    <div class="detail-card">
                        <div class="detail-header">
                            <i class="fas fa-user-tag me-2"></i> Recipient Information
                        </div>
                        <div class="info-row">
                            <div class="info-label">Name:</div>
                            <div class="info-value">{{ $emailLog->recipient_name ?? 'N/A' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Email:</div>
                            <div class="info-value">{{ $emailLog->recipient_email }}</div>
                        </div>
                        <div class="info-row" style="border-bottom: none;">
                            <div class="info-label">Type:</div>
                            <div class="info-value">
                                @if ($emailLog->recipient_type)
                                    <span
                                        class="badge {{ $emailLog->recipient_type == 'user' ? 'bg-primary' : 'bg-info' }}">
                                        {{ ucfirst($emailLog->recipient_type) }}
                                    </span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Email Content -->
            <div class="detail-card">
                <div class="detail-header">
                    <i class="fas fa-file-alt me-2"></i> Email Content
                </div>
                <div class="info-row">
                    <div class="info-label">Purpose:</div>
                    <div class="info-value">{{ $emailLog->purpose }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Subject:</div>
                    <div class="info-value">{{ $emailLog->subject }}</div>
                </div>
                <div class="info-row" style="border-bottom: none;">
                    <div class="info-label">Body:</div>
                    <div class="info-value w-100">
                        @if ($emailLog->body)
                            <div class="email-body-preview mt-2">{{ $emailLog->body }}</div>
                        @else
                            <span class="text-muted">No body content</span>
                        @endif
                    </div>
                </div>
            </div>

            @if ($emailLog->status == 'failed' && $emailLog->error_message)
                <!-- Error Information -->
                <div class="detail-card">
                    <div class="detail-header bg-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i> Error Information
                    </div>
                    <div class="p-4">
                        <div class="alert alert-danger mb-0">
                            {{ $emailLog->error_message }}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Timestamps -->
            <div class="detail-card">
                <div class="detail-header">
                    <i class="fas fa-clock me-2"></i> Timestamps
                </div>
                <div class="info-row">
                    <div class="info-label">Created At:</div>
                    <div class="info-value">{{ $emailLog->created_at->format('F d, Y h:i:s A') }}</div>
                </div>
                <div class="info-row" style="border-bottom: none;">
                    <div class="info-label">Updated At:</div>
                    <div class="info-value">{{ $emailLog->updated_at->format('F d, Y h:i:s A') }}</div>
                </div>
            </div>
        </div>
    </section>
@endsection
