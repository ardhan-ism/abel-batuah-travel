<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>@yield('title', 'Admin')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen flex">
  <aside class="w-64 border-r p-4">
    <div class="font-bold text-lg mb-4">CV Abel Batuah Travel</div>

    <nav class="space-y-2">
      <a class="block underline" href="{{ route('admin.dashboard') }}">Dashboard</a>
      <a class="block underline" href="{{ route('admin.routes.index') }}">Rute</a>
      <a class="block underline" href="{{ route('admin.schedules.index') }}">Jadwal</a>
      <a class="block underline" href="{{ route('admin.drivers.index') }}">Sopir</a>
      <a class="block underline" href="{{ route('admin.bookings.index') }}">Booking</a>
      <a class="block underline" href="{{ route('admin.reports.index') }}">Laporan</a>
    </nav>

    <form method="POST" action="{{ route('logout') }}" class="mt-6">
      @csrf
      <button class="border px-3 py-2 rounded" type="submit">Logout</button>
    </form>
  </aside>

  <main class="flex-1 p-6">
    @if(session('success'))
      <div class="border p-3 mb-4">✅ {{ session('success') }}</div>
    @endif
    @if($errors->any())
      <div class="border p-3 mb-4">
        <ul class="list-disc pl-5">
          @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
      </div>
    @endif

    @yield('content')
  </main>
</body>
</html>