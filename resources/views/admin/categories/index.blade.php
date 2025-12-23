@extends('admin.layout.app')
@section('title', 'Categories')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Video Categories</h1>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">Create Category</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Videos Count</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td><code>{{ $category->slug }}</code></td>
                                    <td>
                                        <span class="badge bg-info">{{ $category->videos_count }} videos</span>
                                    </td>
                                    <td>
                                        @if ($category->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('categories.show', $category->id) }}"
                                            class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Delete this category? This will only work if there are no videos in this category.')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No categories found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $categories->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection
