<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:View Videos')->only(['index', 'show']);
        $this->middleware('permission:Create Videos')->only(['create', 'store']);
        $this->middleware('permission:Edit Videos')->only(['edit', 'update']);
        $this->middleware('permission:Delete Videos')->only('destroy');
    }

    public function index()
    {
        $videos = Video::with(['categories', 'creator'])
            ->where('deleted', false)
            ->latest()
            ->paginate(10);
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->where('deleted', false)->orderBy('name')->get();
        return view('admin.videos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'video_type' => ['required', 'in:link,upload'],
            'video_url' => ['required_if:video_type,link', 'nullable', 'string', 'max:500'],
            'video_file' => ['required_if:video_type,upload', 'nullable', 'file', 'mimes:mp4,mov,avi,wmv', 'max:102400'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'duration' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'in:draft,published,archived'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['exists:categories,id'],
        ]);

        // Handle thumbnail upload
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('video-thumbnails', 'public');
        }

        // Handle video file upload
        $videoFilePath = null;
        if ($request->video_type === 'upload' && $request->hasFile('video_file')) {
            $videoFilePath = $request->file('video_file')->store('videos', 'public');
        }

        $video = Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'video_type' => $request->video_type,
            'video_url' => $request->video_type === 'link' ? $request->video_url : null,
            'video_file' => $videoFilePath,
            'thumbnail' => $thumbnailPath,
            'duration' => $request->duration,
            'status' => $request->status,
            'created_by' => Auth::id(),
        ]);

        // Attach categories with created_by
        if ($request->categories) {
            $categoryData = [];
            foreach ($request->categories as $categoryId) {
                $categoryData[$categoryId] = ['created_by' => Auth::id()];
            }
            $video->categories()->attach($categoryData);
        }

        return redirect()->route('videos.index')->with('success', 'Video created successfully.');
    }

    public function show(Video $video)
    {
        $video->load(['categories', 'creator']);
        // dd($video);
        return view('admin.videos.show', compact('video'));
    }

    public function edit(Video $video)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $selectedCategories = $video->categories->pluck('id')->toArray();
        return view('admin.videos.edit', compact('video', 'categories', 'selectedCategories'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'video_type' => ['required', 'in:link,upload'],
            'video_url' => ['required_if:video_type,link', 'nullable', 'string', 'max:500'],
            'video_file' => ['required_if:video_type,upload', 'nullable', 'file', 'mimes:mp4,mov,avi,wmv', 'max:102400'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'duration' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'in:draft,published,archived'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['exists:categories,id'],
        ]);

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($video->thumbnail) {
                Storage::disk('public')->delete($video->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('video-thumbnails', 'public');
            $video->thumbnail = $thumbnailPath;
        }

        // Handle video file upload
        if ($request->video_type === 'upload' && $request->hasFile('video_file')) {
            // Delete old video file
            if ($video->video_file) {
                Storage::disk('public')->delete($video->video_file);
            }
            $videoFilePath = $request->file('video_file')->store('videos', 'public');
            $video->video_file = $videoFilePath;
        }

        $video->update([
            'title' => $request->title,
            'description' => $request->description,
            'video_type' => $request->video_type,
            'video_url' => $request->video_type === 'link' ? $request->video_url : null,
            'duration' => $request->duration,
            'status' => $request->status,
        ]);

        // Sync categories with created_by
        if ($request->has('categories')) {
            $categoryData = [];
            foreach ($request->categories as $categoryId) {
                $categoryData[$categoryId] = ['created_by' => Auth::id()];
            }
            $video->categories()->sync($categoryData);
        } else {
            $video->categories()->detach();
        }

        return redirect()->route('videos.index')->with('success', 'Video updated successfully.');
    }

    public function destroy(Video $video)
    {
        // Delete thumbnail if exists
        if ($video->thumbnail) {
            Storage::disk('public')->delete($video->thumbnail);
        }

        // Delete video file if exists
        if ($video->video_file) {
            Storage::disk('public')->delete($video->video_file);
        }

        $video->update(['deleted' => true]);
        return redirect()->route('videos.index')->with('success', 'Video deleted successfully.');
    }
}