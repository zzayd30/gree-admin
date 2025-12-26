@extends('admin.layout.app')
@section('title', 'Videos Library')

@section('content')
    <style>
        .content-wrapper {
            background-color: var(--secondary-color) !important;
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 800;
        }

        .btn-create-custom {
            background-color: #243a7f !important;
            color: white !important;
            padding: 10px 25px !important;
            border-radius: 12px !important;
            font-weight: 700;
            display: inline-block !important;
            text-decoration: none !important;
            box-shadow: 0 4px 12px rgba(36, 58, 127, 0.2) !important;
        }

        

        .video-thumb {
            width: 80px;
            height: 50px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid #fff;
        }

        .status-pill {
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .bg-published {
            background-color: #d1fae5;
            color: #065f46;
        }

        .bg-draft {
            background-color: #fef3c7;
            color: #92400e;
        }

        .btn-action-sm {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            margin: 0 2px;
        }
    </style>

    <div class="content-header px-4 pt-4">
        <div class="container-fluid">
            <div class="row align-items-center text-start">
                <div class="col-sm-6">
                    <h1 class="page-title"><i class="fas fa-video me-2"></i> Videos Management</h1>
                    <p class="text-muted small">Organize and manage your video content library.</p>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('videos.create') }}" class="btn-create-custom"><i class="fas fa-plus-circle me-1"></i>
                        Add New Video</a>
                </div>
            </div>
        </div>
    </div>

    <section class="content px-4">
        <div class="container-fluid">
            <div class="modern-card">
                <div class="table-responsive">
                    <table class="table modern-table mb-0">
                        <thead>
                            <tr>
                                <th>Thumbnail</th>
                                <th>Video Title</th>
                                <th>Categories</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($videos as $video)
                                <tr>
                                    <td>
                                        @if ($video->thumbnail)
                                            <img src="{{ asset('storage/' . $video->thumbnail) }}" class="video-thumb">
                                        @else
                                            <div
                                                class="bg-light d-flex align-items-center justify-content-center video-thumb">
                                                <i class="fas fa-video text-muted"></i></div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ Str::limit($video->title, 40) }}</div>
                                        <div class="text-muted small"><i
                                                class="fas fa-clock me-1"></i>{{ $video->duration ?? 'N/A' }}</div>
                                    </td>
                                    <td>
                                        @foreach ($video->categories as $category)
                                            <span class="badge bg-light text-primary border">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <span
                                            class="status-pill {{ $video->status == 'published' ? 'bg-published' : 'bg-draft' }}">
                                            {{ $video->status }}
                                        </span>
                                    </td>
                                    <td class="small text-muted">{{ $video->creator->name ?? 'N/A' }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('videos.show', $video->id) }}" class="btn-action-sm"
                                                style="background-color: #17a2b8; color: #fff;"><i
                                                    class="fas fa-eye"></i></a>
                                            <a href="{{ route('videos.edit', $video->id) }}" class="btn-action-sm"
                                                style="background-color: #ffc107; color: #000;"><i
                                                    class="fas fa-edit"></i></a>
                                            <form action="{{ route('videos.destroy', $video->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-action-sm"
                                                    style="background-color: #dc3545; color: #fff;"
                                                    onclick="confirmDelete(event, 'This video will be deleted!')"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">No videos found in library.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-4 py-3 border-top">{{ $videos->links('pagination::bootstrap-5') }}</div>
            </div>
        </div>
    </section>
@endsection
