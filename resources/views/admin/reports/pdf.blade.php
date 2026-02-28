<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Laporan Pendapatan</title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    h1 { font-size: 18px; margin: 0 0 6px 0; }
    h2 { font-size: 14px; margin: 16px 0 6px 0; }
    .muted { color: #555; }
    .box { border: 1px solid #ccc; padding: 10px; margin: 10px 0; }
    table { width: 100%; border-collapse: collapse; margin-top: 6px; }
    th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
    th { background: #f2f2f2; }
    .right { text-align: right; }
  </style>
</head>
<body>
  <h1>Laporan Pendapatan - CV Abel Batuah Travel</h1>
  <div class="muted">Periode: <b>{{ $from }}</b> s/d <b>{{ $to }}</b></div>

  <div class="box">
    <table>
      <tr>
        <td><b>Total Booking (paid)</b></td>
        <td class="right">{{ $totalBookings }}</td>
      </tr>
      <tr>
        <td><b>Total Pendapatan</b></td>
        <td class="right">Rp {{ number_format($totalRevenue,0,',','.') }}</td>
      </tr>
    </table>
  </div>

  <h2>Pendapatan per Hari</h2>
  <table>
    <thead>
      <tr>
        <th>Tanggal</th>
        <th class="right">Jumlah Booking</th>
        <th class="right">Pendapatan</th>
      </tr>
    </thead>
    <tbody>
      @forelse($daily as $d)
        <tr>
          <td>{{ $d->day }}</td>
          <td class="right">{{ $d->cnt }}</td>
          <td class="right">Rp {{ number_format($d->revenue,0,',','.') }}</td>
        </tr>
      @empty
        <tr><td colspan="3">Tidak ada data.</td></tr>
      @endforelse
    </tbody>
  </table>

  <h2>Rekap per Sopir</h2>
  <table>
    <thead>
      <tr>
        <th>Sopir</th>
        <th class="right">Jumlah Booking</th>
        <th class="right">Pendapatan</th>
      </tr>
    </thead>
    <tbody>
      @forelse($byDriver as $r)
        <tr>
          <td>{{ $r->driver_name }}</td>
          <td class="right">{{ $r->cnt }}</td>
          <td class="right">Rp {{ number_format($r->revenue,0,',','.') }}</td>
        </tr>
      @empty
        <tr><td colspan="3">Tidak ada data.</td></tr>
      @endforelse
    </tbody>
  </table>

  <h2>Rekap per Rute</h2>
  <table>
    <thead>
      <tr>
        <th>Rute</th>
        <th class="right">Jumlah Booking</th>
        <th class="right">Pendapatan</th>
      </tr>
    </thead>
    <tbody>
      @forelse($byRoute as $r)
        <tr>
          <td>{{ $r->route_name }}</td>
          <td class="right">{{ $r->cnt }}</td>
          <td class="right">Rp {{ number_format($r->revenue,0,',','.') }}</td>
        </tr>
      @empty
        <tr><td colspan="3">Tidak ada data.</td></tr>
      @endforelse
    </tbody>
  </table>

  <div class="muted" style="margin-top:16px;">
    Dicetak pada: {{ now()->format('Y-m-d H:i') }}
  </div>
</body>
</html>