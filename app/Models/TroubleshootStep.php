<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TroubleshootStep extends Model
{
    protected $fillable = [
        'troubleshoot_error_code_id',
        'step_number',
        'action',
        'tips',
        'sensor_type',
        'sensor_types',
    ];

    protected $casts = [
        'tips' => 'array',
        'sensor_types' => 'array',
    ];

    // Relationship with troubleshoot error code
    public function troubleshootErrorCode()
    {
        return $this->belongsTo(TroubleshootErrorCode::class);
    }
}
