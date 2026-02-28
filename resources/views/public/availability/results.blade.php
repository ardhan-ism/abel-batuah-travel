<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jadwal Tersedia – Abel Batuah Travel</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --navy: #0B1F4B;
      --navy-mid: #163068;
      --blue: #1A4DB3;
      --blue-light: #2B6BE6;
      --accent: #F5A623;
      --white: #FFFFFF;
      --off-white: #F7F9FC;
      --gray-light: #EBF0FA;
      --gray: #8A99B5;
      --text: #1C2B4A;
      --green: #059669;
      --green-bg: #ECFDF5;
      --green-border: #A7F3D0;
      --orange: #D97706;
      --orange-bg: #FFFBEB;
      --orange-border: #FDE68A;
      --red: #DC2626;
      --red-bg: #FEF2F2;
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'Poppins', sans-serif;
      background: var(--off-white);
      color: var(--text);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* ─── NAVBAR ─── */
    .navbar {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 100;
      background: rgba(255,255,255,0.95);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(11,31,75,0.08);
      padding: 0 5%;
      height: 72px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 2px 16px rgba(11,31,75,0.07);
    }
    .logo {
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
    }
    .logo-icon {
      width: 44px; height: 44px;
      background: var(--navy);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--white);
      font-size: 18px;
      flex-shrink: 0;
    }
    .logo-text .brand { font-size: 15px; font-weight: 700; color: var(--navy); line-height: 1.2; }
    .logo-text .sub   { font-size: 11px; font-weight: 400; color: var(--gray); letter-spacing: 0.5px; }

    .nav-actions { display: flex; align-items: center; gap: 12px; }
    .btn-outline-nav {
      padding: 9px 20px;
      border: 1.5px solid var(--navy);
      border-radius: 8px;
      background: transparent;
      color: var(--navy);
      font-family: 'Poppins', sans-serif;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.2s;
      white-space: nowrap;
    }
    .btn-outline-nav:hover, .btn-outline-nav.active { background: var(--navy); color: var(--white); }
    .btn-solid-nav {
      padding: 9px 20px;
      border: 1.5px solid var(--blue);
      border-radius: 8px;
      background: var(--blue);
      color: var(--white);
      font-family: 'Poppins', sans-serif;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.2s;
      white-space: nowrap;
    }
    .btn-solid-nav:hover { background: var(--navy); border-color: var(--navy); }

    .burger {
      display: none; flex-direction: column; gap: 5px;
      cursor: pointer; padding: 6px; background: none; border: none;
    }
    .burger span {
      display: block; width: 24px; height: 2px;
      background: var(--navy); border-radius: 2px; transition: all 0.3s;
    }
    .mobile-menu {
      display: none; flex-direction: column; gap: 10px;
      padding: 16px 5% 20px; background: white;
      border-bottom: 1px solid var(--gray-light);
      position: fixed; top: 72px; left: 0; right: 0;
      z-index: 99; animation: slideDown 0.25s ease;
    }
    .mobile-menu.open { display: flex; }
    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-8px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .mobile-menu a {
      padding: 12px 16px; border-radius: 8px;
      text-decoration: none; font-size: 14px; font-weight: 600; text-align: center;
    }
    .mobile-menu .m-outline { border: 1.5px solid var(--navy); color: var(--navy); }
    .mobile-menu .m-solid   { background: var(--blue); color: white; }

    /* ─── PAGE HEADER ─── */
    .page-header {
      padding: 100px 5% 36px;
      background: var(--white);
      border-bottom: 1px solid var(--gray-light);
      animation: fadeUp 0.5s ease forwards;
    }
    .page-header-inner { max-width: 900px; margin: 0 auto; }

    .breadcrumb {
      display: flex; align-items: center; gap: 8px;
      margin-bottom: 20px; font-size: 13px;
    }
    .breadcrumb a {
      color: var(--gray); text-decoration: none;
      font-weight: 500; transition: color 0.2s;
    }
    .breadcrumb a:hover { color: var(--blue); }
    .breadcrumb .sep { color: var(--gray); font-size: 11px; }
    .breadcrumb .current { color: var(--navy); font-weight: 600; }

    /* Route summary bar */
    .route-summary {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      flex-wrap: wrap;
    }
    .route-info { display: flex; align-items: center; gap: 16px; flex-wrap: wrap; }

    .route-cities {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .city-pill {
      display: flex;
      align-items: center;
      gap: 8px;
      background: var(--off-white);
      border: 1.5px solid var(--gray-light);
      border-radius: 100px;
      padding: 8px 16px;
    }
    .city-pill i { color: var(--blue); font-size: 12px; }
    .city-pill span { font-size: 14px; font-weight: 700; color: var(--navy); }

    .route-arrow {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 32px; height: 32px;
      background: var(--navy);
      border-radius: 50%;
      color: white;
      font-size: 12px;
      flex-shrink: 0;
    }

    .route-meta {
      display: flex;
      align-items: center;
      gap: 16px;
      flex-wrap: wrap;
    }
    .meta-chip {
      display: flex;
      align-items: center;
      gap: 6px;
      background: var(--gray-light);
      border-radius: 8px;
      padding: 6px 12px;
      font-size: 13px;
      font-weight: 500;
      color: var(--navy);
    }
    .meta-chip i { color: var(--gray); font-size: 11px; }

    .change-link {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      color: var(--blue);
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      padding: 8px 16px;
      border: 1.5px solid var(--blue);
      border-radius: 8px;
      transition: all 0.2s;
      white-space: nowrap;
    }
    .change-link:hover { background: var(--blue); color: white; }

    /* ─── MAIN ─── */
    .main-content { flex: 1; padding: 32px 5% 60px; }
    .main-inner { max-width: 900px; margin: 0 auto; }

    /* Results count */
    .results-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 20px;
      flex-wrap: wrap;
      gap: 10px;
    }
    .results-count {
      font-size: 13px;
      color: var(--gray);
      font-weight: 500;
    }
    .results-count strong { color: var(--navy); }

    /* ─── EMPTY STATE ─── */
    .empty-state {
      background: white;
      border: 1.5px solid var(--gray-light);
      border-radius: 20px;
      padding: 60px 32px;
      text-align: center;
      animation: fadeUp 0.5s ease 0.1s both;
    }
    .empty-icon {
      width: 72px; height: 72px;
      background: var(--off-white);
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      font-size: 28px;
      color: var(--gray);
    }
    .empty-title { font-size: 18px; font-weight: 700; color: var(--navy); margin-bottom: 8px; }
    .empty-desc  { font-size: 14px; color: var(--gray); margin-bottom: 24px; line-height: 1.6; }
    .btn-empty {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 12px 24px;
      background: var(--navy);
      color: white;
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
      font-weight: 600;
      border-radius: 10px;
      text-decoration: none;
      transition: all 0.2s;
    }
    .btn-empty:hover { background: var(--blue); transform: translateY(-2px); }

    /* ─── SCHEDULE CARDS ─── */
    .schedule-list { display: flex; flex-direction: column; gap: 14px; }

    .schedule-card {
      background: white;
      border: 1.5px solid var(--gray-light);
      border-radius: 18px;
      overflow: hidden;
      transition: all 0.25s;
      opacity: 0;
      animation: fadeUp 0.5s ease forwards;
    }
    .schedule-card:hover {
      border-color: rgba(26,77,179,0.25);
      box-shadow: 0 6px 28px rgba(11,31,75,0.08);
      transform: translateY(-2px);
    }

    .card-body {
      padding: 22px 24px;
      display: grid;
      grid-template-columns: auto 1fr auto;
      gap: 20px;
      align-items: center;
    }

    /* Time column */
    .card-time {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding-right: 20px;
      border-right: 1px solid var(--gray-light);
      min-width: 80px;
    }
    .time-label { font-size: 11px; font-weight: 600; color: var(--gray); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 4px; }
    .time-value { font-size: 28px; font-weight: 800; color: var(--navy); line-height: 1; }
    .time-unit  { font-size: 11px; font-weight: 500; color: var(--gray); }

    /* Info column */
    .card-info { display: flex; flex-direction: column; gap: 8px; }

    .info-row {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      color: var(--gray);
    }
    .info-row i { width: 14px; color: var(--blue); font-size: 12px; flex-shrink: 0; }
    .info-row span { font-weight: 500; }
    .info-row .val { color: var(--text); font-weight: 600; }

    /* Seat badge */
    .seat-badge {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 3px 10px;
      border-radius: 100px;
      font-size: 12px;
      font-weight: 600;
    }
    .seat-badge.high  { background: var(--green-bg);  color: var(--green);  border: 1px solid var(--green-border); }
    .seat-badge.mid   { background: var(--orange-bg); color: var(--orange); border: 1px solid var(--orange-border); }
    .seat-badge.low   { background: var(--red-bg);    color: var(--red);    border: 1px solid #FECACA; }

    /* Price + CTA column */
    .card-action {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      gap: 12px;
      min-width: 140px;
    }
    .price-label { font-size: 11px; font-weight: 600; color: var(--gray); letter-spacing: 0.5px; text-transform: uppercase; }
    .price-value { font-size: 20px; font-weight: 800; color: var(--navy); white-space: nowrap; }

    .btn-book {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 11px 22px;
      background: var(--navy);
      color: white;
      font-family: 'Poppins', sans-serif;
      font-size: 13px;
      font-weight: 700;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.25s;
      box-shadow: 0 3px 14px rgba(11,31,75,0.18);
      white-space: nowrap;
    }
    .btn-book:hover {
      background: var(--blue);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(26,77,179,0.25);
    }

    /* Card divider stripe */
    .card-stripe {
      height: 3px;
      background: linear-gradient(to right, var(--navy), var(--blue));
      opacity: 0;
      transition: opacity 0.25s;
    }
    .schedule-card:hover .card-stripe { opacity: 1; }

    /* ─── FOOTER ─── */
    footer {
      background: #07132E;
      padding: 32px 5%;
      color: rgba(255,255,255,0.6);
    }
    .footer-inner {
      max-width: 1200px; margin: 0 auto;
      display: flex; align-items: center;
      justify-content: space-between; gap: 20px; flex-wrap: wrap;
    }
    .footer-brand { font-size: 14px; font-weight: 600; color: white; }
    .footer-brand span { font-weight: 400; color: rgba(255,255,255,0.5); font-size: 13px; }
    .footer-contacts { display: flex; align-items: center; gap: 20px; flex-wrap: wrap; }
    .contact-item {
      display: flex; align-items: center; gap: 8px;
      text-decoration: none; color: rgba(255,255,255,0.55);
      font-size: 13px; transition: color 0.2s;
    }
    .contact-item:hover { color: white; }
    .contact-item i { font-size: 14px; }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(14px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 720px) {
      .nav-actions { display: none; }
      .burger { display: flex; }

      .card-body {
        grid-template-columns: 1fr;
        gap: 16px;
      }
      .card-time {
        flex-direction: row;
        align-items: baseline;
        gap: 8px;
        padding-right: 0;
        border-right: none;
        border-bottom: 1px solid var(--gray-light);
        padding-bottom: 14px;
      }
      .time-label { order: 1; }
      .time-value { order: 0; }
      .time-unit  { order: 2; }
      .card-action {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        min-width: unset;
        padding-top: 14px;
        border-top: 1px solid var(--gray-light);
      }
      .route-summary { flex-direction: column; align-items: flex-start; }
      .footer-inner { flex-direction: column; align-items: flex-start; gap: 16px; }
    }

    @media (max-width: 480px) {
      .route-cities { flex-wrap: wrap; }
      .page-header { padding: 90px 5% 28px; }
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar">
    <a href="{{ route('home') }}" class="logo">
      <div class="logo-icon">
        <i class="fa-solid fa-bus"></i>
      </div>
      <div class="logo-text">
        <div class="brand">Abel Batuah Travel</div>
        <div class="sub">Kalimantan Tengah</div>
      </div>
    </a>
    <div class="nav-actions">
      <a href="{{ route('public.availability') }}" class="btn-outline-nav active">
        <i class="fa-regular fa-calendar-check" style="margin-right:6px;"></i> Cek Ketersediaan
      </a>
      <a href="{{ route('public.booking.status.form') }}" class="btn-solid-nav">
        <i class="fa-regular fa-rectangle-list" style="margin-right:6px;"></i> Cek Status Booking
      </a>
    </div>
    <button class="burger" id="burger" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </nav>

  <!-- MOBILE MENU -->
  <div class="mobile-menu" id="mobileMenu">
    <a href="{{ route('public.availability') }}" class="m-outline">
      <i class="fa-regular fa-calendar-check" style="margin-right:8px;"></i> Cek Ketersediaan
    </a>
    <a href="{{ route('public.booking.status.form') }}" class="m-solid">
      <i class="fa-regular fa-rectangle-list" style="margin-right:8px;"></i> Cek Status Booking
    </a>
  </div>

  <!-- PAGE HEADER -->
  <div class="page-header">
    <div class="page-header-inner">
      <div class="breadcrumb">
        <a href="{{ route('home') }}">
          <i class="fa-solid fa-house" style="font-size:11px; margin-right:4px;"></i> Beranda
        </a>
        <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
        <a href="{{ route('public.availability') }}">Cek Ketersediaan</a>
        <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
        <span class="current">Hasil Pencarian</span>
      </div>

      <div class="route-summary">
        <div class="route-info">
          <div class="route-cities">
            <div class="city-pill">
              <i class="fa-solid fa-location-dot"></i>
              <span>{{ $route->origin_city }}</span>
            </div>
            <div class="route-arrow">
              <i class="fa-solid fa-arrow-right"></i>
            </div>
            <div class="city-pill">
              <i class="fa-solid fa-flag-checkered"></i>
              <span>{{ $route->destination_city }}</span>
            </div>
          </div>
          <div class="route-meta">
            <div class="meta-chip">
              <i class="fa-regular fa-calendar"></i>
              {{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}
            </div>
            <div class="meta-chip">
              <i class="fa-solid fa-tag"></i>
              Rp {{ number_format($route->regular_price, 0, ',', '.') }} / kursi
            </div>
          </div>
        </div>
        <a href="{{ route('public.availability') }}" class="change-link">
          <i class="fa-solid fa-pen-to-square"></i>
          Ubah Pencarian
        </a>
      </div>
    </div>
  </div>

  <!-- MAIN -->
  <main class="main-content">
    <div class="main-inner">

      @if($schedules->isEmpty())
        <!-- Empty State -->
        <div class="empty-state">
          <div class="empty-icon">
            <i class="fa-solid fa-calendar-xmark"></i>
          </div>
          <div class="empty-title">Tidak Ada Jadwal Tersedia</div>
          <p class="empty-desc">
            Belum ada jadwal aktif untuk rute dan tanggal yang Anda pilih.<br>
            Coba pilih tanggal lain atau hubungi kami untuk informasi lebih lanjut.
          </p>
          <a href="{{ route('public.availability') }}" class="btn-empty">
            <i class="fa-solid fa-arrow-left"></i>
            Ubah Pencarian
          </a>
        </div>

      @else
        <div class="results-header">
          <div class="results-count">
            Ditemukan <strong>{{ $schedules->count() }} jadwal</strong> untuk rute ini
          </div>
        </div>

        <div class="schedule-list">
          @foreach($schedules as $i => $s)
            @php
              $pct = $s->total_seats > 0 ? ($s->available_seats / $s->total_seats) : 0;
              $seatClass = $pct > 0.5 ? 'high' : ($pct > 0.2 ? 'mid' : 'low');
              $seatIcon  = $pct > 0.5 ? 'fa-circle-check' : ($pct > 0.2 ? 'fa-circle-exclamation' : 'fa-circle-xmark');
              $seatLabel = $pct > 0.5 ? 'Tersedia' : ($pct > 0.2 ? 'Terbatas' : 'Hampir Penuh');
            @endphp
            <div class="schedule-card" style="animation-delay: {{ $i * 0.07 }}s">
              <div class="card-stripe"></div>
              <div class="card-body">

                <!-- Time -->
                <div class="card-time">
                  <div class="time-label">Berangkat</div>
                  <div class="time-value">{{ \Carbon\Carbon::parse($s->departure_time)->format('H:i') }}</div>
                  <div class="time-unit">WIB</div>
                </div>

                <!-- Info -->
                <div class="card-info">
                  <div class="info-row">
                    <i class="fa-solid fa-user-tie"></i>
                    <span>Sopir:</span>
                    <span class="val">{{ $s->driver?->name ?? 'Belum ditentukan' }}</span>
                  </div>
                  <div class="info-row">
                    <i class="fa-solid fa-chair"></i>
                    <span>Kursi:</span>
                    <span class="val">{{ $s->available_seats }} / {{ $s->total_seats }} tersedia</span>
                    <span class="seat-badge {{ $seatClass }}">
                      <i class="fa-solid {{ $seatIcon }}"></i>
                      {{ $seatLabel }}
                    </span>
                  </div>
                </div>

                <!-- Price + Book -->
                <div class="card-action">
                  <div>
                    <div class="price-label">Harga / Kursi</div>
                    <div class="price-value">Rp {{ number_format($route->regular_price, 0, ',', '.') }}</div>
                  </div>
                  <a href="{{ route('public.booking.create', ['schedule' => $s->id]) }}" class="btn-book">
                    <i class="fa-solid fa-ticket"></i>
                    Pesan
                  </a>
                </div>

              </div>
            </div>
          @endforeach
        </div>
      @endif

    </div>
  </main>

  <!-- FOOTER -->
  <footer>
    <div class="footer-inner">
      <div class="footer-brand">
        Abel Batuah Travel
        <br><span>&copy; {{ date('Y') }} Kalimantan Tengah, Indonesia</span>
      </div>
      <div class="footer-contacts">
        <a href="https://wa.me/6281234567890" target="_blank" class="contact-item">
          <i class="fa-brands fa-whatsapp"></i>
          +62 812-3456-7890
        </a>
        <a href="mailto:info@abelbatuahtravel.com" class="contact-item">
          <i class="fa-solid fa-envelope"></i>
          info@abelbatuahtravel.com
        </a>
      </div>
    </div>
  </footer>

  <script>
    const burger = document.getElementById('burger');
    const mobileMenu = document.getElementById('mobileMenu');
    burger.addEventListener('click', () => mobileMenu.classList.toggle('open'));
  </script>

</body>
</html>