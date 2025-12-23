@extends('admin.layout.app')
@section('title', 'View Category')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Category Details</h1>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Category Information</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="200">ID</th>
                                    <td>{{ $category->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $category->name }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td><code>{{ $category->slug }}</code></td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $category->description ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if ($category->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Videos Count</th>
                                    <td>
                                        <span class="badge bg-info">{{ $category->videos_count }} videos</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $category->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $category->updated_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Actions</h3>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-block mb-2">
                                <i class="fas fa-edit"></i> Edit Category
                            </a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-block"
                                    onclick="return confirm('Are you sure you want to delete this category?')">
                                    <i class="fas fa-trash"></i> Delete Category
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
