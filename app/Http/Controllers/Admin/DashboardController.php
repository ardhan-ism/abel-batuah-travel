<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $tomorrow = now()->addDay()->toDateString();

$minAlerts = Schedule::with(['route','driver'])
    ->where('departure_date', $tomorrow)
    ->where('status', 'active')
    ->get()
    ->map(function ($s) {
        $confirmedSeats = $s->bookings()
            ->whereIn('status', ['confirmed','ongoing','completed'])
            ->sum('seats_booked');

        $s->confirmed_seats = (int)$confirmedSeats;
        $s->is_under_min = $s->confirmed_seats < $s->min_passengers;
        return $s;
    })
    ->filter(fn($s) => $s->is_under_min)
    ->values();
    
        $today = now()->toDateString();

        $totalToday = Booking::whereDate('created_at', $today)->count();
        $active = Booking::whereIn('status', ['pending','confirmed','ongoing'])->count();
        $revenueToday = Booking::whereDate('created_at', $today)
            ->whereIn('status', ['confirmed','ongoing','completed'])
            ->sum('total_price');

        return view('admin.dashboard', compact('totalToday','active','revenueToday'));
    }
}