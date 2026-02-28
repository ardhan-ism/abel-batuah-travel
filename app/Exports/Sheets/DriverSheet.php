<?php

namespace App\Exports\Sheets;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class DriverSheet implements FromCollection, WithHeadings, WithTitle
{
    public function __construct(
        protected string $from,
        protected string $to
    ) {}

    public function title(): string
    {
        return 'Per Sopir';
    }

    public function headings(): array
    {
        return ['Sopir', 'Jumlah Booking', 'Pendapatan'];
    }

    public function collection()
    {
        return Booking::query()
            ->whereBetween(DB::raw('DATE(bookings.created_at)'), [$this->from, $this->to])
            ->whereIn('bookings.status', ['confirmed','ongoing','completed'])
            ->join('schedules', 'schedules.id', '=', 'bookings.schedule_id')
            ->leftJoin('drivers', 'drivers.id', '=', 'schedules.driver_id')
            ->selectRaw('COALESCE(drivers.name,"(Belum ditentukan)") as sopir, COUNT(*) as jumlah_booking, SUM(bookings.total_price) as pendapatan')
            ->groupBy('sopir')
            ->orderByDesc('pendapatan')
            ->get();
    }
}