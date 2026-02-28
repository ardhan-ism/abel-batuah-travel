@extends('admin.layout')
@section('title','Jadwal')

@section('content')
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Jadwal</h1>
    <a class="border px-3 py-2 rounded" href="{{ route('admin.schedules.create') }}">+ Tambah</a>
  </div>

  <form class="border p-4 rounded mb-4 grid grid-cols-1 md:grid-cols-4 gap-3" method="GET" action="{{ route('admin.schedules.index') }}">
    <input class="border p-2 rounded" type="date" name="date" value="{{ request('date') }}">

    <select class="border p-2 rounded" name="route_id">
      <option value="">Semua rute</option>
      @foreach($routes as $r)
        <option value="{{ $r->id }}" @selected((string)request('route_id')===(string)$r->id)>
          {{ $r->origin_city }} → {{ $r->destination_city }}
        </option>
      @endforeach
    </select>

    <select class="border p-2 rounded" name="status">
      <option value="">Semua status</option>
      <option value="active" @selected(request('status')==='active')>active</option>
      <option value="cancelled" @selected(request('status')==='cancelled')>cancelled</option>
    </select>

    <div class="md:col-span-4">
      <button class="border px-3 py-2 rounded" type="submit">Filter</button>
      <a class="underline ml-3" href="{{ route('admin.schedules.index') }}">Reset</a>
    </div>
  </form>

  <table class="w-full border">
    <thead class="border-b">
      <tr>
        <th class="p-2 text-left">Tanggal</th>
        <th class="p-2 text-left">Jam</th>
        <th class="p-2 text-left">Rute</th>
        <th class="p-2 text-left">Sopir</th>
        <th class="p-2 text-left">Kursi</th>
        <th class="p-2 text-left">Min</th>
        <th class="p-2 text-left">Status</th>
        <th class="p-2 text-left">Decision</th>
        <th class="p-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($schedules as $s)
        <tr class="border-b">
          <td class="p-2">{{ $s->departure_date->format('Y-m-d') }}</td>
          <td class="p-2">{{ \Carbon\Carbon::parse($s->departure_time)->format('H:i') }}</td>
          <td class="p-2">
            {{ $s->route->origin_city }} → {{ $s->route->destination_city }}
          </td>
          <td class="p-2">{{ $s->driver?->name ?? '-' }}</td>
          <td class="p-2">{{ $s->available_seats }}/{{ $s->total_seats }}</td>
          <td class="p-2">{{ $s->min_passengers }}</td>
          <td class="p-2"><b>{{ $s->status }}</b></td>
          <td class="p-2">{{ $s->departure_decision ?? 'pending' }}</td>
          <td class="p-2 text-center">
            <a class="underline mr-2" href="{{ route('admin.schedules.edit',$s) }}">Edit</a>
            <form class="inline" method="POST" action="{{ route('admin.schedules.destroy',$s) }}" onsubmit="return confirm('Hapus jadwal ini?')">
              @csrf @method('DELETE')
              <button class="underline" type="submit">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="mt-4">{{ $schedules->links() }}</div>
@endsection