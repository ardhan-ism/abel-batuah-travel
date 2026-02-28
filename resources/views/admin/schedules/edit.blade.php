@extends('admin.layout')
@section('title','Edit Jadwal')

@section('content')
  <h1 class="text-2xl font-bold mb-4">Edit Jadwal</h1>

  <form method="POST" action="{{ route('admin.schedules.update',$schedule) }}" class="space-y-4 border p-4 rounded max-w-2xl">
    @csrf @method('PUT')

    <div>
      <label class="block mb-1">Rute</label>
      <select class="border p-2 rounded w-full" name="route_id" required>
        @foreach($routes as $r)
          <option value="{{ $r->id }}" @selected(old('route_id',$schedule->route_id)==$r->id)>
            {{ $r->origin_city }} → {{ $r->destination_city }}
          </option>
        @endforeach
      </select>
    </div>

    <div>
      <label class="block mb-1">Sopir (opsional)</label>
      <select class="border p-2 rounded w-full" name="driver_id">
        <option value="">-- belum ditentukan --</option>
        @foreach($drivers as $d)
          <option value="{{ $d->id }}" @selected((string)old('driver_id',$schedule->driver_id)===(string)$d->id)>
            {{ $d->name }} ({{ $d->status }})
          </option>
        @endforeach
      </select>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
      <div>
        <label class="block mb-1">Tanggal</label>
        <input class="border p-2 rounded w-full" type="date" name="departure_date"
               value="{{ old('departure_date',$schedule->departure_date->format('Y-m-d')) }}" required>
      </div>

      <div>
        <label class="block mb-1">Jam</label>
        <input class="border p-2 rounded w-full" type="time" name="departure_time"
               value="{{ old('departure_time',\Carbon\Carbon::parse($schedule->departure_time)->format('H:i')) }}" required>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
      <div>
        <label class="block mb-1">Total Kursi</label>
        <input class="border p-2 rounded w-full" type="number" min="1" max="6" name="total_seats"
               value="{{ old('total_seats',$schedule->total_seats) }}" required>
      </div>

      <div>
        <label class="block mb-1">Kursi Tersedia</label>
        <input class="border p-2 rounded w-full" type="number" min="0" max="6" name="available_seats"
               value="{{ old('available_seats',$schedule->available_seats) }}" required>
      </div>

      <div>
        <label class="block mb-1">Min Penumpang</label>
        <input class="border p-2 rounded w-full" type="number" min="1" max="6" name="min_passengers"
               value="{{ old('min_passengers',$schedule->min_passengers) }}" required>
      </div>
    </div>

    <div>
      <label class="block mb-1">Status</label>
      <select class="border p-2 rounded w-full" name="status" required>
        <option value="active" @selected(old('status',$schedule->status)==='active')>active</option>
        <option value="cancelled" @selected(old('status',$schedule->status)==='cancelled')>cancelled</option>
      </select>
    </div>

    <button class="border px-3 py-2 rounded" type="submit">Update</button>
    <a class="underline ml-3" href="{{ route('admin.schedules.index') }}">Batal</a>
  </form>
  <hr class="my-6">

<div class="border rounded p-4 max-w-2xl">
  <h2 class="text-lg font-bold mb-2">Keputusan Keberangkatan</h2>

  <div class="text-sm opacity-80 mb-3">
    Status keputusan saat ini:
    <b>{{ $schedule->departure_decision ?? 'pending' }}</b>
    @if($schedule->decided_at)
      ({{ $schedule->decided_at->format('Y-m-d H:i') }})
    @endif
  </div>

  <form method="POST" action="{{ route('admin.schedules.decision', $schedule) }}" class="space-y-3">
    @csrf

    <div>
      <label class="block mb-1">Keputusan</label>
      <select name="departure_decision" class="border p-2 rounded w-full" required>
        <option value="go" @selected(old('departure_decision', $schedule->departure_decision) === 'go')>Berangkat (GO)</option>
        <option value="cancel" @selected(old('departure_decision', $schedule->departure_decision) === 'cancel')>Batalkan Jadwal (CANCEL)</option>
      </select>
      <p class="text-sm opacity-70 mt-1">
        Jika CANCEL: semua booking (pending/confirmed) akan otomatis dibatalkan dan kursi dikembalikan.
      </p>
    </div>

    <div>
      <label class="block mb-1">Catatan (opsional)</label>
      <textarea name="decision_note" class="border p-2 rounded w-full" rows="3">{{ old('decision_note', $schedule->decision_note) }}</textarea>
    </div>

    <button class="border px-3 py-2 rounded"
            type="submit"
            onclick="return confirm('Yakin simpan keputusan ini?');">
      Simpan Keputusan
    </button>
  </form>
</div>
@endsection