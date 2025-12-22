@extends('admin.layout.app')
@section('title', 'Permissions')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Permissions</h1>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('permissions.create') }}" class="btn btn-primary">Create Permission</a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this permission?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $permissions->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</section>
@endsection
