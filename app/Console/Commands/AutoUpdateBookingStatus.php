<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\Schedule;
use Carbon\Carbon;

class AutoUpdateBookingStatus extends Command
{
    protected $signature = 'travel:auto-update-status';
    protected $description = 'Auto update booking status based on schedule departure time';

    public function handle()
    {
        $now = now();

        // 1) CONFIRMED -> ONGOING jika sudah lewat jam berangkat
        $confirmedToOngoing = Booking::query()
            ->join('schedules', 'schedules.id', '=', 'bookings.schedule_id')
            ->where('bookings.status', 'confirmed')
            ->where('schedules.status', 'active')
            ->whereRaw("CONCAT(schedules.departure_date,' ',schedules.departure_time) <= ?", [$now->format('Y-m-d H:i:s')])
            ->update([
                'bookings.status' => 'ongoing',
                'bookings.updated_at' => $now,
            ]);

        // 2) ONGOING -> COMPLETED jika sudah lewat +6 jam dari jam berangkat
        $cutoff = $now->copy()->subHours(6)->format('Y-m-d H:i:s');

        $ongoingToCompleted = Booking::query()
            ->join('schedules', 'schedules.id', '=', 'bookings.schedule_id')
            ->where('bookings.status', 'ongoing')
            ->where('schedules.status', 'active')
            ->whereRaw("CONCAT(schedules.departure_date,' ',schedules.departure_time) <= ?", [$cutoff])
            ->update([
                'bookings.status' => 'completed',
                'bookings.updated_at' => $now,
            ]);

        $this->info("Updated: confirmed->ongoing={$confirmedToOngoing}, ongoing->completed={$ongoingToCompleted}");

        return self::SUCCESS;
    }
}