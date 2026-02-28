<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\BookingNotification;
use App\Services\FonnteService;
use App\Services\SettingService;
use Carbon\Carbon;

class SendBookingReminders extends Command
{
    protected $signature = 'travel:send-reminders';
    protected $description = 'Send WhatsApp reminders for confirmed bookings before departure';

    public function handle(FonnteService $wa, SettingService $settings)
    {
        $now = now();

        $regularHours = (int) $settings->getInt('reminder_regular_hours', 6);
        $carterHours  = (int) $settings->getInt('reminder_carter_hours', 24);

        // window pencarian (biar command yang tiap 5 menit gak kelewat)
        // Kita cari booking dengan departure_time antara now+(X jam) s/d now+(X jam)+10 menit
        $windowMinutes = 10;

        $sent = 0;
        $failed = 0;

        // PROSES 1: reminder reguler H-6 jam
        $sent += $this->processType(
            type: "reminder_{$regularHours}h_regular",
            serviceType: 'regular',
            hoursBefore: $regularHours,
            windowMinutes: $windowMinutes,
            now: $now,
            wa: $wa,
            failed: $failed
        );

        // PROSES 2: reminder carter H-24 jam (opsional)
        $sent += $this->processType(
            type: "reminder_{$carterHours}h_carter",
            serviceType: 'carter',
            hoursBefore: $carterHours,
            windowMinutes: $windowMinutes,
            now: $now,
            wa: $wa,
            failed: $failed
        );

        $this->info("Reminder sent={$sent}, failed={$failed}");
        return self::SUCCESS;
    }

    private function processType(
        string $type,
        string $serviceType,
        int $hoursBefore,
        int $windowMinutes,
        Carbon $now,
        FonnteService $wa,
        int &$failed
    ): int {
        $from = $now->copy()->addHours($hoursBefore);
        $to   = $from->copy()->addMinutes($windowMinutes);

        // Ambil booking confirmed yang jadwalnya aktif dan masuk window
        $bookings = Booking::query()
            ->with(['schedule.route'])
            ->where('service_type', $serviceType)
            ->where('status', 'confirmed')
            ->whereHas('schedule', function ($q) use ($from, $to) {
                $q->where('status', 'active')
                  ->whereRaw("CONCAT(departure_date,' ',departure_time) >= ?", [$from->format('Y-m-d H:i:s')])
                  ->whereRaw("CONCAT(departure_date,' ',departure_time) <= ?", [$to->format('Y-m-d H:i:s')]);
            })
            ->get();

        $sent = 0;

        foreach ($bookings as $b) {
            // Anti dobel: cek sudah pernah kirim tipe ini belum
            $exists = BookingNotification::where('booking_id', $b->id)
                ->where('type', $type)
                ->exists();

            if ($exists) continue;

            $schedule = $b->schedule;
            $route = $schedule->route;

            $dt = Carbon::parse($schedule->departure_date->toDateString() . ' ' . $schedule->departure_time)
                ->format('d-m-Y H:i');

            $message = $this->buildMessage($b->booking_code, $b->passenger_name, $serviceType, $route->origin_city, $route->destination_city, $dt, $b->pickup_address);

            $res = $wa->send($b->phone_wa, $message);

            BookingNotification::create([
                'booking_id' => $b->id,
                'type' => $type,
                'target_phone' => $b->phone_wa,
                'is_success' => (bool)($res['ok'] ?? false),
                'provider' => 'fonnte',
                'provider_message_id' => $res['body']['id'][0] ?? null,
                'provider_response' => $res,
                'sent_at' => now(),
            ]);

            if (($res['ok'] ?? false) === true) $sent++;
            else $failed++;
        }

        return $sent;
    }

    private function buildMessage(
        string $code,
        string $name,
        string $serviceType,
        string $origin,
        string $dest,
        string $dt,
        string $pickup
    ): string {
        return implode("\n", [
            "⏰ *Reminder Keberangkatan* - CV Abel Batuah Travel",
            "",
            "Kode Booking: *{$code}*",
            "Nama: {$name}",
            "Layanan: " . strtoupper($serviceType),
            "Rute: {$origin} → {$dest}",
            "Jadwal: {$dt}",
            "Alamat Jemput: {$pickup}",
            "",
            "Jika ada perubahan, silakan hubungi admin.",
        ]);
    }
}