@extends('admin.layout.app')
@section('title', 'Edit Profile')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Profile</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <!-- Profile Information -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Profile Information</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="company" class="form-label">Company</label>
                                    <input type="text" class="form-control @error('company') is-invalid @enderror"
                                        id="company" name="company" value="{{ old('company', $user->company) }}" required>
                                    @error('company')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="type_of_business" class="form-label">Type of Business</label>
                                    <select class="form-select select2 @error('type_of_business') is-invalid @enderror"
                                        id="type_of_business" name="type_of_business" required>
                                        <option value="" disabled>Select Type of Business</option>
                                        @foreach ($type_of_business as $businessType)
                                            <option value="{{ $businessType->id }}"
                                                {{ old('type_of_business', $user->type_of_business_id) == $businessType->id ? 'selected' : '' }}>
                                                {{ $businessType->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('type_of_business')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="profile_picture" class="form-label">Profile Picture</label>
                                    <input type="file"
                                        class="form-control @error('profile_picture') is-invalid @enderror"
                                        id="profile_picture" name="profile_picture" accept="image/*">
                                    @error('profile_picture')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB</small>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Profile Picture & Password -->
                <div class="col-md-4">
                    <!-- Profile Picture Preview -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Profile Picture</h3>
                        </div>
                        <div class="card-body text-center">
                            @if ($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"
                                    class="img-fluid rounded-circle"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center"
                                    style="width: 150px; height: 150px;">
                                    <i class="fas fa-user fa-4x text-white"></i>
                                </div>
                            @endif
                            <p class="mt-3 mb-0"><strong>{{ $user->name }}</strong></p>
                            <p class="text-muted">{{ $user->email }}</p>
                        </div>
                    </div>

                    <!-- Change Password -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile.password') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        id="current_password" name="current_password" required>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" required>
                                </div>

                                <button type="submit" class="btn btn-warning w-100">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
