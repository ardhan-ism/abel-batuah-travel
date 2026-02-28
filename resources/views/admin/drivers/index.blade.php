@extends('admin.layout')
@section('title','Sopir')

@section('content')
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Sopir</h1>
    <a class="border px-3 py-2 rounded" href="{{ route('admin.drivers.create') }}">+ Tambah</a>
  </div>

  <table class="w-full border">
    <thead class="border-b">
      <tr>
        <th class="p-2 text-left">Nama</th>
        <th class="p-2 text-left">Telepon</th>
        <th class="p-2 text-left">Status</th>
        <th class="p-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($drivers as $d)
        <tr class="border-b">
          <td class="p-2">{{ $d->name }}</td>
          <td class="p-2">{{ $d->phone ?? '-' }}</td>
          <td class="p-2"><b>{{ $d->status }}</b></td>
          <td class="p-2 text-center">
            <a class="underline mr-2" href="{{ route('admin.drivers.edit',$d) }}">Edit</a>
            <form class="inline" method="POST" action="{{ route('admin.drivers.destroy',$d) }}" onsubmit="return confirm('Hapus sopir ini?')">
              @csrf @method('DELETE')
              <button class="underline" type="submit">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="mt-4">{{ $drivers->links() }}</div>
@endsection