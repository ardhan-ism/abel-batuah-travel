<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarterDetail extends Model
{
    protected $fillable = ['booking_id','end_date','total_days','driver_daily_cost','total_cost'];

    protected $casts = [
        'end_date' => 'date',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}