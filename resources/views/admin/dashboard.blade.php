@extends('admin.layout')
@section('title','Dashboard')

@section('content')
  <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="border rounded p-4">
      <div class="opacity-70">Booking hari ini</div>
      <div class="text-2xl font-bold">{{ $totalToday }}</div>
    </div>
    <div class="border rounded p-4">
      <div class="opacity-70">Booking aktif</div>
      <div class="text-2xl font-bold">{{ $active }}</div>
    </div>
    <div class="border rounded p-4">
      <div class="opacity-70">Pendapatan hari ini</div>
      <div class="text-2xl font-bold">Rp {{ number_format($revenueToday,0,',','.') }}</div>
    </div>
  </div>
@endsection

@if(isset($minAlerts) && $minAlerts->count())
  <div class="mt-6 border rounded p-4">
    <h2 class="text-lg font-bold mb-2">⚠️ Jadwal Besok Belum Memenuhi Minimum</h2>
    <table class="w-full border">
      <thead class="border-b">
        <tr>
          <th class="p-2 text-left">Jadwal</th>
          <th class="p-2 text-left">Rute</th>
          <th class="p-2 text-left">Sopir</th>
          <th class="p-2 text-left">Terkonfirmasi</th>
          <th class="p-2 text-left">Minimum</th>
        </tr>
      </thead>
      <tbody>
        @foreach($minAlerts as $s)
          <tr class="border-b">
            <td class="p-2">
              {{ $s->departure_date->format('Y-m-d') }}
              {{ \Carbon\Carbon::parse($s->departure_time)->format('H:i') }}
            </td>
            <td class="p-2">{{ $s->route->origin_city }} → {{ $s->route->destination_city }}</td>
            <td class="p-2">{{ $s->driver?->name ?? '-' }}</td>
            <td class="p-2"><b>{{ $s->confirmed_seats }}</b></td>
            <td class="p-2">{{ $s->min_passengers }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endif