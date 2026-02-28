@extends('admin.layout')
@section('title','Laporan')

@section('content')
<h1 class="text-2xl font-bold mb-4">Laporan Pendapatan</h1>

<form class="border p-4 rounded mb-4 flex flex-col md:flex-row gap-3 items-end" method="GET" action="{{ route('admin.reports.index') }}">
  <div>
    <label class="block mb-1">Dari</label>
    <input class="border p-2 rounded" type="date" name="from" value="{{ $from }}">
  </div>
  <div>
    <label class="block mb-1">Sampai</label>
    <input class="border p-2 rounded" type="date" name="to" value="{{ $to }}">
  </div>
  <button class="border px-3 py-2 rounded" type="submit">Terapkan</button>
</form>
  <a class="border px-3 py-2 rounded inline-block"
   href="{{ route('admin.reports.excel', ['from' => $from, 'to' => $to]) }}">
  Export Excel
</a>
<a class="border px-3 py-2 rounded inline-block"
   href="{{ route('admin.reports.pdf', ['from' => $from, 'to' => $to]) }}">
  Export PDF
</a>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
  <div class="border rounded p-4">
    <div class="opacity-70">Total Booking (paid)</div>
    <div class="text-2xl font-bold">{{ $totalBookings }}</div>
  </div>
  <div class="border rounded p-4">
    <div class="opacity-70">Total Pendapatan</div>
    <div class="text-2xl font-bold">Rp {{ number_format($totalRevenue,0,',','.') }}</div>
  </div>
</div>

<div class="border rounded p-4 mb-6">
  <h2 class="font-bold mb-2">Pendapatan per Hari</h2>
  <table class="w-full border">
    <thead class="border-b">
      <tr>
        <th class="p-2 text-left">Tanggal</th>
        <th class="p-2 text-left">Jumlah Booking</th>
        <th class="p-2 text-left">Pendapatan</th>
      </tr>
    </thead>
    <tbody>
      @foreach($daily as $d)
        <tr class="border-b">
          <td class="p-2">{{ $d->day }}</td>
          <td class="p-2">{{ $d->cnt }}</td>
          <td class="p-2">Rp {{ number_format($d->revenue,0,',','.') }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="border rounded p-4 mb-6">
  <h2 class="font-bold mb-2">Rekap per Sopir</h2>
  <table class="w-full border">
    <thead class="border-b">
      <tr>
        <th class="p-2 text-left">Sopir</th>
        <th class="p-2 text-left">Jumlah Booking</th>
        <th class="p-2 text-left">Pendapatan</th>
      </tr>
    </thead>
    <tbody>
      @foreach($byDriver as $r)
        <tr class="border-b">
          <td class="p-2">{{ $r->driver_name }}</td>
          <td class="p-2">{{ $r->cnt }}</td>
          <td class="p-2">Rp {{ number_format($r->revenue,0,',','.') }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="border rounded p-4">
  <h2 class="font-bold mb-2">Rekap per Rute</h2>
  <table class="w-full border">
    <thead class="border-b">
      <tr>
        <th class="p-2 text-left">Rute</th>
        <th class="p-2 text-left">Jumlah Booking</th>
        <th class="p-2 text-left">Pendapatan</th>
      </tr>
    </thead>
    <tbody>
      @foreach($byRoute as $r)
        <tr class="border-b">
          <td class="p-2">{{ $r->route_name }}</td>
          <td class="p-2">{{ $r->cnt }}</td>
          <td class="p-2">Rp {{ number_format($r->revenue,0,',','.') }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection