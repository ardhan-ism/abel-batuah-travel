<?php

namespace App\Services;

use App\Models\Booking;
use Carbon\Carbon;

class BookingWhatsappNotifier
{
    public function statusMessage(Booking $booking, string $title, ?string $note = null): string
    {
        $booking->loadMissing(['schedule.route']);

        $schedule = $booking->schedule;
        $route = $schedule->route;

        $dt = Carbon::parse($schedule->departure_date->toDateString() . ' ' . $schedule->departure_time)
            ->format('d-m-Y H:i');

        $lines = [
            "📌 {$title}",
            "",
            "Kode Booking: *{$booking->booking_code}*",
            "Status: *" . strtoupper($booking->status) . "*",
            "Nama: {$booking->passenger_name}",
            "Rute: {$route->origin_city} → {$route->destination_city}",
            "Jadwal: {$dt}",
            "Total: Rp " . number_format($booking->total_price, 0, ',', '.'),
        ];

        if ($note) {
            $lines[] = "";
            $lines[] = "Catatan: {$note}";
        }

        $lines[] = "";
        $lines[] = "Cek status di website dengan kode booking + nomor WA.";

        return implode("\n", $lines);
    }

    public function shouldNotify(string $status): bool
    {
        return in_array($status, ['confirmed', 'cancelled', 'ongoing', 'completed'], true);
    }

    public function noteForStatus(string $status, string $actor): string
    {
        return match ($status) {
            'confirmed' => "Booking Anda telah dikonfirmasi ({$actor}).",
            'cancelled' => "Booking dibatalkan ({$actor}).",
            'ongoing' => "Perjalanan sedang berlangsung ({$actor}).",
            'completed' => "Perjalanan telah selesai ({$actor}).",
            default => "Status diperbarui ({$actor}).",
        };
    }
}