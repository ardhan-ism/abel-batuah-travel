@extends('admin.layout')
@section('title','Booking')

@section('content')
<h1 class="text-2xl font-bold mb-4">Booking</h1>

<form class="border p-4 rounded mb-4 grid grid-cols-1 md:grid-cols-4 gap-3" method="GET" action="{{ route('admin.bookings.index') }}">
  <input class="border p-2 rounded" name="code" placeholder="Cari kode..." value="{{ request('code') }}">
  <input class="border p-2 rounded" type="date" name="date" value="{{ request('date') }}">

  <select class="border p-2 rounded" name="service_type">
    <option value="">Semua layanan</option>
    <option value="regular" @selected(request('service_type')=='regular')>Reguler</option>
    <option value="carter" @selected(request('service_type')=='carter')>Carter</option>
  </select>

  <select class="border p-2 rounded" name="status">
    <option value="">Semua status</option>
    @foreach(['pending','confirmed','ongoing','completed','cancelled'] as $s)
      <option value="{{ $s }}" @selected(request('status')==$s)>{{ $s }}</option>
    @endforeach
  </select>

  <div class="md:col-span-4">
    <button class="border px-3 py-2 rounded" type="submit">Filter</button>
    <a class="underline ml-3" href="{{ route('admin.bookings.index') }}">Reset</a>
  </div>
</form>

<table class="w-full border">
  <thead class="border-b">
    <tr>
      <th class="p-2 text-left">Kode</th>
      <th class="p-2 text-left">Nama</th>
      <th class="p-2 text-left">Layanan</th>
      <th class="p-2 text-left">Jadwal</th>
      <th class="p-2 text-left">Total</th>
      <th class="p-2 text-left">Status</th>
      <th class="p-2">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($bookings as $b)
      <tr class="border-b">
        <td class="p-2 font-mono">{{ $b->booking_code }}</td>
        <td class="p-2">{{ $b->passenger_name }}</td>
        <td class="p-2">{{ $b->service_type }}</td>
        <td class="p-2">
          {{ $b->schedule->departure_date->format('Y-m-d') }}
          {{ \Carbon\Carbon::parse($b->schedule->departure_time)->format('H:i') }}
          <div class="text-xs opacity-70">
            {{ $b->schedule->route->origin_city }} → {{ $b->schedule->route->destination_city }}
          </div>
        </td>
        <td class="p-2">Rp {{ number_format($b->total_price,0,',','.') }}</td>
        <td class="p-2"><b>{{ $b->status }}</b></td>
        <td class="p-2 text-center">
          <a class="underline" href="{{ route('admin.bookings.show',$b) }}">Detail</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

<div class="mt-4">{{ $bookings->links() }}</div>
@endsection