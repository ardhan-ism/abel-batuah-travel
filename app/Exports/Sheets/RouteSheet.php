<?php

namespace App\Exports\Sheets;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class RouteSheet implements FromCollection, WithHeadings, WithTitle
{
    public function __construct(
        protected string $from,
        protected string $to
    ) {}

    public function title(): string
    {
        return 'Per Rute';
    }

    public function headings(): array
    {
        return ['Rute', 'Jumlah Booking', 'Pendapatan'];
    }

    public function collection()
    {
        return Booking::query()
            ->whereBetween(DB::raw('DATE(bookings.created_at)'), [$this->from, $this->to])
            ->whereIn('bookings.status', ['confirmed','ongoing','completed'])
            ->join('schedules', 'schedules.id', '=', 'bookings.schedule_id')
            ->join('routes', 'routes.id', '=', 'schedules.route_id')
            ->selectRaw('CONCAT(routes.origin_city," → ",routes.destination_city) as rute, COUNT(*) as jumlah_booking, SUM(bookings.total_price) as pendapatan')
            ->groupBy('rute')
            ->orderByDesc('pendapatan')
            ->get();
    }
}