@extends('admin.layout.app')
@section('title', 'Create Role')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <h1>Create Role</h1>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-body">
                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Role Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        <x-input-error :messages="$errors->get('name')" class="text-danger small mt-1"/>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}">
                                        <label class="form-check-label">{{ $permission->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Create</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
