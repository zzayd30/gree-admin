@extends('admin.layout.app')
@section('title', 'Edit Category')

@section('content')
<style>
    /* Same CSS as Create for consistency */
    .content-wrapper { background-color: var(--secondary-color) !important; }
    .form-card { background: #ffffff; border: none; border-radius: 25px; padding: 40px; box-shadow: 0 15px 35px rgba(36, 58, 127, 0.08); border-top: 5px solid #243a7f; }
    .form-label { font-weight: 700; color: #243a7f; text-transform: uppercase; font-size: 12px; margin-bottom: 8px; }
    .custom-input { border-radius: 12px !important; padding: 14px 18px !important; border: 1px solid #e2e8f0 !important; background-color: #f8fafc !important; }
    .status-tile { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 15px 20px; cursor: pointer; display: flex; align-items: center; }
    .form-check-input { position: static !important; width: 1.4em !important; height: 1.4em !important; margin: 0 !important; }
    .btn-submit-custom { background-color: #243a7f !important; color: white !important; padding: 14px 35px !important; border-radius: 12px !important; font-weight: 700; border: none !important; box-shadow: 0 5px 15px rgba(36, 58, 127, 0.3) !important; opacity: 1 !important; visibility: visible !important; }
</style>

<div class="content-header px-4 pt-4 text-start">
    <div class="container-fluid">
        <h1 class="page-title" style="color: #243a7f; font-weight: 800;"><i class="fas fa-edit me-2"></i> Edit Category</h1>
    </div>
</div>

<section class="content px-4">
    <div class="container-fluid">
        <div class="form-card text-start">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Category Name *</label>
                        <input type="text" name="name" id="cat_name" class="form-control custom-input" value="{{ old('name', $category->name) }}" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" id="cat_slug" class="form-control custom-input" value="{{ old('slug', $category->slug) }}" readonly>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control custom-input" rows="4">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="mb-5">
                    <label class="status-tile">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                        <span class="ms-3 fw-bold text-dark">Category is Active</span>
                    </label>
                </div>

                <div class="pt-4 border-top">
                    <button type="submit" class="btn-submit-custom">Update Category</button>
                    <a href="{{ route('categories.index') }}" class="ms-3 text-muted fw-bold text-decoration-none">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    document.getElementById('cat_name').addEventListener('input', function() {
        const slug = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
        document.getElementById('cat_slug').value = slug;
    });
</script>
@endsection