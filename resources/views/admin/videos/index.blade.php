@extends('admin.layout.app')
@section('title', 'Videos')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Videos</h1>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('videos.create') }}" class="btn btn-primary">Add Video</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="80">ID</th>
                                <th>Thumbnail</th>
                                <th>Title</th>
                                <th>Categories</th>
                                <th>Duration</th>
                                <th>Status</th>
                                {{-- <th>Views</th> --}}
                                <th>Created By</th>
                                <th>Created At</th>
                                <th width="200">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($videos as $video)
                                <tr>
                                    <td>{{ $video->id }}</td>
                                    <td>
                                        @if ($video->thumbnail)
                                            <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="Thumbnail"
                                                class="img-thumbnail" style="width: 60px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                                                style="width: 60px; height: 40px;">
                                                <i class="fas fa-video"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($video->title, 40) }}</td>
                                    <td>
                                        @forelse ($video->categories as $category)
                                            <span class="badge bg-info">{{ $category->name }}</span>
                                        @empty
                                            <span class="text-muted">No categories</span>
                                        @endforelse
                                    </td>
                                    <td>{{ $video->duration ?? 'N/A' }}</td>
                                    <td>
                                        @if ($video->status == 'published')
                                            <span class="badge bg-success">Published</span>
                                        @elseif ($video->status == 'draft')
                                            <span class="badge bg-warning">Draft</span>
                                        @else
                                            <span class="badge bg-secondary">Archived</span>
                                        @endif
                                    </td>
                                    {{-- <td>{{ number_format($video->views_count) }}</td> --}}
                                    <td>{{ $video->creator->name ?? 'N/A' }}</td>
                                    <td>{{ $video->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('videos.show', $video->id) }}" class="btn btn-sm btn-info"
                                            title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-sm btn-warning"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('videos.destroy', $video->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Delete this video?')" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">No videos found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $videos->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection
