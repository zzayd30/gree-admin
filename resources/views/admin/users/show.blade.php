@extends('admin.layout.app')
@section('title', 'View User')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Details</h1>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User Information</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px">ID</th>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Email Verified</th>
                                    <td>{{ $user->email_verified_at ? 'Yes' : 'No' }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $user->updated_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Roles</h3>
                        </div>
                        <div class="card-body">
                            @if ($user->roles->count() > 0)
                                <ul class="list-group">
                                    @foreach ($user->roles as $role)
                                        <li class="list-group-item">
                                            <strong>{{ $role->name }}</strong>
                                            @if ($role->permissions->count() > 0)
                                                <div class="mt-2">
                                                    <small class="text-muted">Permissions:</small>
                                                    <div class="mt-1">
                                                        @foreach ($role->permissions as $permission)
                                                            <span class="badge bg-secondary">{{ $permission->name }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">No roles assigned</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
