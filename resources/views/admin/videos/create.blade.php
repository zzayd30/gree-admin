@extends('admin.layout.app')
@section('title', 'Video Details')

@section('content')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .content-wrapper { background-color: var(--secondary-color) !important; }
    .form-card { background: #ffffff; border: none; border-radius: 25px; padding: 40px; box-shadow: 0 15px 35px rgba(36, 58, 127, 0.08); border-top: 5px solid #243a7f; }
    .form-label { font-weight: 700; color: #243a7f; text-transform: uppercase; font-size: 11px; margin-bottom: 8px; }
    .custom-input { border-radius: 12px !important; padding: 12px 15px !important; border: 1px solid #e2e8f0 !important; background-color: #f8fafc !important; }
    
    .sidebar-card { background: #f8fafc; border-radius: 20px; padding: 25px; border: 1px solid #e2e8f0; }
    .btn-submit-custom { background-color: #243a7f !important; color: white !important; padding: 14px 35px !important; border-radius: 12px !important; font-weight: 700; border: none !important; box-shadow: 0 5px 15px rgba(36, 58, 127, 0.3) !important; opacity: 1 !important; visibility: visible !important; }
    
    /* Select2 Multi-select styling */
    .select2-container--default .select2-selection--multiple { border-radius: 12px !important; border: 1px solid #e2e8f0 !important; background-color: #f8fafc !important; padding: 5px !important; }
</style>

<div class="content-header px-4 pt-4 text-start">
    <div class="container-fluid">
        <h1 class="page-title"><i class="fas fa-upload me-2"></i> {{ isset($video) ? 'Edit Video' : 'Add New Video' }}</h1>
    </div>
</div>

<section class="content px-4">
    <div class="container-fluid text-start">
        <form action="{{ isset($video) ? route('videos.update', $video->id) : route('videos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($video)) @method('PUT') @endif
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-card">
                        <div class="mb-4">
                            <label class="form-label">Video Title</label>
                            <input type="text" name="title" class="form-control custom-input" value="{{ old('title', $video->title ?? '') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control custom-input" rows="4">{{ old('description', $video->description ?? '') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Video Source Type</label>
                            <div class="d-flex gap-4">
                                <label class="d-flex align-items-center"><input type="radio" name="video_type" value="link" class="me-2" {{ old('video_type', $video->video_type ?? 'link') == 'link' ? 'checked' : '' }}> YouTube/Vimeo Link</label>
                                <label class="d-flex align-items-center"><input type="radio" name="video_type" value="upload" class="me-2" {{ old('video_type', $video->video_type ?? '') == 'upload' ? 'checked' : '' }}> Direct File Upload</label>
                            </div>
                        </div>

                        <div id="video_url_section" class="mb-4">
                            <label class="form-label">Video URL</label>
                            <input type="text" id="video_url" name="video_url" class="form-control custom-input" value="{{ old('video_url', $video->video_url ?? '') }}" placeholder="https://youtube.com/...">
                        </div>

                        <div id="video_file_section" class="mb-4" style="display: none;">
                            <label class="form-label">Upload Video File</label>
                            <input type="file" id="video_file" name="video_file" class="form-control custom-input">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Custom Thumbnail</label>
                                <input type="file" name="thumbnail" id="thumbnail" class="form-control custom-input">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Duration (e.g. 10:30)</label>
                                <input type="text" name="duration" class="form-control custom-input" value="{{ old('duration', $video->duration ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar-card">
                        <div class="mb-4">
                            <label class="form-label">Publishing Status</label>
                            <select name="status" class="form-select custom-input">
                                <option value="published" {{ old('status', $video->status ?? '') == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="draft" {{ old('status', $video->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="archived" {{ old('status', $video->status ?? '') == 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Select Categories</label>
                            <select name="categories[]" id="cat_select" class="form-select select2" multiple>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ (isset($selectedCategories) && in_array($cat->id, $selectedCategories)) ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="thumbnail-preview" class="text-center mt-3">
                            <label class="form-label d-block text-start">Thumbnail Preview</label>
                            <img id="preview-img" src="{{ isset($video->thumbnail) ? asset('storage/'.$video->thumbnail) : '' }}" class="img-fluid rounded shadow-sm" style="max-height: 150px; "{{ !isset($video->thumbnail) ? 'display:none;' : '' }}">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn-submit-custom w-100">{{ isset($video) ? 'Update Video' : 'Add Video to Library' }}</button>
                        <a href="{{ route('videos.index') }}" class="btn btn-link w-100 text-muted fw-bold mt-2 text-decoration-none">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- JS Logic for Toggle -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function toggleVideoSections() {
        const videoType = $('input[name="video_type"]:checked').val();
        if (videoType === 'link') {
            $('#video_url_section').show(); $('#video_file_section').hide();
        } else {
            $('#video_url_section').hide(); $('#video_file_section').show();
        }
    }

    $(document).ready(function() {
        toggleVideoSections();
        $('input[name="video_type"]').on('change', toggleVideoSections);
        $('#cat_select').select2({ placeholder: "Select categories..." });
        
        $('#thumbnail').on('change', function(e) {
            const reader = new FileReader();
            reader.onload = function(event) { $('#preview-img').attr('src', event.target.result).show(); };
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>
@endsection