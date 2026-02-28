<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingStatusController extends Controller
{
    public function form()
    {
        return view('public.booking.status_form');
    }

    public function show(Request $request)
    {
        $request->validate([
            'booking_code' => ['required', 'string'],
            'phone_wa' => ['required', 'string'],
        ]);

        $code = strtoupper(trim($request->booking_code));
        $phone = $this->normalizePhone($request->phone_wa);

        $booking = Booking::with(['schedule.route', 'carterDetail'])
            ->where('booking_code', $code)
            ->where('phone_wa', $phone)
            ->first();

        if (!$booking) {
            return back()->withErrors([
                'notfound' => 'Booking tidak ditemukan. Pastikan kode booking & nomor WA benar.'
            ])->withInput();
        }

        return view('public.booking.status_show', [
            'booking' => $booking,
            'canCancel' => $this->canCancel($booking),
        ]);
    }

    public function cancel(Request $request)
    {
        $request->validate([
            'booking_code' => ['required', 'string'],
            'phone_wa' => ['required', 'string'],
        ]);

        $code = strtoupper(trim($request->booking_code));
        $phone = $this->normalizePhone($request->phone_wa);

        $result = DB::transaction(function () use ($code, $phone) {
            $booking = Booking::lockForUpdate()
                ->where('booking_code', $code)
                ->where('phone_wa', $phone)
                ->first();

            if (!$booking) {
                return ['ok' => false, 'error' => 'Booking tidak ditemukan.'];
            }

            if ($booking->status === 'cancelled') {
                return ['ok' => false, 'error' => 'Booking sudah dibatalkan.'];
            }

            if (!in_array($booking->status, ['pending', 'confirmed'], true)) {
                return ['ok' => false, 'error' => 'Booking tidak bisa dibatalkan karena sudah diproses/perjalanan.'];
            }

            if (!$booking->cancellation_deadline) {
                return ['ok' => false, 'error' => 'Deadline pembatalan tidak tersedia. Hubungi admin.'];
            }

            if (now()->greaterThan($booking->cancellation_deadline)) {
                return ['ok' => false, 'error' => 'Pembatalan ditolak karena melewati batas waktu pembatalan.'];
            }

            // Lock schedule agar update kursi aman
            $schedule = Schedule::lockForUpdate()->find($booking->schedule_id);
            if (!$schedule) {
                return ['ok' => false, 'error' => 'Jadwal tidak ditemukan. Hubungi admin.'];
            }

            // 1) cancel booking
            $booking->status = 'cancelled';
            $booking->cancelled_at = now();
            $booking->save();

            // 2) restore kursi sesuai seats_booked
            $restore = max(0, (int)$booking->seats_booked);

            $schedule->available_seats = min(
                (int)$schedule->total_seats,
                (int)$schedule->available_seats + $restore
            );

            $schedule->save();

            return ['ok' => true];
        });

        if (!$result['ok']) {
            return back()->withErrors(['cancel' => $result['error']])->withInput();
        }

        return redirect()->route('public.booking.status.form')
            ->with('success', 'Booking berhasil dibatalkan. Kursi telah dikembalikan.');
    }

    private function canCancel(Booking $booking): bool
    {
        if ($booking->status === 'cancelled') return false;
        if (!in_array($booking->status, ['pending', 'confirmed'], true)) return false;
        if (!$booking->cancellation_deadline) return false;

        return now()->lessThanOrEqualTo($booking->cancellation_deadline);
    }

    private function normalizePhone(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }
        return $phone;
    }
}