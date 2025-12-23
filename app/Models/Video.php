<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title',
        'description',
        'video_type',
        'video_url',
        'video_file',
        'thumbnail',
        'duration',
        'status',
        'views_count',
        'created_by',
    ];

    protected $casts = [
        'views_count' => 'integer',
    ];

    // Relationship with categories (many-to-many)
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_video');
    }

    // Relationship with creator
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scope for published videos
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope for draft videos
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }
}
