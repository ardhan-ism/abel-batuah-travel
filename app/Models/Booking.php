<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'booking_code','schedule_id','service_type',
        'passenger_name','passenger_id_number','pickup_address','phone_wa',
        'notes','seats_booked','total_price','status',
        'cancellation_deadline','cancelled_at'
    ];

    protected $casts = [
        'cancellation_deadline' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function carterDetail()
    {
        return $this->hasOne(CarterDetail::class);
    }
    public function notifications()
{
    return $this->hasMany(\App\Models\BookingNotification::class);
}
}