<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Driver;
use App\Models\Route;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $q = Schedule::with(['route', 'driver'])
            ->orderByDesc('departure_date')
            ->orderBy('departure_time');

        if ($request->filled('date')) {
            $q->where('departure_date', $request->date);
        }
        if ($request->filled('status')) {
            $q->where('status', $request->status);
        }
        if ($request->filled('route_id')) {
            $q->where('route_id', $request->route_id);
        }

        $schedules = $q->paginate(10)->withQueryString();
        $routes = Route::orderBy('origin_city')->get();

        return view('admin.schedules.index', compact('schedules', 'routes'));
    }

    public function create()
    {
        $routes = Route::orderBy('origin_city')->get();
        $drivers = Driver::orderBy('name')->get();

        return view('admin.schedules.create', compact('routes', 'drivers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'route_id' => ['required', 'exists:routes,id'],
            'driver_id' => ['nullable', 'exists:drivers,id'],
            'departure_date' => ['required', 'date'],
            'departure_time' => ['required'],
            'total_seats' => ['required', 'integer', 'min:1', 'max:6'],
            'min_passengers' => ['required', 'integer', 'min:1', 'max:6'],
            'status' => ['required', 'in:active,cancelled'],
        ]);

        // konflik sopir (tanggal + jam sama)
        if (!empty($data['driver_id'])) {
            $conflict = Schedule::where('driver_id', $data['driver_id'])
                ->where('departure_date', $data['departure_date'])
                ->where('departure_time', $data['departure_time'])
                ->exists();

            if ($conflict) {
                return back()->withErrors([
                    'driver_id' => 'Sopir bentrok dengan jadwal lain di tanggal & jam yang sama.'
                ])->withInput();
            }
        }

        // baseline kursi: selalu penuh saat jadwal dibuat
        $data['available_seats'] = (int) $data['total_seats'];

        // kolom tahap 9 (kalau sudah ada di migration)
        if (!isset($data['departure_decision'])) {
            // tidak wajib, tapi aman jika kolom ada
            // $data['departure_decision'] = 'pending';
        }

        Schedule::create($data);

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal ditambahkan.');
    }

    public function edit(Schedule $schedule)
    {
        $schedule->load(['route', 'driver']);
        $routes = Route::orderBy('origin_city')->get();
        $drivers = Driver::orderBy('name')->get();

        return view('admin.schedules.edit', compact('schedule', 'routes', 'drivers'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $data = $request->validate([
            'route_id' => ['required', 'exists:routes,id'],
            'driver_id' => ['nullable', 'exists:drivers,id'],
            'departure_date' => ['required', 'date'],
            'departure_time' => ['required'],
            'total_seats' => ['required', 'integer', 'min:1', 'max:6'],
            'available_seats' => ['required', 'integer', 'min:0', 'max:6'],
            'min_passengers' => ['required', 'integer', 'min:1', 'max:6'],
            'status' => ['required', 'in:active,cancelled'],
        ]);

        if (!empty($data['driver_id'])) {
            $conflict = Schedule::where('driver_id', $data['driver_id'])
                ->where('departure_date', $data['departure_date'])
                ->where('departure_time', $data['departure_time'])
                ->where('id', '!=', $schedule->id)
                ->exists();

            if ($conflict) {
                return back()->withErrors([
                    'driver_id' => 'Sopir bentrok dengan jadwal lain di tanggal & jam yang sama.'
                ])->withInput();
            }
        }

        // jaga available_seats jangan > total_seats
        if ((int)$data['available_seats'] > (int)$data['total_seats']) {
            return back()->withErrors([
                'available_seats' => 'Available seats tidak boleh lebih dari total seats.'
            ])->withInput();
        }

        $schedule->update($data);

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal dihapus.');
    }

    public function show(Schedule $schedule)
    {
        return redirect()->route('admin.schedules.edit', $schedule);
    }

    /**
     * Tahap 9: keputusan keberangkatan (GO / CANCEL)
     * - GO: jadwal tetap aktif
     * - CANCEL: jadwal cancelled + cancel semua booking aktif + kursi balik penuh
     */
    public function decision(Request $request, Schedule $schedule)
    {
        $data = $request->validate([
            'departure_decision' => ['required', 'in:go,cancel'],
            'decision_note' => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($schedule, $data) {
            $lockedSchedule = Schedule::whereKey($schedule->id)->lockForUpdate()->firstOrFail();

            $lockedSchedule->departure_decision = $data['departure_decision'];
            $lockedSchedule->decision_note = $data['decision_note'] ?? null;
            $lockedSchedule->decided_at = now();

            if ($data['departure_decision'] === 'go') {
                $lockedSchedule->status = 'active';
                $lockedSchedule->save();
                return;
            }

            // CANCEL schedule
            $lockedSchedule->status = 'cancelled';

            // cancel semua booking yang belum selesai agar tidak ada yang nyangkut
            $activeBookings = Booking::where('schedule_id', $lockedSchedule->id)
                ->whereIn('status', ['pending', 'confirmed', 'ongoing'])
                ->lockForUpdate()
                ->get();

            foreach ($activeBookings as $b) {
                $b->status = 'cancelled';
                $b->cancelled_at = now();
                $b->save();
            }

            // kursi balik penuh karena jadwal dibatalkan
            $lockedSchedule->available_seats = $lockedSchedule->total_seats;

            $lockedSchedule->save();
        });

        return back()->with('success', 'Keputusan jadwal berhasil disimpan.');
    }
}