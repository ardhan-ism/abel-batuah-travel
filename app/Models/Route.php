<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = ['origin_city', 'destination_city', 'regular_price'];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}