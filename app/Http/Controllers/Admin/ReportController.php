<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\RevenueReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to   = $request->input('to', now()->toDateString());

        // WAJIB: prefix bookings.* supaya tidak ambiguous saat join
        $base = Booking::query()
            ->whereBetween(DB::raw('DATE(bookings.created_at)'), [$from, $to])
            ->whereIn('bookings.status', ['confirmed','ongoing','completed']);

        // 1) total summary
        $totalRevenue  = (clone $base)->sum('bookings.total_price');
        $totalBookings = (clone $base)->count();

        // 2) per hari
        $daily = (clone $base)
            ->selectRaw('DATE(bookings.created_at) as day, SUM(bookings.total_price) as revenue, COUNT(*) as cnt')
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        // 3) per sopir (join schedules + drivers)
        $byDriver = (clone $base)
            ->join('schedules','schedules.id','=','bookings.schedule_id')
            ->leftJoin('drivers','drivers.id','=','schedules.driver_id')
            ->selectRaw('COALESCE(drivers.name,"(Belum ditentukan)") as driver_name, SUM(bookings.total_price) as revenue, COUNT(*) as cnt')
            ->groupBy('driver_name')
            ->orderByDesc('revenue')
            ->get();

        // 4) per rute (join schedules + routes)
        $byRoute = (clone $base)
            ->join('schedules','schedules.id','=','bookings.schedule_id')
            ->join('routes','routes.id','=','schedules.route_id')
            ->selectRaw('CONCAT(routes.origin_city," → ",routes.destination_city) as route_name, SUM(bookings.total_price) as revenue, COUNT(*) as cnt')
            ->groupBy('route_name')
            ->orderByDesc('revenue')
            ->get();

        return view('admin.reports.index', compact(
            'from','to','totalRevenue','totalBookings','daily','byDriver','byRoute'
        ));
    }

    public function exportExcel(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to   = $request->input('to', now()->toDateString());

        $filename = "Laporan-Pendapatan-{$from}-sd-{$to}.xlsx";

        return Excel::download(new RevenueReportExport($from, $to), $filename);
    }
    public function exportPdf(Request $request)
{
    $from = $request->input('from', now()->startOfMonth()->toDateString());
    $to   = $request->input('to', now()->toDateString());

    $base = Booking::query()
        ->whereBetween(DB::raw('DATE(bookings.created_at)'), [$from, $to])
        ->whereIn('bookings.status', ['confirmed','ongoing','completed']);

    $totalRevenue  = (clone $base)->sum('bookings.total_price');
    $totalBookings = (clone $base)->count();

    $daily = (clone $base)
        ->selectRaw('DATE(bookings.created_at) as day, SUM(bookings.total_price) as revenue, COUNT(*) as cnt')
        ->groupBy('day')
        ->orderBy('day')
        ->get();

    $byDriver = (clone $base)
        ->join('schedules','schedules.id','=','bookings.schedule_id')
        ->leftJoin('drivers','drivers.id','=','schedules.driver_id')
        ->selectRaw('COALESCE(drivers.name,"(Belum ditentukan)") as driver_name, SUM(bookings.total_price) as revenue, COUNT(*) as cnt')
        ->groupBy('driver_name')
        ->orderByDesc('revenue')
        ->get();

    $byRoute = (clone $base)
        ->join('schedules','schedules.id','=','bookings.schedule_id')
        ->join('routes','routes.id','=','schedules.route_id')
        ->selectRaw('CONCAT(routes.origin_city," → ",routes.destination_city) as route_name, SUM(bookings.total_price) as revenue, COUNT(*) as cnt')
        ->groupBy('route_name')
        ->orderByDesc('revenue')
        ->get();

    $pdf = Pdf::loadView('admin.reports.pdf', compact(
        'from','to','totalRevenue','totalBookings','daily','byDriver','byRoute'
    ))->setPaper('A4', 'portrait');

    $filename = "Laporan-Pendapatan-{$from}-sd-{$to}.pdf";
    return $pdf->download($filename);
}
}