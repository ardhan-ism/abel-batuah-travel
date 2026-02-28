@extends('admin.layout')
@section('title','Tambah Rute')
@section('content')
  <h1 class="text-2xl font-bold mb-4">Tambah Rute</h1>

  <form method="POST" action="{{ route('admin.routes.store') }}" class="space-y-4 border p-4 rounded max-w-xl">
    @csrf
    <div>
      <label class="block mb-1">Kota Asal</label>
      <input class="border p-2 rounded w-full" name="origin_city" value="{{ old('origin_city') }}" required>
    </div>
    <div>
      <label class="block mb-1">Kota Tujuan</label>
      <input class="border p-2 rounded w-full" name="destination_city" value="{{ old('destination_city') }}" required>
    </div>
    <div>
      <label class="block mb-1">Harga Reguler / Kursi</label>
      <input class="border p-2 rounded w-full" type="number" name="regular_price" value="{{ old('regular_price') }}" required>
    </div>
    <button class="border px-3 py-2 rounded" type="submit">Simpan</button>
  </form>
@endsection