<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pemesanan – Abel Batuah Travel</title>
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
      --error: #DC2626;
      --error-bg: #FEF2F2;
      --error-border: #FECACA;
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
      position: fixed; top: 0; left: 0; right: 0; z-index: 100;
      background: rgba(255,255,255,0.95);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(11,31,75,0.08);
      padding: 0 5%; height: 72px;
      display: flex; align-items: center; justify-content: space-between;
      box-shadow: 0 2px 16px rgba(11,31,75,0.07);
    }
    .logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
    .logo-icon {
      width: 44px; height: 44px; background: var(--navy); border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      color: var(--white); font-size: 18px; flex-shrink: 0;
    }
    .logo-text .brand { font-size: 15px; font-weight: 700; color: var(--navy); line-height: 1.2; }
    .logo-text .sub   { font-size: 11px; font-weight: 400; color: var(--gray); letter-spacing: 0.5px; }

    .nav-actions { display: flex; align-items: center; gap: 12px; }
    .btn-outline-nav {
      padding: 9px 20px; border: 1.5px solid var(--navy); border-radius: 8px;
      background: transparent; color: var(--navy); font-family: 'Poppins', sans-serif;
      font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none;
      transition: all 0.2s; white-space: nowrap;
    }
    .btn-outline-nav:hover { background: var(--navy); color: var(--white); }
    .btn-solid-nav {
      padding: 9px 20px; border: 1.5px solid var(--blue); border-radius: 8px;
      background: var(--blue); color: var(--white); font-family: 'Poppins', sans-serif;
      font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none;
      transition: all 0.2s; white-space: nowrap;
    }
    .btn-solid-nav:hover { background: var(--navy); border-color: var(--navy); }

    .burger {
      display: none; flex-direction: column; gap: 5px;
      cursor: pointer; padding: 6px; background: none; border: none;
    }
    .burger span { display: block; width: 24px; height: 2px; background: var(--navy); border-radius: 2px; transition: all 0.3s; }
    .mobile-menu {
      display: none; flex-direction: column; gap: 10px;
      padding: 16px 5% 20px; background: white;
      border-bottom: 1px solid var(--gray-light);
      position: fixed; top: 72px; left: 0; right: 0; z-index: 99;
      animation: slideDown 0.25s ease;
    }
    .mobile-menu.open { display: flex; }
    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-8px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .mobile-menu a { padding: 12px 16px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; text-align: center; }
    .mobile-menu .m-outline { border: 1.5px solid var(--navy); color: var(--navy); }
    .mobile-menu .m-solid   { background: var(--blue); color: white; }

    /* ─── PAGE HEADER ─── */
    .page-header {
      padding: 100px 5% 36px; background: var(--white);
      border-bottom: 1px solid var(--gray-light);
      animation: fadeUp 0.5s ease forwards;
    }
    .page-header-inner { max-width: 840px; margin: 0 auto; }
    .breadcrumb {
      display: flex; align-items: center; gap: 8px;
      margin-bottom: 16px; font-size: 13px;
    }
    .breadcrumb a { color: var(--gray); text-decoration: none; font-weight: 500; transition: color 0.2s; }
    .breadcrumb a:hover { color: var(--blue); }
    .breadcrumb .sep { color: var(--gray); font-size: 11px; }
    .breadcrumb .current { color: var(--navy); font-weight: 600; }
    .page-title { font-size: clamp(22px, 3vw, 32px); font-weight: 800; color: var(--navy); margin-bottom: 4px; }
    .page-subtitle { font-size: 14px; color: var(--gray); }

    /* ─── MAIN ─── */
    .main-content { flex: 1; padding: 32px 5% 60px; }
    .main-inner { max-width: 840px; margin: 0 auto; display: flex; flex-direction: column; gap: 20px; }

    /* ─── TRIP SUMMARY CARD ─── */
    .trip-card {
      background: var(--navy);
      border-radius: 18px;
      padding: 24px 28px;
      position: relative;
      overflow: hidden;
      animation: fadeUp 0.5s ease 0.05s both;
    }
    .trip-card::before {
      content: '';
      position: absolute; top: -60px; right: -60px;
      width: 220px; height: 220px; border-radius: 50%;
      background: rgba(255,255,255,0.04); pointer-events: none;
    }
    .trip-card::after {
      content: '';
      position: absolute; bottom: -30px; left: 10%;
      width: 120px; height: 120px; border-radius: 50%;
      background: rgba(255,255,255,0.03); pointer-events: none;
    }
    .trip-card-label {
      font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.45);
      letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 16px;
    }
    .trip-route {
      display: flex; align-items: center; gap: 12px; margin-bottom: 20px; flex-wrap: wrap;
    }
    .trip-city {
      font-size: 20px; font-weight: 800; color: white;
    }
    .trip-arrow {
      width: 30px; height: 30px; border-radius: 50%;
      background: rgba(255,255,255,0.12);
      display: flex; align-items: center; justify-content: center;
      color: rgba(255,255,255,0.7); font-size: 12px; flex-shrink: 0;
    }
    .trip-meta {
      display: flex; gap: 12px; flex-wrap: wrap; position: relative; z-index: 1;
    }
    .trip-meta-item {
      display: flex; align-items: center; gap: 7px;
      background: rgba(255,255,255,0.08);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 8px; padding: 7px 14px;
      font-size: 13px; color: rgba(255,255,255,0.8); font-weight: 500;
    }
    .trip-meta-item i { color: rgba(255,255,255,0.5); font-size: 11px; }
    .trip-meta-item strong { color: white; font-weight: 700; }

    /* ─── ERROR ALERT ─── */
    .error-alert {
      background: var(--error-bg); border: 1.5px solid var(--error-border);
      border-radius: 12px; padding: 16px 20px;
      display: flex; gap: 12px; align-items: flex-start;
      animation: fadeUp 0.4s ease both;
    }
    .error-alert-icon {
      width: 32px; height: 32px; border-radius: 8px; background: var(--error);
      display: flex; align-items: center; justify-content: center;
      color: white; font-size: 13px; flex-shrink: 0; margin-top: 1px;
    }
    .error-alert-title { font-size: 13px; font-weight: 700; color: var(--error); margin-bottom: 6px; }
    .error-alert ul { list-style: none; padding: 0; }
    .error-alert ul li {
      font-size: 13px; color: #B91C1C; padding: 2px 0;
      display: flex; align-items: center; gap: 6px;
    }
    .error-alert ul li::before {
      content: ''; display: inline-block; width: 4px; height: 4px;
      border-radius: 50%; background: #B91C1C; flex-shrink: 0;
    }

    /* ─── FORM CARD ─── */
    .form-card {
      background: white; border: 1.5px solid var(--gray-light);
      border-radius: 20px; overflow: hidden;
      box-shadow: 0 4px 24px rgba(11,31,75,0.06);
      animation: fadeUp 0.5s ease 0.1s both;
    }

    .form-section {
      padding: 28px 32px;
      border-bottom: 1px solid var(--gray-light);
    }
    .form-section:last-child { border-bottom: none; }

    .section-header {
      display: flex; align-items: center; gap: 12px; margin-bottom: 24px;
    }
    .section-icon {
      width: 38px; height: 38px; border-radius: 10px; background: var(--gray-light);
      display: flex; align-items: center; justify-content: center;
      color: var(--blue); font-size: 15px; flex-shrink: 0;
    }
    .section-icon.navy { background: var(--navy); color: white; }
    .section-title  { font-size: 15px; font-weight: 700; color: var(--navy); }
    .section-desc   { font-size: 12px; color: var(--gray); margin-top: 2px; }

    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
    .form-group { display: flex; flex-direction: column; gap: 7px; }
    .form-group.full { grid-column: 1 / -1; }

    .form-label {
      font-size: 13px; font-weight: 600; color: var(--navy);
      display: flex; align-items: center; gap: 6px;
    }
    .form-label i { color: var(--blue); font-size: 11px; }
    .form-label .optional {
      font-size: 11px; font-weight: 400; color: var(--gray);
      background: var(--gray-light); padding: 1px 7px; border-radius: 100px;
    }

    .form-control {
      width: 100%; padding: 11px 14px;
      border: 1.5px solid var(--gray-light); border-radius: 10px;
      font-family: 'Poppins', sans-serif; font-size: 14px;
      font-weight: 400; color: var(--text); background: white;
      transition: all 0.2s; outline: none;
      appearance: none; -webkit-appearance: none;
    }
    .form-control:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(26,77,179,0.08); }
    .form-control::placeholder { color: var(--gray); }
    textarea.form-control { resize: vertical; min-height: 90px; }

    .select-wrapper { position: relative; }
    .select-wrapper .form-control { padding-right: 38px; cursor: pointer; }
    .select-wrapper::after {
      content: '\f078'; font-family: 'Font Awesome 6 Free'; font-weight: 900;
      position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
      color: var(--gray); font-size: 11px; pointer-events: none; transition: color 0.2s;
    }
    .select-wrapper:focus-within::after { color: var(--blue); }

    .form-hint {
      font-size: 12px; color: var(--gray); display: flex; align-items: center; gap: 5px;
    }
    .form-hint i { font-size: 10px; }

    /* ─── SERVICE TYPE TOGGLE ─── */
    .service-toggle {
      display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 0;
    }
    .service-option { position: relative; }
    .service-option input[type="radio"] { position: absolute; opacity: 0; width: 0; height: 0; }
    .service-option label {
      display: flex; align-items: center; gap: 12px;
      padding: 14px 16px; border: 2px solid var(--gray-light);
      border-radius: 12px; cursor: pointer; transition: all 0.2s;
      font-size: 14px; font-weight: 600; color: var(--gray);
    }
    .service-option label:hover { border-color: rgba(26,77,179,0.3); color: var(--navy); }
    .service-option input[type="radio"]:checked + label {
      border-color: var(--blue); background: rgba(26,77,179,0.04); color: var(--navy);
    }
    .service-opt-icon {
      width: 36px; height: 36px; border-radius: 9px;
      background: var(--gray-light); display: flex;
      align-items: center; justify-content: center;
      font-size: 15px; color: var(--gray); flex-shrink: 0; transition: all 0.2s;
    }
    .service-option input[type="radio"]:checked + label .service-opt-icon {
      background: var(--navy); color: white;
    }
    .service-opt-text .sot-name  { font-size: 14px; font-weight: 700; }
    .service-opt-text .sot-desc  { font-size: 11px; font-weight: 400; color: var(--gray); margin-top: 1px; }

    /* ─── DYNAMIC FIELDS ─── */
    .dynamic-field {
      overflow: hidden; transition: max-height 0.35s ease, opacity 0.3s ease;
      max-height: 0; opacity: 0;
    }
    .dynamic-field.visible { max-height: 300px; opacity: 1; }

    /* ─── FORM FOOTER ─── */
    .form-footer-section {
      padding: 24px 32px;
      display: flex; align-items: center;
      justify-content: space-between; gap: 16px; flex-wrap: wrap;
      background: var(--off-white);
      border-top: 1px solid var(--gray-light);
    }
    .back-link {
      display: inline-flex; align-items: center; gap: 8px;
      color: var(--gray); font-size: 13px; font-weight: 500;
      text-decoration: none; transition: color 0.2s;
    }
    .back-link:hover { color: var(--navy); }
    .btn-submit {
      display: inline-flex; align-items: center; gap: 10px;
      padding: 13px 32px; background: var(--navy); color: white;
      font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 700;
      border: none; border-radius: 10px; cursor: pointer;
      transition: all 0.25s; box-shadow: 0 4px 20px rgba(11,31,75,0.2);
    }
    .btn-submit:hover {
      background: var(--blue); transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(26,77,179,0.25);
    }
    .btn-submit:active { transform: translateY(0); }

    /* ─── FOOTER ─── */
    footer {
      background: #07132E; padding: 32px 5%;
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
      text-decoration: none; color: rgba(255,255,255,0.55); font-size: 13px; transition: color 0.2s;
    }
    .contact-item:hover { color: white; }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(14px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 640px) {
      .nav-actions { display: none; }
      .burger { display: flex; }
      .form-grid { grid-template-columns: 1fr; }
      .form-group.full { grid-column: 1; }
      .service-toggle { grid-template-columns: 1fr; }
      .form-section { padding: 22px 18px; }
      .form-footer-section { flex-direction: column-reverse; padding: 20px 18px; }
      .btn-submit { width: 100%; justify-content: center; }
      .back-link { align-self: center; }
      .footer-inner { flex-direction: column; align-items: flex-start; gap: 16px; }
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar">
    <a href="{{ route('home') }}" class="logo">
      <div class="logo-icon"><i class="fa-solid fa-bus"></i></div>
      <div class="logo-text">
        <div class="brand">Abel Batuah Travel</div>
        <div class="sub">Kalimantan Tengah</div>
      </div>
    </a>
    <div class="nav-actions">
      <a href="{{ route('public.availability') }}" class="btn-outline-nav">
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
        <a href="{{ route('home') }}"><i class="fa-solid fa-house" style="font-size:11px; margin-right:4px;"></i> Beranda</a>
        <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
        <a href="{{ route('public.availability') }}">Cek Ketersediaan</a>
        <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
        <span class="current">Form Pemesanan</span>
      </div>
      <h1 class="page-title">Form Pemesanan</h1>
      <p class="page-subtitle">Lengkapi detail perjalanan dan data penumpang untuk menyelesaikan pemesanan.</p>
    </div>
  </div>

  <!-- MAIN -->
  <main class="main-content">
    <div class="main-inner">

      <!-- Trip Summary -->
      <div class="trip-card">
        <div class="trip-card-label">Detail Perjalanan</div>
        <div class="trip-route">
          <span class="trip-city">{{ $schedule->route->origin_city }}</span>
          <div class="trip-arrow"><i class="fa-solid fa-arrow-right"></i></div>
          <span class="trip-city">{{ $schedule->route->destination_city }}</span>
        </div>
        <div class="trip-meta">
          <div class="trip-meta-item">
            <i class="fa-regular fa-calendar"></i>
            <strong>{{ $schedule->departure_date->format('d M Y') }}</strong>
          </div>
          <div class="trip-meta-item">
            <i class="fa-regular fa-clock"></i>
            <strong>{{ \Carbon\Carbon::parse($schedule->departure_time)->format('H:i') }}</strong> WIB
          </div>
          <div class="trip-meta-item">
            <i class="fa-solid fa-tag"></i>
            Rp <strong>{{ number_format($schedule->route->regular_price, 0, ',', '.') }}</strong> / kursi
          </div>
          <div class="trip-meta-item">
            <i class="fa-solid fa-chair"></i>
            <strong>{{ $schedule->available_seats }}</strong> / {{ $schedule->total_seats }} kursi tersedia
          </div>
        </div>
      </div>

      <!-- Error Alert -->
      @if ($errors->any())
      <div class="error-alert">
        <div class="error-alert-icon"><i class="fa-solid fa-exclamation"></i></div>
        <div>
          <div class="error-alert-title">Mohon perbaiki kesalahan berikut:</div>
          <ul>
            @foreach ($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      </div>
      @endif

      <!-- Form -->
      <div class="form-card">
        <form method="POST" action="{{ route('public.booking.store') }}">
          @csrf
          <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">

          <!-- Section 1: Jenis Layanan -->
          <div class="form-section">
            <div class="section-header">
              <div class="section-icon navy"><i class="fa-solid fa-sliders"></i></div>
              <div>
                <div class="section-title">Jenis Layanan</div>
                <div class="section-desc">Pilih tipe layanan yang sesuai kebutuhan Anda.</div>
              </div>
            </div>

            <div class="service-toggle">
              <div class="service-option">
                <input type="radio" id="svc_regular" name="service_type" value="regular"
                  {{ old('service_type', 'regular') === 'regular' ? 'checked' : '' }}>
                <label for="svc_regular">
                  <div class="service-opt-icon"><i class="fa-solid fa-user"></i></div>
                  <div class="service-opt-text">
                    <div class="sot-name">Reguler</div>
                    <div class="sot-desc">Pesan per kursi</div>
                  </div>
                </label>
              </div>
              <div class="service-option">
                <input type="radio" id="svc_carter" name="service_type" value="carter"
                  {{ old('service_type') === 'carter' ? 'checked' : '' }}>
                <label for="svc_carter">
                  <div class="service-opt-icon"><i class="fa-solid fa-van-shuttle"></i></div>
                  <div class="service-opt-text">
                    <div class="sot-name">Carter</div>
                    <div class="sot-desc">Sewa 6 kursi penuh</div>
                  </div>
                </label>
              </div>
            </div>

            <!-- Regular fields -->
            <div id="regular_fields" class="dynamic-field" style="margin-top: 18px;">
              <div class="form-group">
                <label class="form-label" for="seats_booked">
                  <i class="fa-solid fa-chair"></i>
                  Jumlah Kursi
                </label>
                <input type="number" id="seats_booked" name="seats_booked"
                  min="1" max="6" value="{{ old('seats_booked', 1) }}" class="form-control">
                <span class="form-hint">
                  <i class="fa-solid fa-circle-info"></i>
                  Harga dihitung dari jumlah kursi dikali tarif rute.
                </span>
              </div>
            </div>

            <!-- Carter fields -->
            <div id="carter_fields" class="dynamic-field" style="margin-top: 18px;">
              <div class="form-group">
                <label class="form-label" for="end_date">
                  <i class="fa-regular fa-calendar-check"></i>
                  Tanggal Selesai Carter
                </label>
                <input type="date" id="end_date" name="end_date"
                  value="{{ old('end_date') }}" class="form-control">
                <span class="form-hint">
                  <i class="fa-solid fa-circle-info"></i>
                  Carter menggunakan 6 kursi penuh selama periode yang dipilih.
                </span>
              </div>
            </div>
          </div>

          <!-- Section 2: Data Penumpang -->
          <div class="form-section">
            <div class="section-header">
              <div class="section-icon navy"><i class="fa-solid fa-user-check"></i></div>
              <div>
                <div class="section-title">Data Penumpang</div>
                <div class="section-desc">Informasi ini diperlukan untuk konfirmasi pemesanan.</div>
              </div>
            </div>

            <div class="form-grid">
              <div class="form-group">
                <label class="form-label" for="passenger_name">
                  <i class="fa-solid fa-user"></i>
                  Nama Lengkap
                </label>
                <input type="text" id="passenger_name" name="passenger_name"
                  value="{{ old('passenger_name') }}" placeholder="Masukkan nama lengkap"
                  class="form-control" required>
              </div>

              <div class="form-group">
                <label class="form-label" for="passenger_id_number">
                  <i class="fa-solid fa-id-card"></i>
                  Nomor KTP
                  <span class="optional">Opsional</span>
                </label>
                <input type="text" id="passenger_id_number" name="passenger_id_number"
                  value="{{ old('passenger_id_number') }}" placeholder="16 digit nomor KTP"
                  class="form-control">
              </div>

              <div class="form-group full">
                <label class="form-label" for="pickup_address">
                  <i class="fa-solid fa-location-dot"></i>
                  Alamat Penjemputan
                </label>
                <textarea id="pickup_address" name="pickup_address"
                  class="form-control" rows="3"
                  placeholder="Tulis alamat lengkap tempat penjemputan"
                  required>{{ old('pickup_address') }}</textarea>
              </div>

              <div class="form-group">
                <label class="form-label" for="phone_wa">
                  <i class="fa-brands fa-whatsapp"></i>
                  Nomor WhatsApp
                </label>
                <input type="text" id="phone_wa" name="phone_wa"
                  value="{{ old('phone_wa') }}" placeholder="Contoh: 08123456789"
                  class="form-control" required>
                <span class="form-hint">
                  <i class="fa-solid fa-circle-info"></i>
                  Format: 08xxxx atau 628xxxx
                </span>
              </div>

              <div class="form-group">
                <label class="form-label" for="notes">
                  <i class="fa-regular fa-note-sticky"></i>
                  Catatan
                  <span class="optional">Opsional</span>
                </label>
                <textarea id="notes" name="notes"
                  class="form-control" rows="3"
                  placeholder="Permintaan khusus atau informasi tambahan">{{ old('notes') }}</textarea>
              </div>
            </div>
          </div>

          <!-- Form Footer -->
          <div class="form-footer-section">
            <a href="{{ url()->previous() }}" class="back-link">
              <i class="fa-solid fa-arrow-left"></i>
              Kembali ke Jadwal
            </a>
            <button type="submit" class="btn-submit">
              <i class="fa-solid fa-paper-plane"></i>
              Konfirmasi Pesanan
            </button>
          </div>

        </form>
      </div>

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
          <i class="fa-brands fa-whatsapp"></i> +62 812-3456-7890
        </a>
        <a href="mailto:info@abelbatuahtravel.com" class="contact-item">
          <i class="fa-solid fa-envelope"></i> info@abelbatuahtravel.com
        </a>
      </div>
    </div>
  </footer>

  <script>
    // Mobile menu
    const burger = document.getElementById('burger');
    const mobileMenu = document.getElementById('mobileMenu');
    burger.addEventListener('click', () => mobileMenu.classList.toggle('open'));

    // Service type toggle with smooth animation
    const svcRegular = document.getElementById('svc_regular');
    const svcCarter  = document.getElementById('svc_carter');
    const regularFields = document.getElementById('regular_fields');
    const carterFields  = document.getElementById('carter_fields');
    const endDateInput  = document.getElementById('end_date');

    function toggleFields() {
      if (svcCarter.checked) {
        regularFields.classList.remove('visible');
        carterFields.classList.add('visible');
        endDateInput.disabled = false;
      } else {
        carterFields.classList.remove('visible');
        regularFields.classList.add('visible');
        endDateInput.disabled = true;
        endDateInput.value = '';
      }
    }

    svcRegular.addEventListener('change', toggleFields);
    svcCarter.addEventListener('change', toggleFields);

    // Init on load
    toggleFields();
  </script>

</body>
</html>