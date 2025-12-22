@extends('admin.layout.app')
@section('title', isset($permission) ? 'Edit Permission' : 'Create Permission')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <h1>{{ isset($permission) ? 'Edit Permission' : 'Create Permission' }}</h1>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-body">
                <form method="POST" action="{{ isset($permission) ? route('permissions.update', $permission->id) : route('permissions.store') }}">
                    @csrf
                    @if(isset($permission))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Permission Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $permission->name ?? old('name') }}" required>
                        <x-input-error :messages="$errors->get('name')" class="text-danger small mt-1"/>
                    </div>

                    <button type="submit" class="btn btn-success">{{ isset($permission) ? 'Update' : 'Create' }}</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
