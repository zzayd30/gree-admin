@extends('admin.layout.app')
@section('title', 'View Video')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Video Details</h1>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('videos.index') }}" class="btn btn-secondary">Back</a>
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
                            <h3 class="card-title">{{ $video->title }}</h3>
                        </div>
                        <div class="card-body">
                            @if ($video->thumbnail)
                                <div class="mb-3 text-center">
                                    <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="Thumbnail"
                                        class="img-fluid rounded" style="max-height: 400px;">
                                </div>
                            @endif

                            <div class="mb-3">
                                <h5>Description</h5>
                                <p>{{ $video->description ?? 'No description available' }}</p>
                            </div>

                            <div class="mb-3">
                                <h5>Video Type</h5>
                                @if ($video->video_type === 'link')
                                    <span class="badge bg-primary"><i class="fas fa-link"></i> Video Link</span>
                                @else
                                    <span class="badge bg-success"><i class="fas fa-upload"></i> Uploaded Video</span>
                                @endif
                            </div>

                            @if ($video->video_type === 'link' && $video->video_url)
                                <div class="mb-3">
                                    <h5>Video URL</h5>
                                    <a href="{{ $video->video_url }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-external-link-alt"></i> Open Video
                                    </a>
                                    <br>
                                    <small class="text-muted">{{ $video->video_url }}</small>
                                </div>
                            @elseif($video->video_type === 'upload' && $video->video_file)
                                <div class="mb-3">
                                    <h5>Video File</h5>
                                    <video controls class="w-100" style="max-height: 400px;">
                                        <source src="{{ asset('storage/' . $video->video_file) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <br>
                                    <small class="text-muted">{{ basename($video->video_file) }}</small>
                                </div>
                            @endif

                            <table class="table table-bordered mt-3">
                                <tr>
                                    <th width="200">ID</th>
                                    <td>{{ $video->id }}</td>
                                </tr>
                                <tr>
                                    <th>Duration</th>
                                    <td>{{ $video->duration ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if ($video->status == 'published')
                                            <span class="badge bg-success">Published</span>
                                        @elseif ($video->status == 'draft')
                                            <span class="badge bg-warning">Draft</span>
                                        @else
                                            <span class="badge bg-secondary">Archived</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Views Count</th>
                                    <td>{{ number_format($video->views_count) }}</td>
                                </tr>
                                <tr>
                                    <th>Categories</th>
                                    <td>
                                        @forelse ($video->categories as $category)
                                            <span class="badge bg-info">{{ $category->name }}</span>
                                        @empty
                                            <span class="text-muted">No categories assigned</span>
                                        @endforelse
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created By</th>
                                    <td>{{ $video->creator->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $video->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $video->updated_at->format('Y-m-d H:i:s') }}</td>
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
                            <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-warning btn-block mb-2">
                                <i class="fas fa-edit"></i> Edit Video
                            </a>
                            <form action="{{ route('videos.destroy', $video->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-block"
                                    onclick="return confirm('Are you sure you want to delete this video?')">
                                    <i class="fas fa-trash"></i> Delete Video
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Quick Stats</h3>
                        </div>
                        <div class="card-body">
                            {{-- <div class="d-flex justify-content-between mb-2">
                                <span><i class="fas fa-eye"></i> Views:</span>
                                <strong>{{ number_format($video->views_count) }}</strong>
                            </div> --}}
                            <div class="d-flex justify-content-between mb-2">
                                <span><i class="fas fa-folder"></i> Categories:</span>
                                <strong>{{ $video->categories->count() }}</strong>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span><i class="fas fa-clock"></i> Duration:</span>
                                <strong>{{ $video->duration ?? 'N/A' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
