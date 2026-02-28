<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'route_id','driver_id','departure_date','departure_time',
        'total_seats','available_seats','status','min_passengers', 'departure_decision','decision_note','decided_at'
    ];

    protected $casts = [
        'departure_date' => 'date',
  'decided_at' => 'datetime',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // helper untuk datetime (berguna nanti)
    public function departureDateTime(): \Carbon\Carbon
    {
        return \Carbon\Carbon::parse($this->departure_date->format('Y-m-d') . ' ' . $this->departure_time);
    }
}