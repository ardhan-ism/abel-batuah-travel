<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingNotification extends Model
{
    protected $fillable = [
        'booking_id','type','target_phone','is_success',
        'provider','provider_message_id','provider_response','sent_at'
    ];

    protected $casts = [
        'provider_response' => 'array',
        'sent_at' => 'datetime',
        'is_success' => 'boolean',
    ];
}