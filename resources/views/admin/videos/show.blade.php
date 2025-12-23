@extends('admin.layout.app')
@section('title', 'Video Details')

@section('content')
<style>
    /* Background setup */
    .content-wrapper { background-color: var(--secondary-color) !important; padding-bottom: 50px; }
    .page-title { color: var(--primary-color); font-weight: 800; margin: 0; }

    /* Buttons Styling */
    .btn-edit-main {
        background-color: #243a7f !important; color: white !important;
        padding: 10px 25px !important; border-radius: 12px !important;
        font-weight: 700 !important; border: none !important;
        box-shadow: 0 4px 12px rgba(36, 58, 127, 0.2) !important;
        display: inline-flex !important; align-items: center; text-decoration: none !important;
    }
    .btn-back-outline {
        border: 2px solid #cbd5e1 !important; color: #64748b !important;
        padding: 8px 20px !important; border-radius: 12px !important;
        font-weight: 700 !important; text-decoration: none !important;
        background: transparent !important; display: inline-flex !important; align-items: center;
    }

    /* Video Player Box */
    .video-preview-card {
        background: #000; border-radius: 25px; overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15); position: relative;
        margin-bottom: 30px; border: 5px solid #fff;
    }
    .video-aspect-ratio { position: relative; padding-top: 56.25%; /* 16:9 Aspect Ratio */ }
    .video-aspect-ratio iframe, .video-aspect-ratio video, .video-aspect-ratio .no-video {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;
    }

    /* Info Cards */
    .modern-info-card {
        background: #ffffff; border: none; border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04); overflow: hidden;
        margin-bottom: 25px;
    }
    .card-label-header {
        background-color: var(--primary-color); color: white;
        padding: 15px 25px; font-weight: 700; font-size: 15px;
    }
    .info-group { display: flex; padding: 15px 25px; border-bottom: 1px solid #f1f4f8; align-items: center; }
    .info-key { width: 150px; font-weight: 700; color: #64748b; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; }
    .info-val { font-weight: 600; color: #1e293b; flex: 1; }

    /* Sidebar Widgets */
    .sidebar-widget {
        background: #ffffff; border-radius: 20px; padding: 25px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04); margin-bottom: 20px;
    }
    .stat-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px dashed #e2e8f0; }
    .stat-row:last-child { border-bottom: none; }
</style>

<div class="content-header px-4 pt-4 text-start">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h1 class="page-title"><i class="fas fa-play-circle me-2"></i> Video Details</h1>
                <p class="text-muted small mt-1">Review video content and technical specifications.</p>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('videos.index') }}" class="btn-back-outline me-2">
                    <i class="fas fa-arrow-left me-2"></i> Back
                </a>
                <a href="{{ route('videos.edit', $video->id) }}" class="btn-edit-main">
                    <i class="fas fa-edit me-2"></i> Edit Video
                </a>
            </div>
        </div>
    </div>
</div>

<section class="content px-4 mt-3">
    <div class="container-fluid text-start">
        <div class="row">
            <!-- Left Column: Video & Full Info -->
            <div class="col-lg-8">
                <!-- Video Preview Section -->
                <div class="video-preview-card">
                    <div class="video-aspect-ratio">
                        @if($video->video_type === 'link' && $video->video_url)
                            @php
                                $embedUrl = str_replace(['watch?v=', 'vimeo.com/'], ['embed/', 'player.vimeo.com/video/'], $video->video_url);
                            @endphp
                            <iframe src="{{ $embedUrl }}" allowfullscreen></iframe>
                        @elseif($video->video_type === 'upload' && $video->video_file)
                            <video controls poster="{{ $video->thumbnail ? asset('storage/' . $video->thumbnail) : '' }}">
                                <source src="{{ asset('storage/' . $video->video_file) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <div class="no-video bg-dark d-flex align-items-center justify-content-center flex-column text-white-50">
                                <i class="fas fa-video-slash fa-4x mb-3"></i>
                                <p>No Video Content Available</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Technical Details Table -->
                <div class="modern-info-card">
                    <div class="card-label-header"><i class="fas fa-info-circle me-2"></i> Technical Information</div>
                    <div class="info-group">
                        <div class="info-key">Video Title</div>
                        <div class="info-val" style="font-size: 18px; color: var(--primary-color);">{{ $video->title }}</div>
                    </div>
                    <div class="info-group">
                        <div class="info-key">Description</div>
                        <div class="info-val text-muted fw-normal">{{ $video->description ?? 'No description provided.' }}</div>
                    </div>
                    <div class="info-group">
                        <div class="info-key">Internal ID</div>
                        <div class="info-val">#{{ $video->id }}</div>
                    </div>
                    <div class="info-group">
                        <div class="info-key">Video Source</div>
                        <div class="info-val">
                            @if($video->video_type == 'link')
                                <span class="badge bg-primary px-3 py-2 rounded-pill"><i class="fas fa-link me-1"></i> External Link</span>
                            @else
                                <span class="badge bg-success px-3 py-2 rounded-pill"><i class="fas fa-upload me-1"></i> Direct Upload</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Stats & Quick Actions -->
            <div class="col-lg-4">
                <!-- Status & Quick Stats Widget -->
                <div class="sidebar-widget">
                    <h6 class="fw-bold mb-4 text-dark"><i class="fas fa-chart-bar me-2"></i> Quick Metadata</h6>
                    
                    <div class="stat-row">
                        <span class="text-muted">Status</span>
                        @if ($video->status == 'published')
                            <span class="badge bg-success">Published</span>
                        @elseif ($video->status == 'draft')
                            <span class="badge bg-warning">Draft</span>
                        @else
                            <span class="badge bg-secondary">Archived</span>
                        @endif
                    </div>

                    <div class="stat-row">
                        <span class="text-muted">Duration</span>
                        <strong class="text-dark">{{ $video->duration ?? 'N/A' }}</strong>
                    </div>

                    <div class="stat-row">
                        <span class="text-muted">Categories</span>
                        <span class="text-primary fw-bold">{{ $video->categories->count() }} Attached</span>
                    </div>

                    <div class="stat-row">
                        <span class="text-muted">Creator</span>
                        <span class="text-dark fw-bold">{{ $video->creator->name ?? 'Admin' }}</span>
                    </div>
                </div>

                <!-- Danger Zone Widget -->
                <div class="sidebar-widget border-top border-danger" style="border-top-width: 4px !important;">
                    <h6 class="fw-bold text-danger mb-3">Management Zone</h6>
                    <p class="small text-muted mb-4">Deleting this video will permanently remove it from the Gree portal.</p>
                    <form action="{{ route('videos.destroy', $video->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100 fw-bold rounded-pill py-2" onclick="return confirm('Confirm permanent deletion?')">
                            <i class="fas fa-trash-alt me-2"></i> Delete Video
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection