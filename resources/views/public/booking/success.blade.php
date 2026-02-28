<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking Berhasil – Abel Batuah Travel</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --navy: #0B1F4B;
      --blue: #1A4DB3;
      --accent: #F5A623;
      --white: #FFFFFF;
      --off-white: #F7F9FC;
      --gray-light: #EBF0FA;
      --gray: #8A99B5;
      --text: #1C2B4A;
      --green: #059669;
      --green-bg: #ECFDF5;
      --green-border: #A7F3D0;
      --green-dark: #065F46;
      --orange: #D97706;
      --orange-bg: #FFFBEB;
      --orange-border: #FDE68A;
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
      color: white; font-size: 18px; flex-shrink: 0;
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
    .btn-outline-nav:hover { background: var(--navy); color: white; }
    .btn-solid-nav {
      padding: 9px 20px; border: 1.5px solid var(--blue); border-radius: 8px;
      background: var(--blue); color: white; font-family: 'Poppins', sans-serif;
      font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none;
      transition: all 0.2s; white-space: nowrap;
    }
    .btn-solid-nav:hover { background: var(--navy); border-color: var(--navy); }

    .burger {
      display: none; flex-direction: column; gap: 5px;
      cursor: pointer; padding: 6px; background: none; border: none;
    }
    .burger span { display: block; width: 24px; height: 2px; background: var(--navy); border-radius: 2px; }
    .mobile-menu {
      display: none; flex-direction: column; gap: 10px;
      padding: 16px 5% 20px; background: white;
      border-bottom: 1px solid var(--gray-light);
      position: fixed; top: 72px; left: 0; right: 0; z-index: 99;
    }
    .mobile-menu.open { display: flex; }
    .mobile-menu a { padding: 12px 16px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; text-align: center; }
    .mobile-menu .m-outline { border: 1.5px solid var(--navy); color: var(--navy); }
    .mobile-menu .m-solid   { background: var(--blue); color: white; }

    /* ─── MAIN ─── */
    .main-content { flex: 1; padding: 100px 5% 60px; }
    .main-inner { max-width: 680px; margin: 0 auto; display: flex; flex-direction: column; gap: 20px; }

    /* ─── SUCCESS BANNER ─── */
    .success-banner {
      background: var(--navy);
      border-radius: 20px;
      padding: 36px 32px;
      display: flex;
      align-items: center;
      gap: 24px;
      position: relative;
      overflow: hidden;
      animation: fadeUp 0.6s ease both;
    }
    .success-banner::before {
      content: '';
      position: absolute; top: -60px; right: -60px;
      width: 240px; height: 240px; border-radius: 50%;
      background: rgba(255,255,255,0.04); pointer-events: none;
    }
    .success-banner::after {
      content: '';
      position: absolute; bottom: -40px; left: 5%;
      width: 140px; height: 140px; border-radius: 50%;
      background: rgba(255,255,255,0.03); pointer-events: none;
    }

    .success-icon-wrap {
      width: 64px; height: 64px;
      border-radius: 18px;
      background: rgba(5,150,105,0.2);
      border: 2px solid rgba(5,150,105,0.35);
      display: flex; align-items: center; justify-content: center;
      font-size: 28px; color: #34D399;
      flex-shrink: 0;
      animation: popIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s both;
      position: relative; z-index: 1;
    }
    @keyframes popIn {
      from { transform: scale(0.5); opacity: 0; }
      to   { transform: scale(1); opacity: 1; }
    }

    .success-text { position: relative; z-index: 1; }
    .success-title {
      font-size: 22px; font-weight: 800; color: white; margin-bottom: 4px;
    }
    .success-subtitle {
      font-size: 14px; color: rgba(255,255,255,0.6); line-height: 1.5;
    }

    /* ─── BOOKING CODE CARD ─── */
    .booking-code-card {
      background: white;
      border: 1.5px solid var(--gray-light);
      border-radius: 18px;
      padding: 28px 28px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      flex-wrap: wrap;
      box-shadow: 0 4px 24px rgba(11,31,75,0.06);
      animation: fadeUp 0.5s ease 0.15s both;
    }
    .code-left {}
    .code-label {
      font-size: 12px; font-weight: 700; color: var(--gray);
      letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 8px;
    }
    .code-value {
      font-size: 32px; font-weight: 900; color: var(--navy);
      letter-spacing: 3px; font-variant-numeric: tabular-nums;
    }
    .code-hint {
      font-size: 12px; color: var(--gray); margin-top: 6px;
      display: flex; align-items: center; gap: 5px;
    }
    .code-hint i { color: var(--accent); }

    .copy-btn {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 11px 22px; background: var(--off-white);
      border: 1.5px solid var(--gray-light); border-radius: 10px;
      font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600;
      color: var(--navy); cursor: pointer; transition: all 0.2s;
      white-space: nowrap;
    }
    .copy-btn:hover { background: var(--gray-light); border-color: var(--gray); }
    .copy-btn.copied { background: var(--green-bg); border-color: var(--green-border); color: var(--green); }

    /* ─── DETAIL CARD ─── */
    .detail-card {
      background: white;
      border: 1.5px solid var(--gray-light);
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 4px 24px rgba(11,31,75,0.06);
      animation: fadeUp 0.5s ease 0.2s both;
    }
    .detail-header {
      padding: 18px 24px;
      border-bottom: 1px solid var(--gray-light);
      display: flex; align-items: center; gap: 10px;
    }
    .detail-header-icon {
      width: 34px; height: 34px; border-radius: 9px; background: var(--navy);
      display: flex; align-items: center; justify-content: center;
      color: white; font-size: 14px; flex-shrink: 0;
    }
    .detail-header-title { font-size: 14px; font-weight: 700; color: var(--navy); }

    .detail-rows { padding: 8px 0; }
    .detail-row {
      display: flex; align-items: flex-start;
      justify-content: space-between; gap: 16px;
      padding: 12px 24px;
      border-bottom: 1px solid var(--gray-light);
      transition: background 0.15s;
    }
    .detail-row:last-child { border-bottom: none; }
    .detail-row:hover { background: var(--off-white); }
    .detail-row-key {
      display: flex; align-items: center; gap: 8px;
      font-size: 13px; color: var(--gray); font-weight: 500;
      white-space: nowrap; flex-shrink: 0;
    }
    .detail-row-key i { color: var(--blue); font-size: 11px; width: 13px; }
    .detail-row-val {
      font-size: 13px; font-weight: 600; color: var(--text);
      text-align: right;
    }
    .detail-row-val.price { font-size: 15px; font-weight: 800; color: var(--navy); }

    /* Status badge */
    .status-badge {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 3px 10px; border-radius: 100px;
      font-size: 12px; font-weight: 700; text-transform: capitalize;
    }
    .status-badge.pending  { background: var(--orange-bg); color: var(--orange); border: 1px solid var(--orange-border); }
    .status-badge.confirmed { background: var(--green-bg); color: var(--green); border: 1px solid var(--green-border); }
    .status-badge.cancelled { background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; }

    /* Service badge */
    .service-badge {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 3px 10px; border-radius: 100px;
      font-size: 12px; font-weight: 700;
      background: var(--gray-light); color: var(--navy);
    }

    /* ─── WA NOTICE ─── */
    .wa-notice {
      border-radius: 14px; padding: 14px 18px;
      display: flex; align-items: flex-start; gap: 12px;
      animation: fadeUp 0.5s ease 0.25s both;
    }
    .wa-notice.success { background: var(--green-bg); border: 1.5px solid var(--green-border); }
    .wa-notice.warning { background: var(--orange-bg); border: 1.5px solid var(--orange-border); }
    .wa-notice-icon {
      width: 34px; height: 34px; border-radius: 9px;
      display: flex; align-items: center; justify-content: center;
      font-size: 14px; flex-shrink: 0;
    }
    .wa-notice.success .wa-notice-icon { background: rgba(5,150,105,0.15); color: var(--green); }
    .wa-notice.warning .wa-notice-icon { background: rgba(217,119,6,0.15); color: var(--orange); }
    .wa-notice-title { font-size: 13px; font-weight: 700; margin-bottom: 2px; }
    .wa-notice.success .wa-notice-title { color: var(--green-dark); }
    .wa-notice.warning .wa-notice-title { color: var(--orange); }
    .wa-notice-desc { font-size: 12px; line-height: 1.5; color: var(--gray); }

    /* ─── ACTION BUTTONS ─── */
    .action-row {
      display: flex; gap: 12px; flex-wrap: wrap;
      animation: fadeUp 0.5s ease 0.3s both;
    }
    .btn-action {
      flex: 1; min-width: 160px;
      display: inline-flex; align-items: center; justify-content: center; gap: 9px;
      padding: 14px 20px;
      font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 600;
      border-radius: 11px; cursor: pointer; text-decoration: none;
      transition: all 0.25s;
    }
    .btn-action.primary {
      background: var(--navy); color: white; border: none;
      box-shadow: 0 4px 20px rgba(11,31,75,0.2);
    }
    .btn-action.primary:hover {
      background: var(--blue); transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(26,77,179,0.25);
    }
    .btn-action.outline {
      background: white; color: var(--navy);
      border: 1.5px solid var(--gray-light);
    }
    .btn-action.outline:hover {
      border-color: var(--navy); background: var(--off-white);
      transform: translateY(-2px);
    }

    /* ─── FOOTER ─── */
    footer { background: #07132E; padding: 32px 5%; color: rgba(255,255,255,0.6); }
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
      .success-banner { flex-direction: column; gap: 16px; padding: 28px 22px; }
      .booking-code-card { flex-direction: column; align-items: flex-start; }
      .copy-btn { width: 100%; justify-content: center; }
      .action-row { flex-direction: column; }
      .btn-action { min-width: unset; }
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

  <!-- MAIN -->
  <main class="main-content">
    <div class="main-inner">

      <!-- Success Banner -->
      <div class="success-banner">
        <div class="success-icon-wrap">
          <i class="fa-solid fa-check"></i>
        </div>
        <div class="success-text">
          <div class="success-title">Booking Berhasil Dibuat</div>
          <div class="success-subtitle">Pemesanan Anda telah tercatat. Simpan kode booking di bawah untuk keperluan pengecekan dan pembatalan.</div>
        </div>
      </div>

      <!-- Booking Code -->
      <div class="booking-code-card">
        <div class="code-left">
          <div class="code-label">Kode Booking</div>
          <div class="code-value" id="bookingCode">{{ $booking->booking_code }}</div>
          <div class="code-hint">
            <i class="fa-solid fa-triangle-exclamation"></i>
            Simpan kode ini untuk cek status dan pembatalan
          </div>
        </div>
        <button class="copy-btn" id="copyBtn" onclick="copyCode()">
          <i class="fa-regular fa-copy" id="copyIcon"></i>
          <span id="copyLabel">Salin Kode</span>
        </button>
      </div>

      <!-- Detail Card -->
      <div class="detail-card">
        <div class="detail-header">
          <div class="detail-header-icon"><i class="fa-solid fa-receipt"></i></div>
          <div class="detail-header-title">Detail Pemesanan</div>
        </div>
        <div class="detail-rows">
          <div class="detail-row">
            <div class="detail-row-key"><i class="fa-solid fa-user"></i> Nama Penumpang</div>
            <div class="detail-row-val">{{ $booking->passenger_name }}</div>
          </div>
          <div class="detail-row">
            <div class="detail-row-key"><i class="fa-solid fa-sliders"></i> Jenis Layanan</div>
            <div class="detail-row-val">
              <span class="service-badge">
                <i class="fa-solid fa-{{ $booking->service_type === 'carter' ? 'van-shuttle' : 'user' }}"></i>
                {{ ucfirst($booking->service_type) }}
              </span>
            </div>
          </div>
          <div class="detail-row">
            <div class="detail-row-key"><i class="fa-solid fa-route"></i> Rute</div>
            <div class="detail-row-val">
              {{ $booking->schedule->route->origin_city }}
              <i class="fa-solid fa-arrow-right" style="font-size:10px; color:var(--gray); margin: 0 4px;"></i>
              {{ $booking->schedule->route->destination_city }}
            </div>
          </div>
          <div class="detail-row">
            <div class="detail-row-key"><i class="fa-regular fa-calendar"></i> Tanggal</div>
            <div class="detail-row-val">{{ $booking->schedule->departure_date->format('d M Y') }}</div>
          </div>
          <div class="detail-row">
            <div class="detail-row-key"><i class="fa-regular fa-clock"></i> Jam Berangkat</div>
            <div class="detail-row-val">{{ \Carbon\Carbon::parse($booking->schedule->departure_time)->format('H:i') }} WIB</div>
          </div>
          <div class="detail-row">
            <div class="detail-row-key"><i class="fa-solid fa-tag"></i> Total Harga</div>
            <div class="detail-row-val price">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
          </div>
          <div class="detail-row">
            <div class="detail-row-key"><i class="fa-solid fa-circle-half-stroke"></i> Status</div>
            <div class="detail-row-val">
              @php $st = strtolower($booking->status); @endphp
              <span class="status-badge {{ in_array($st, ['confirmed','aktif']) ? 'confirmed' : ($st === 'cancelled' ? 'cancelled' : 'pending') }}">
                <i class="fa-solid fa-{{ in_array($st, ['confirmed','aktif']) ? 'circle-check' : ($st === 'cancelled' ? 'circle-xmark' : 'clock') }}"></i>
                {{ ucfirst($booking->status) }}
              </span>
            </div>
          </div>
          @if(optional($booking->cancellation_deadline))
          <div class="detail-row">
            <div class="detail-row-key"><i class="fa-solid fa-calendar-xmark"></i> Batas Pembatalan</div>
            <div class="detail-row-val">{{ $booking->cancellation_deadline->format('d M Y, H:i') }} WIB</div>
          </div>
          @endif
        </div>
      </div>

      <!-- WA Notification -->
      @if($waResult)
        @if(($waResult['ok'] ?? false) && ($waResult['status'] ?? null) == 200)
          <div class="wa-notice success">
            <div class="wa-notice-icon"><i class="fa-brands fa-whatsapp"></i></div>
            <div>
              <div class="wa-notice-title">Konfirmasi WhatsApp Terkirim</div>
              <div class="wa-notice-desc">Pesan konfirmasi sedang diproses ke nomor WhatsApp Anda. Jika belum masuk dalam beberapa menit, silakan hubungi admin.</div>
            </div>
          </div>
        @else
          <div class="wa-notice warning">
            <div class="wa-notice-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div>
              <div class="wa-notice-title">Konfirmasi WhatsApp Belum Terkirim</div>
              <div class="wa-notice-desc">Notifikasi WhatsApp gagal dikirim. Simpan kode booking Anda dan hubungi admin untuk konfirmasi manual.</div>
            </div>
          </div>
        @endif
      @endif

      <!-- Action Buttons -->
      <div class="action-row">
        <a href="{{ route('public.booking.status.form') }}" class="btn-action primary">
          <i class="fa-solid fa-magnifying-glass"></i>
          Cek Status Booking
        </a>
        <a href="{{ route('public.availability') }}" class="btn-action outline">
          <i class="fa-regular fa-calendar-check"></i>
          Cek Jadwal Lain
        </a>
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

    // Copy booking code
    function copyCode() {
      const code = document.getElementById('bookingCode').textContent.trim();
      const btn  = document.getElementById('copyBtn');
      const icon = document.getElementById('copyIcon');
      const lbl  = document.getElementById('copyLabel');

      navigator.clipboard.writeText(code).then(() => {
        btn.classList.add('copied');
        icon.className = 'fa-solid fa-check';
        lbl.textContent = 'Tersalin';
        setTimeout(() => {
          btn.classList.remove('copied');
          icon.className = 'fa-regular fa-copy';
          lbl.textContent = 'Salin Kode';
        }, 2500);
      });
    }
  </script>

</body>
</html>