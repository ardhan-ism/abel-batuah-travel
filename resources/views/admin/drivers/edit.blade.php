@extends('admin.layout')
@section('title','Edit Sopir')

@section('content')
  <h1 class="text-2xl font-bold mb-4">Edit Sopir</h1>

  <form method="POST" action="{{ route('admin.drivers.update',$driver) }}" class="space-y-4 border p-4 rounded max-w-xl">
    @csrf @method('PUT')

    <div>
      <label class="block mb-1">Nama</label>
      <input class="border p-2 rounded w-full" name="name" value="{{ old('name',$driver->name) }}" required>
    </div>

    <div>
      <label class="block mb-1">Telepon (opsional)</label>
      <input class="border p-2 rounded w-full" name="phone" value="{{ old('phone',$driver->phone) }}">
    </div>

    <div>
      <label class="block mb-1">Status</label>
      <select class="border p-2 rounded w-full" name="status" required>
        <option value="available" @selected(old('status',$driver->status)==='available')>available</option>
        <option value="busy" @selected(old('status',$driver->status)==='busy')>busy</option>
        <option value="off" @selected(old('status',$driver->status)==='off')>off</option>
      </select>
    </div>

    <button class="border px-3 py-2 rounded" type="submit">Update</button>
    <a class="underline ml-3" href="{{ route('admin.drivers.index') }}">Batal</a>
  </form>
@endsection