<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $q = Booking::with(['schedule.route','schedule.driver'])->orderByDesc('created_at');

        if ($request->filled('status')) $q->where('status', $request->status);
        if ($request->filled('service_type')) $q->where('service_type', $request->service_type);
        if ($request->filled('date')) $q->whereHas('schedule', fn($s) => $s->where('departure_date', $request->date));
        if ($request->filled('code')) $q->where('booking_code', 'like', '%'.$request->code.'%');

        $bookings = $q->paginate(10)->withQueryString();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['schedule.route','schedule.driver','carterDetail','notifications']);
        return view('admin.bookings.show', compact('booking'));
    }

 public function updateStatus(Request $request, \App\Models\Booking $booking)
{
    $data = $request->validate([
        'status' => ['required','in:pending,confirmed,ongoing,completed,cancelled'],
    ]);

    // aturan sederhana: completed tidak boleh mundur
    if ($booking->status === 'completed' && $data['status'] !== 'completed') {
        return back()->withErrors(['status' => 'Booking sudah selesai, status tidak boleh diubah.']);
    }

    DB::transaction(function () use ($booking, $data) {
        // lock booking & schedule biar aman
        $lockedBooking = \App\Models\Booking::whereKey($booking->id)->lockForUpdate()->firstOrFail();
        $schedule = \App\Models\Schedule::whereKey($lockedBooking->schedule_id)->lockForUpdate()->first();

        $oldStatus = $lockedBooking->status;
        $newStatus = $data['status'];

        // update status booking
        $lockedBooking->status = $newStatus;

        if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
            $lockedBooking->cancelled_at = now();

            // restore kursi saat admin cancel
            if ($schedule) {
                $restore = (int)$lockedBooking->seats_booked;
                $schedule->available_seats = min(
                    (int)$schedule->total_seats,
                    (int)$schedule->available_seats + $restore
                );
                $schedule->save();
            }
        }

        // (opsional) kalau admin mengubah dari cancelled -> pending/confirmed,
        // maka kursi harus dikurangi lagi agar konsisten
        if ($oldStatus === 'cancelled' && $newStatus !== 'cancelled') {
            if ($schedule) {
                $take = (int)$lockedBooking->seats_booked;

                if ((int)$schedule->available_seats < $take) {
                    throw new \Exception('Kursi tidak mencukupi untuk mengaktifkan kembali booking ini.');
                }

                $schedule->available_seats = (int)$schedule->available_seats - $take;
                $schedule->save();
            }

            $lockedBooking->cancelled_at = null;
        }

        $lockedBooking->save();
    });

    return back()->with('success','Status booking diperbarui.');
}
}