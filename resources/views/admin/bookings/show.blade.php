@extends('admin.layout')
@section('title','Detail Booking')

@section('content')
<h1 class="text-2xl font-bold mb-4">Detail Booking</h1>

<div class="border rounded p-4 mb-4 space-y-1">
  <div><b>Kode:</b> <span class="font-mono">{{ $booking->booking_code }}</span></div>
  <div><b>Nama:</b> {{ $booking->passenger_name }}</div>
  <div><b>WA:</b> {{ $booking->phone_wa }}</div>
  <div><b>Layanan:</b> {{ strtoupper($booking->service_type) }}</div>
  <div><b>Kursi:</b> {{ $booking->seats_booked }}</div>
  <div><b>Alamat Jemput:</b> {{ $booking->pickup_address }}</div>
  <div><b>Catatan:</b> {{ $booking->notes ?? '-' }}</div>
  <div><b>Total:</b> Rp {{ number_format($booking->total_price,0,',','.') }}</div>
  <div><b>Status:</b> {{ $booking->status }}</div>
  <div><b>Deadline cancel:</b> {{ optional($booking->cancellation_deadline)->format('Y-m-d H:i') }}</div>
</div>

<div class="border rounded p-4 mb-4 space-y-1">
  <div class="font-semibold mb-2">Jadwal</div>
  <div>{{ $booking->schedule->departure_date->format('Y-m-d') }} {{ \Carbon\Carbon::parse($booking->schedule->departure_time)->format('H:i') }}</div>
  <div>{{ $booking->schedule->route->origin_city }} → {{ $booking->schedule->route->destination_city }}</div>
  <div>Sopir: {{ $booking->schedule->driver?->name ?? '-' }}</div>
</div>

@if($booking->service_type === 'carter' && $booking->carterDetail)
  <div class="border rounded p-4 mb-4 space-y-1">
    <div class="font-semibold mb-2">Detail Carter</div>
    <div>End date: {{ $booking->carterDetail->end_date?->format('Y-m-d') }}</div>
    <div>Total days: {{ $booking->carterDetail->total_days }}</div>
    <div>Biaya sopir/hari: Rp {{ number_format($booking->carterDetail->driver_daily_cost,0,',','.') }}</div>
  </div>
@endif

@if($booking->notifications && $booking->notifications->count())
  <div class="border rounded p-4 mt-6">
    <h2 class="text-lg font-bold mb-2">Log WhatsApp</h2>

    <table class="w-full border">
      <thead class="border-b">
        <tr>
          <th class="p-2 text-left">Waktu</th>
          <th class="p-2 text-left">Tipe</th>
          <th class="p-2 text-left">Target</th>
          <th class="p-2 text-left">Sukses</th>
          <th class="p-2 text-left">Message ID</th>
        </tr>
      </thead>
      <tbody>
        @foreach($booking->notifications->sortByDesc('sent_at') as $n)
          <tr class="border-b">
            <td class="p-2">{{ optional($n->sent_at)->format('Y-m-d H:i') ?? '-' }}</td>
            <td class="p-2">{{ $n->type }}</td>
            <td class="p-2">{{ $n->target_phone ?? '-' }}</td>
            <td class="p-2">
              @if($n->is_success) ✅ @else ❌ @endif
            </td>
            <td class="p-2">{{ $n->provider_message_id ?? '-' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <p class="text-sm opacity-70 mt-2">
      Detail response tersimpan di database (provider_response).
    </p>
  </div>
@endif

<form method="POST" action="{{ route('admin.bookings.status',$booking) }}" class="border p-4 rounded max-w-md">
  @csrf
  <label class="block mb-1 font-semibold">Ubah Status</label>
  <select class="border p-2 rounded w-full" name="status" required>
    @foreach(['pending','confirmed','ongoing','completed','cancelled'] as $s)
      <option value="{{ $s }}" @selected($booking->status===$s)>{{ $s }}</option>
    @endforeach
  </select>

  <button class="border px-3 py-2 rounded mt-3" type="submit">Update</button>
</form>
@endsection