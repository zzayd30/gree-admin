<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TroubleshootErrorCode extends Model
{
    protected $fillable = [
        'name',
        'status',
        'created_by',
    ];

    // Relationship with steps
    public function steps()
    {
        return $this->hasMany(TroubleshootStep::class)->orderBy('step_number');
    }

    // Relationship with creator
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scope for active troubleshoots
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for inactive troubleshoots
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }
}
