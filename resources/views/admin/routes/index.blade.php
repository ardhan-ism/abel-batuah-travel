@extends('admin.layout')
@section('title','Rute')

@section('content')
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Rute</h1>
    <a class="border px-3 py-2 rounded" href="{{ route('admin.routes.create') }}">+ Tambah</a>
  </div>

  <table class="w-full border">
    <thead class="border-b">
      <tr>
        <th class="p-2 text-left">Asal</th>
        <th class="p-2 text-left">Tujuan</th>
        <th class="p-2 text-left">Harga/kursi</th>
        <th class="p-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($routes as $r)
        <tr class="border-b">
          <td class="p-2">{{ $r->origin_city }}</td>
          <td class="p-2">{{ $r->destination_city }}</td>
          <td class="p-2">Rp {{ number_format($r->regular_price,0,',','.') }}</td>
          <td class="p-2 text-center">
            <a class="underline mr-2" href="{{ route('admin.routes.edit',$r) }}">Edit</a>
            <form class="inline" method="POST" action="{{ route('admin.routes.destroy',$r) }}" onsubmit="return confirm('Hapus rute ini?')">
              @csrf @method('DELETE')
              <button class="underline" type="submit">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="mt-4">{{ $routes->links() }}</div>
@endsection