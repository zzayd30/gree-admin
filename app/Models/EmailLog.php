<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $fillable = [
        'sent_by',
        'recipient_email',
        'recipient_name',
        'recipient_type',
        'recipient_id',
        'subject',
        'body',
        'purpose',
        'status',
        'error_message',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sent_by');
    }

    public function recipient()
    {
        if ($this->recipient_type === 'user') {
            return $this->belongsTo(User::class, 'recipient_id');
        } elseif ($this->recipient_type === 'customer') {
            return $this->belongsTo(Customer::class, 'recipient_id');
        }
        return null;
    }
}
