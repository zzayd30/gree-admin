@extends('admin.layout.app')
@section('title', 'Add Video')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Video</h1>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('videos.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Video Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Video Type <span class="text-danger">*</span></label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="video_type"
                                                id="video_type_link" value="link"
                                                {{ old('video_type', 'link') == 'link' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="video_type_link">
                                                Video Link (YouTube/Vimeo)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="video_type"
                                                id="video_type_upload" value="upload"
                                                {{ old('video_type') == 'upload' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="video_type_upload">
                                                Upload Video File
                                            </label>
                                        </div>
                                    </div>
                                    @error('video_type')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3" id="video_url_section">
                                    <label for="video_url" class="form-label">Video URL <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('video_url') is-invalid @enderror"
                                        id="video_url" name="video_url" value="{{ old('video_url') }}"
                                        placeholder="https://youtube.com/watch?v=... or https://vimeo.com/...">
                                    <small class="form-text text-muted">Enter YouTube, Vimeo URL, or direct video
                                        link</small>
                                    @error('video_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3" id="video_file_section" style="display: none;">
                                    <label for="video_file" class="form-label">Upload Video <span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('video_file') is-invalid @enderror"
                                        id="video_file" name="video_file" accept="video/*">
                                    <small class="form-text text-muted">Max size: 100MB. Formats: MP4, MOV, AVI, WMV</small>
                                    @error('video_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="thumbnail" class="form-label">Thumbnail Image</label>
                                            <input type="file"
                                                class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail"
                                                name="thumbnail" accept="image/*">
                                            <small class="form-text text-muted">Max size: 2MB. Formats: JPEG, PNG, JPG,
                                                GIF</small>
                                            @error('thumbnail')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="duration" class="form-label">Video Duration</label>
                                            <input type="text"
                                                class="form-control @error('duration') is-invalid @enderror" id="duration"
                                                name="duration" value="{{ old('duration') }}"
                                                placeholder="e.g., 10:30 or 600">
                                            <small class="form-text text-muted">Format: MM:SS or HH:MM:SS or
                                                seconds</small>
                                            @error('duration')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select @error('status') is-invalid @enderror"
                                                id="status" name="status" required>
                                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>
                                                    Draft</option>
                                                <option value="published"
                                                    {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                                <option value="archived"
                                                    {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="categories" class="form-label">Categories</label>
                                            <select class="form-select select2 @error('categories') is-invalid @enderror"
                                                id="categories" name="categories[]" multiple>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="form-text text-muted">Select one or more categories</small>
                                            @error('categories')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div id="thumbnail-preview" class="mt-3 text-center" style="display: none;">
                                            <img id="preview-img" src="" alt="Preview"
                                                class="img-fluid rounded" style="max-height: 200px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Add Video</button>
                        <a href="{{ route('videos.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <style>
        .select2-container--default .select2-dropdown .select2-search__field:focus,
        .select2-container--default .select2-search--inline .select2-search__field:focus {
            outline: 0;
            border: none !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            background-color: transparent !important;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
            padding: 0 !important;
            margin-top: -2px !important;
        }
    </style>
@endsection

@section('customjs')
    // Video type toggle
    function toggleVideoSections() {
    const checkedRadio = document.querySelector('input[name="video_type"]:checked');

    if (!checkedRadio) {
    console.log('No radio button checked');
    return;
    }

    const videoType = checkedRadio.value;
    const urlSection = document.getElementById('video_url_section');
    const fileSection = document.getElementById('video_file_section');
    const urlInput = document.getElementById('video_url');
    const fileInput = document.getElementById('video_file');

    console.log('Video type selected:', videoType);
    console.log('URL section:', urlSection);
    console.log('File section:', fileSection);

    if (!urlSection || !fileSection || !urlInput || !fileInput) {
    console.error('Required elements not found');
    return;
    }

    if (videoType === 'link') {
    urlSection.style.display = 'block';
    fileSection.style.display = 'none';
    urlInput.removeAttribute('disabled');
    fileInput.setAttribute('disabled', 'disabled');
    } else if (videoType === 'upload') {
    urlSection.style.display = 'none';
    fileSection.style.display = 'block';
    urlInput.setAttribute('disabled', 'disabled');
    fileInput.removeAttribute('disabled');
    }
    }

    // Initialize on page load
    $(document).ready(function() {
    console.log('Video create page loaded');
    toggleVideoSections();

    // Listen for radio button changes
    $('input[name="video_type"]').on('change', function() {
    console.log('Radio changed to:', this.value);
    toggleVideoSections();
    });

    // Thumbnail preview
    $('#thumbnail').on('change', function(e) {
    const file = e.target.files[0];
    if (file) {
    const reader = new FileReader();
    reader.onload = function(event) {
    $('#preview-img').attr('src', event.target.result);
    $('#thumbnail-preview').show();
    };
    reader.readAsDataURL(file);
    }
    });
    });
@endsection
