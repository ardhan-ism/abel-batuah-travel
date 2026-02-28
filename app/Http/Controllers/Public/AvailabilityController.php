<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\Schedule;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function index()
    {
        $origins = Route::query()
            ->select('origin_city')
            ->distinct()
            ->orderBy('origin_city')
            ->pluck('origin_city');

        return view('public.availability.index', [
            'origins' => $origins,
        ]);
    }

    public function destinations(Request $request)
    {
        $request->validate([
            'origin' => ['required', 'string'],
        ]);

        $destinations = Route::query()
            ->where('origin_city', $request->origin)
            ->select('destination_city')
            ->distinct()
            ->orderBy('destination_city')
            ->pluck('destination_city');

        return response()->json($destinations);
    }

    public function search(Request $request)
    {
        $request->validate([
            'origin' => ['required', 'string'],
            'destination' => ['required', 'string'],
            'date' => ['required', 'date'],
        ]);

        $route = Route::query()
            ->where('origin_city', $request->origin)
            ->where('destination_city', $request->destination)
            ->first();

        if (!$route) {
            return back()->withErrors(['route' => 'Rute tidak ditemukan.'])->withInput();
        }

$schedules = Schedule::query()
    ->with(['route', 'driver'])
    ->where('route_id', $route->id)
    ->where('departure_date', $request->date)
    ->where('status', 'active')
    ->whereRaw("CONCAT(departure_date,' ',departure_time) >= ?", [now()->format('Y-m-d H:i:s')])
    ->orderBy('departure_time')
    ->get();

        return view('public.availability.results', [
            'route' => $route,
            'date' => $request->date,
            'schedules' => $schedules,
        ]);
    }
}