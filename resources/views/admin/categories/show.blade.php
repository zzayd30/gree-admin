@extends('admin.layout.app')
@section('title', 'Category Details')

@section('content')
    <style>
        .content-wrapper {
            background-color: var(--secondary-color) !important;
        }

        .detail-card {
            background: #fff;
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .detail-header {
            background: #243a7f;
            color: #fff;
            padding: 15px 25px;
            font-weight: 700;
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
        }

        .info-value {
            font-weight: 600;
            color: #1e293b;
        }

        .btn-edit-main {
            background-color: #243a7f !important;
            color: white !important;
            padding: 10px 25px;
            border-radius: 12px;
            font-weight: 700;
            border: none;
            box-shadow: 0 4px 12px rgba(36, 58, 127, 0.2);
        }
    </style>

    <div class="content-header px-4 pt-4 text-start">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="fw-bold" style="color: #243a7f;"><i class="fas fa-info-circle me-2"></i> Category Details</h1>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('categories.index') }}"
                        class="btn btn-outline-secondary rounded-pill px-4 me-2">Back</a>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn-edit-main text-decoration-none">Edit
                        Category</a>
                </div>
            </div>
        </div>
    </div>

    <section class="content px-4 mt-3">
        <div class="container-fluid text-start">
            <div class="row">
                <div class="col-md-8">
                    <div class="detail-card">
                        <div class="detail-header">Category Information</div>
                        <div class="info-row">
                            <div class="info-label">ID</div>
                            <div class="info-value">#{{ $category->id }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Name</div>
                            <div class="info-value">{{ $category->name }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Slug</div>
                            <div class="info-value"><code>{{ $category->slug }}</code></div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Description</div>
                            <div class="info-value fw-normal text-muted">
                                {{ $category->description ?? 'No description provided.' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Status</div>
                            <div class="info-value">
                                <span
                                    class="badge {{ $category->is_active ? 'bg-success' : 'bg-secondary' }} px-3 py-2 rounded-pill">{{ $category->is_active ? 'Active' : 'Inactive' }}</span>
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Created At</div>
                            <div class="info-value">{{ $category->created_at->format('M d, Y H:i') }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="detail-card text-center p-4">
                        <h1 class="fw-bold text-primary display-4">{{ $category->videos_count }}</h1>
                        <p class="text-muted fw-bold text-uppercase small">Total Videos in this Category</p>
                        <hr>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100 rounded-pill py-2"
                                onclick="confirmDelete(event, 'This category will be deleted!')">
                                <i class="fas fa-trash me-2"></i> Delete Category
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
