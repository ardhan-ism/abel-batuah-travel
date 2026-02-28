@extends('admin.layout')
@section('title','Tambah Jadwal')

@section('content')
  <h1 class="text-2xl font-bold mb-4">Tambah Jadwal</h1>

  <form method="POST" action="{{ route('admin.schedules.store') }}" class="space-y-4 border p-4 rounded max-w-2xl">
    @csrf

    <div>
      <label class="block mb-1">Rute</label>
      <select class="border p-2 rounded w-full" name="route_id" required>
        <option value="">-- pilih rute --</option>
        @foreach($routes as $r)
          <option value="{{ $r->id }}" @selected(old('route_id')==$r->id)>
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
          <option value="{{ $d->id }}" @selected(old('driver_id')==$d->id)>
            {{ $d->name }} ({{ $d->status }})
          </option>
        @endforeach
      </select>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
      <div>
        <label class="block mb-1">Tanggal</label>
        <input class="border p-2 rounded w-full" type="date" name="departure_date" value="{{ old('departure_date') }}" required>
      </div>

      <div>
        <label class="block mb-1">Jam</label>
        <input class="border p-2 rounded w-full" type="time" name="departure_time" value="{{ old('departure_time') }}" required>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
      <div>
        <label class="block mb-1">Total Kursi</label>
        <input class="border p-2 rounded w-full" type="number" min="1" max="6" name="total_seats" value="{{ old('total_seats',6) }}" required>
      </div>

      <div>
        <label class="block mb-1">Kursi Tersedia</label>
        <input class="border p-2 rounded w-full" type="number" min="0" max="6" name="available_seats" value="{{ old('available_seats',6) }}" required>
      </div>

      <div>
        <label class="block mb-1">Min Penumpang</label>
        <input class="border p-2 rounded w-full" type="number" min="1" max="6" name="min_passengers" value="{{ old('min_passengers',1) }}" required>
      </div>
    </div>

    <div>
      <label class="block mb-1">Status</label>
      <select class="border p-2 rounded w-full" name="status" required>
        <option value="active" @selected(old('status','active')==='active')>active</option>
        <option value="cancelled" @selected(old('status')==='cancelled')>cancelled</option>
      </select>
    </div>

    <button class="border px-3 py-2 rounded" type="submit">Simpan</button>
    <a class="underline ml-3" href="{{ route('admin.schedules.index') }}">Batal</a>
  </form>
@endsection