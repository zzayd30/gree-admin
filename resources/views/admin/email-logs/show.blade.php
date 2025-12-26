@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Email Log Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('email-logs.index') }}">Email Logs</a></li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Email #{{ $emailLog->id }}</h3>
                                <div class="card-tools">
                                    <a href="{{ route('email-logs.index') }}" class="btn btn-sm btn-default">
                                        <i class="fas fa-arrow-left"></i> Back
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="text-primary mb-3">Sender Information</h5>
                                        <table class="table table-sm">
                                            <tr>
                                                <th style="width: 150px">Sent By:</th>
                                                <td>
                                                    @if ($emailLog->sender)
                                                        {{ $emailLog->sender->name }}
                                                    @else
                                                        <span class="text-muted">System</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Sent At:</th>
                                                <td>
                                                    @if ($emailLog->sent_at)
                                                        {{ $emailLog->sent_at->format('F d, Y h:i:s A') }}
                                                    @else
                                                        <span class="text-muted">Not sent yet</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Status:</th>
                                                <td>
                                                    @if ($emailLog->status == 'sent')
                                                        <span class="badge badge-success">Sent</span>
                                                    @elseif($emailLog->status == 'failed')
                                                        <span class="badge badge-danger">Failed</span>
                                                    @else
                                                        <span class="badge badge-warning">Pending</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        <h5 class="text-primary mb-3">Recipient Information</h5>
                                        <table class="table table-sm">
                                            <tr>
                                                <th style="width: 150px">Name:</th>
                                                <td>{{ $emailLog->recipient_name ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email:</th>
                                                <td>{{ $emailLog->recipient_email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Type:</th>
                                                <td>
                                                    @if ($emailLog->recipient_type)
                                                        <span
                                                            class="badge badge-{{ $emailLog->recipient_type == 'user' ? 'primary' : 'info' }}">
                                                            {{ ucfirst($emailLog->recipient_type) }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="text-primary mb-3">Email Content</h5>
                                        <table class="table table-sm">
                                            <tr>
                                                <th style="width: 150px">Purpose:</th>
                                                <td>{{ $emailLog->purpose }}</td>
                                            </tr>
                                            <tr>
                                                <th>Subject:</th>
                                                <td>{{ $emailLog->subject }}</td>
                                            </tr>
                                            <tr>
                                                <th>Body:</th>
                                                <td>
                                                    @if ($emailLog->body)
                                                        <div class="border p-3 bg-light rounded">
                                                            {!! nl2br(e($emailLog->body)) !!}
                                                        </div>
                                                    @else
                                                        <span class="text-muted">No body content</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                @if ($emailLog->status == 'failed' && $emailLog->error_message)
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="text-danger mb-3">Error Information</h5>
                                            <div class="alert alert-danger">
                                                {{ $emailLog->error_message }}
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="text-primary mb-3">Timestamps</h5>
                                        <table class="table table-sm">
                                            <tr>
                                                <th style="width: 150px">Created At:</th>
                                                <td>{{ $emailLog->created_at->format('F d, Y h:i:s A') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Updated At:</th>
                                                <td>{{ $emailLog->updated_at->format('F d, Y h:i:s A') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
