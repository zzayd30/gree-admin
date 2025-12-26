@extends('admin.layout.app')
@section('title', 'Video Categories')

@section('content')
    <style>
        
    </style>

    <div class="content-header px-4 pt-4">
        <div class="container-fluid">
            <div class="row align-items-center text-start">
                <div class="col-sm-6">
                    <h1 class="page-title"><i class="fas fa-folder-open me-2"></i> Video Categories</h1>
                    <p class="text-muted small mb-0 mt-1">Manage categories to organize your video library.</p>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('categories.create') }}" class="btn-create-custom">
                        <i class="fas fa-plus-circle me-1"></i> Create Category
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="content px-4">
        <div class="container-fluid">
            <div class="modern-card shadow-sm">
                <div class="table-responsive">
                    <table class="table modern-table mb-0">
                        <thead>
                            <tr>
                                <th>Name & Slug</th>
                                <th class="text-center">Videos</th>
                                <th class="text-center">Status</th>
                                <th>Created At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark" style="font-size: 15px;">{{ $category->name }}</div>
                                        <code class="small text-pink" style="color: #d63384;">{{ $category->slug }}</code>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-primary border px-3 py-2 rounded-pill">
                                            <i class="fas fa-video me-1"></i> {{ $category->videos_count }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="status-badge {{ $category->is_active ? 'bg-active' : 'bg-inactive' }}">
                                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="text-muted small">{{ $category->created_at->format('M d, Y') }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('categories.show', $category->id) }}" class="btn-action-sm"
                                                style="background-color: #17a2b8; color: #fff;" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn-action-sm"
                                                style="background-color: #ffc107; color: #000;" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-action-sm"
                                                    style="background-color: #dc3545; color: #fff;"
                                                    onclick="confirmDelete(event, 'This category will be deleted!')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">No categories found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-4 py-3 border-top">{{ $categories->links('pagination::bootstrap-5') }}</div>
            </div>
        </div>
    </section>
@endsection
