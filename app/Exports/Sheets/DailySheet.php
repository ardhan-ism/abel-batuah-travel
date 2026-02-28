<?php

namespace App\Exports\Sheets;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class DailySheet implements FromCollection, WithHeadings, WithTitle
{
    public function __construct(
        protected string $from,
        protected string $to
    ) {}

    public function title(): string
    {
        return 'Harian';
    }

    public function headings(): array
    {
        return ['Tanggal', 'Jumlah Booking', 'Pendapatan'];
    }

    public function collection()
    {
        return Booking::query()
            ->whereBetween(DB::raw('DATE(created_at)'), [$this->from, $this->to])
            ->whereIn('status', ['confirmed','ongoing','completed'])
            ->selectRaw('DATE(created_at) as tanggal, COUNT(*) as jumlah_booking, SUM(total_price) as pendapatan')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
    }
}