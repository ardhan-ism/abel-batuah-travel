<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Booking - Abel Batuah Travel</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --navy: #0B1F4B; --blue: #1A4DB3; --accent: #F5A623;
      --white: #FFFFFF; --off-white: #F7F9FC; --gray-light: #EBF0FA;
      --gray: #8A99B5; --text: #1C2B4A;
      --green: #059669; --green-bg: #ECFDF5; --green-border: #A7F3D0; --green-dark: #065F46;
      --orange: #D97706; --orange-bg: #FFFBEB; --orange-border: #FDE68A;
      --error: #DC2626; --error-bg: #FEF2F2; --error-border: #FECACA;
      --red-dark: #991B1B;
    }
    html { scroll-behavior: smooth; }
    body { font-family: 'Poppins', sans-serif; background: var(--off-white); color: var(--text); min-height: 100vh; display: flex; flex-direction: column; }

    /* NAVBAR */
    .navbar { position: fixed; top: 0; left: 0; right: 0; z-index: 100; background: rgba(255,255,255,0.95); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(11,31,75,0.08); padding: 0 5%; height: 72px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 16px rgba(11,31,75,0.07); }
    .logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
    .logo-icon { width: 44px; height: 44px; background: var(--navy); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; flex-shrink: 0; }
    .logo-text .brand { font-size: 15px; font-weight: 700; color: var(--navy); line-height: 1.2; }
    .logo-text .sub { font-size: 11px; font-weight: 400; color: var(--gray); letter-spacing: 0.5px; }
    .nav-actions { display: flex; align-items: center; gap: 12px; }
    .btn-outline-nav { padding: 9px 20px; border: 1.5px solid var(--navy); border-radius: 8px; background: transparent; color: var(--navy); font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none; transition: all 0.2s; white-space: nowrap; }
    .btn-outline-nav:hover { background: var(--navy); color: white; }
    .btn-solid-nav { padding: 9px 20px; border: 1.5px solid var(--blue); border-radius: 8px; background: var(--blue); color: white; font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none; transition: all 0.2s; white-space: nowrap; }
    .btn-solid-nav.active, .btn-solid-nav:hover { background: var(--navy); border-color: var(--navy); }
    .burger { display: none; flex-direction: column; gap: 5px; cursor: pointer; padding: 6px; background: none; border: none; }
    .burger span { display: block; width: 24px; height: 2px; background: var(--navy); border-radius: 2px; }
    .mobile-menu { display: none; flex-direction: column; gap: 10px; padding: 16px 5% 20px; background: white; border-bottom: 1px solid var(--gray-light); position: fixed; top: 72px; left: 0; right: 0; z-index: 99; }
    .mobile-menu.open { display: flex; }
    .mobile-menu a { padding: 12px 16px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; text-align: center; }
    .mobile-menu .m-outline { border: 1.5px solid var(--navy); color: var(--navy); }
    .mobile-menu .m-solid { background: var(--blue); color: white; }

    /* PAGE HEADER */
    .page-header { padding: 100px 5% 32px; background: var(--white); border-bottom: 1px solid var(--gray-light); animation: fadeUp 0.5s ease both; }
    .page-header-inner { max-width: 760px; margin: 0 auto; }
    .breadcrumb { display: flex; align-items: center; gap: 8px; margin-bottom: 20px; font-size: 13px; }
    .breadcrumb a { color: var(--gray); text-decoration: none; font-weight: 500; transition: color 0.2s; }
    .breadcrumb a:hover { color: var(--blue); }
    .breadcrumb .sep { color: var(--gray); font-size: 11px; }
    .breadcrumb .current { color: var(--navy); font-weight: 600; }

    /* Header booking code + status */
    .header-row { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; flex-wrap: wrap; }
    .header-code { font-size: clamp(20px, 2.5vw, 28px); font-weight: 900; color: var(--navy); letter-spacing: 1.5px; margin-bottom: 4px; }
    .header-sub { font-size: 14px; color: var(--gray); }

    .status-badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 100px; font-size: 13px; font-weight: 700; text-transform: capitalize; flex-shrink: 0; }
    .status-badge.pending   { background: var(--orange-bg); color: var(--orange); border: 1.5px solid var(--orange-border); }
    .status-badge.confirmed { background: var(--green-bg);  color: var(--green);  border: 1.5px solid var(--green-border); }
    .status-badge.cancelled { background: var(--error-bg);  color: var(--error);  border: 1.5px solid var(--error-border); }
    .status-badge.default   { background: var(--gray-light); color: var(--navy); border: 1.5px solid var(--gray-light); }

    /* MAIN */
    .main-content { flex: 1; padding: 32px 5% 60px; }
    .main-inner { max-width: 760px; margin: 0 auto; display: flex; flex-direction: column; gap: 20px; }

    /* ERROR ALERT */
    .error-alert { background: var(--error-bg); border: 1.5px solid var(--error-border); border-radius: 12px; padding: 14px 18px; display: flex; gap: 12px; align-items: flex-start; animation: fadeUp 0.4s ease both; }
    .error-alert-icon { width: 32px; height: 32px; border-radius: 8px; background: var(--error); display: flex; align-items: center; justify-content: center; color: white; font-size: 13px; flex-shrink: 0; margin-top: 1px; }
    .error-alert-title { font-size: 13px; font-weight: 700; color: var(--error); margin-bottom: 5px; }
    .error-alert ul { list-style: none; padding: 0; }
    .error-alert ul li { font-size: 13px; color: #B91C1C; padding: 2px 0; display: flex; align-items: center; gap: 6px; }
    .error-alert ul li::before { content: ''; display: inline-block; width: 4px; height: 4px; border-radius: 50%; background: #B91C1C; flex-shrink: 0; }

    /* DETAIL CARD */
    .detail-card { background: white; border: 1.5px solid var(--gray-light); border-radius: 18px; overflow: hidden; box-shadow: 0 4px 24px rgba(11,31,75,0.06); animation: fadeUp 0.5s ease 0.1s both; }
    .detail-card-header { padding: 18px 24px; border-bottom: 1px solid var(--gray-light); display: flex; align-items: center; gap: 10px; background: var(--off-white); }
    .detail-card-icon { width: 34px; height: 34px; border-radius: 9px; background: var(--navy); display: flex; align-items: center; justify-content: center; color: white; font-size: 14px; flex-shrink: 0; }
    .detail-card-title { font-size: 14px; font-weight: 700; color: var(--navy); }
    .detail-rows { padding: 4px 0; }
    .detail-row { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; padding: 13px 24px; border-bottom: 1px solid var(--gray-light); transition: background 0.15s; }
    .detail-row:last-child { border-bottom: none; }
    .detail-row:hover { background: var(--off-white); }
    .detail-row-key { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--gray); font-weight: 500; white-space: nowrap; flex-shrink: 0; min-width: 140px; }
    .detail-row-key i { color: var(--blue); font-size: 11px; width: 13px; }
    .detail-row-val { font-size: 13px; font-weight: 600; color: var(--text); text-align: right; }
    .detail-row-val.price { font-size: 15px; font-weight: 800; color: var(--navy); }
    .detail-row-val.addr { text-align: right; line-height: 1.5; max-width: 320px; }

    .route-val { display: flex; align-items: center; gap: 6px; justify-content: flex-end; }
    .route-val i { font-size: 9px; color: var(--gray); }

    .service-badge { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 100px; font-size: 12px; font-weight: 700; background: var(--gray-light); color: var(--navy); }

    /* Carter section */
    .carter-section { background: rgba(26,77,179,0.03); border-top: 1px dashed rgba(26,77,179,0.2); }
    .carter-section .detail-card-header { background: rgba(26,77,179,0.04); border-bottom: 1px solid rgba(26,77,179,0.1); }
    .carter-section .detail-card-icon { background: var(--blue); }
    .carter-section .detail-row { border-bottom-color: rgba(26,77,179,0.08); }
    .carter-section .detail-row:hover { background: rgba(26,77,179,0.03); }

    /* CANCEL SECTION */
    .cancel-card { border-radius: 16px; overflow: hidden; animation: fadeUp 0.5s ease 0.2s both; }
    .cancel-card.can-cancel { background: white; border: 1.5px solid var(--error-border); box-shadow: 0 4px 20px rgba(220,38,38,0.06); }
    .cancel-card.no-cancel  { background: var(--off-white); border: 1.5px solid var(--gray-light); }

    .cancel-card-body { padding: 22px 24px; }
    .cancel-warning { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 20px; }
    .cancel-warning-icon { width: 36px; height: 36px; border-radius: 10px; background: var(--error-bg); border: 1px solid var(--error-border); display: flex; align-items: center; justify-content: center; color: var(--error); font-size: 15px; flex-shrink: 0; }
    .cancel-warning-title { font-size: 14px; font-weight: 700; color: var(--error); margin-bottom: 3px; }
    .cancel-warning-desc  { font-size: 13px; color: #B91C1C; line-height: 1.5; }

    .no-cancel-inner { display: flex; align-items: center; gap: 12px; }
    .no-cancel-icon { width: 36px; height: 36px; border-radius: 10px; background: var(--gray-light); display: flex; align-items: center; justify-content: center; color: var(--gray); font-size: 15px; flex-shrink: 0; }
    .no-cancel-text { font-size: 14px; font-weight: 600; color: var(--gray); }
    .no-cancel-sub  { font-size: 12px; color: var(--gray); margin-top: 2px; }

    .btn-cancel { display: inline-flex; align-items: center; gap: 9px; padding: 12px 24px; background: var(--error); color: white; font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 700; border: none; border-radius: 10px; cursor: pointer; transition: all 0.25s; box-shadow: 0 4px 16px rgba(220,38,38,0.25); }
    .btn-cancel:hover { background: var(--red-dark); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(220,38,38,0.3); }
    .btn-cancel:active { transform: translateY(0); }

    /* BACK LINK */
    .back-row { animation: fadeUp 0.5s ease 0.25s both; }
    .back-link { display: inline-flex; align-items: center; gap: 8px; color: var(--gray); font-size: 13px; font-weight: 500; text-decoration: none; transition: color 0.2s; padding: 8px 0; }
    .back-link:hover { color: var(--navy); }

    /* MODAL */
    .modal-overlay { position: fixed; inset: 0; background: rgba(11,31,75,0.4); backdrop-filter: blur(4px); z-index: 200; display: flex; align-items: center; justify-content: center; padding: 20px; opacity: 0; pointer-events: none; transition: opacity 0.25s; }
    .modal-overlay.open { opacity: 1; pointer-events: all; }
    .modal { background: white; border-radius: 20px; padding: 32px; max-width: 420px; width: 100%; box-shadow: 0 20px 60px rgba(11,31,75,0.2); transform: scale(0.95) translateY(8px); transition: transform 0.25s; }
    .modal-overlay.open .modal { transform: scale(1) translateY(0); }
    .modal-icon { width: 56px; height: 56px; border-radius: 16px; background: var(--error-bg); border: 2px solid var(--error-border); display: flex; align-items: center; justify-content: center; color: var(--error); font-size: 22px; margin: 0 auto 20px; }
    .modal-title { font-size: 18px; font-weight: 800; color: var(--navy); text-align: center; margin-bottom: 8px; }
    .modal-desc  { font-size: 14px; color: var(--gray); text-align: center; line-height: 1.6; margin-bottom: 24px; }
    .modal-actions { display: flex; gap: 12px; }
    .modal-btn-cancel-confirm { flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 13px 16px; background: var(--error); color: white; font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 700; border: none; border-radius: 10px; cursor: pointer; transition: all 0.2s; }
    .modal-btn-cancel-confirm:hover { background: var(--red-dark); }
    .modal-btn-back { flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 13px 16px; background: var(--off-white); color: var(--navy); font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 600; border: 1.5px solid var(--gray-light); border-radius: 10px; cursor: pointer; transition: all 0.2s; }
    .modal-btn-back:hover { background: var(--gray-light); }

    /* FOOTER */
    footer { background: #07132E; padding: 32px 5%; color: rgba(255,255,255,0.6); }
    .footer-inner { max-width: 1200px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; }
    .footer-brand { font-size: 14px; font-weight: 600; color: white; }
    .footer-brand span { font-weight: 400; color: rgba(255,255,255,0.5); font-size: 13px; }
    .footer-contacts { display: flex; align-items: center; gap: 20px; flex-wrap: wrap; }
    .contact-item { display: flex; align-items: center; gap: 8px; text-decoration: none; color: rgba(255,255,255,0.55); font-size: 13px; transition: color 0.2s; }
    .contact-item:hover { color: white; }

    @keyframes fadeUp { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: translateY(0); } }

    @media (max-width: 640px) {
      .nav-actions { display: none; } .burger { display: flex; }
      .detail-row { flex-direction: column; gap: 4px; }
      .detail-row-key { min-width: unset; }
      .detail-row-val, .detail-row-val.addr, .route-val { text-align: left; justify-content: flex-start; }
      .header-row { flex-direction: column; }
      .footer-inner { flex-direction: column; align-items: flex-start; gap: 16px; }
      .modal-actions { flex-direction: column; }
    }
  </style>
</head>
<body>

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
      <a href="{{ route('public.booking.status.form') }}" class="btn-solid-nav active">
        <i class="fa-regular fa-rectangle-list" style="margin-right:6px;"></i> Cek Status Booking
      </a>
    </div>
    <button class="burger" id="burger" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </nav>

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
        <a href="{{ route('home') }}"><i class="fa-solid fa-house" style="font-size:11px;margin-right:4px;"></i> Beranda</a>
        <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
        <a href="{{ route('public.booking.status.form') }}">Cek Status Booking</a>
        <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
        <span class="current">Detail Booking</span>
      </div>
      <div class="header-row">
        <div>
          <div class="header-code">{{ $booking->booking_code }}</div>
          <div class="header-sub">Detail pemesanan dan informasi perjalanan Anda.</div>
        </div>
        @php $st = strtolower($booking->status); @endphp
        <span class="status-badge {{ in_array($st, ['confirmed','aktif']) ? 'confirmed' : ($st === 'cancelled' ? 'cancelled' : ($st === 'pending' ? 'pending' : 'default')) }}">
          <i class="fa-solid fa-{{ in_array($st, ['confirmed','aktif']) ? 'circle-check' : ($st === 'cancelled' ? 'circle-xmark' : 'clock') }}"></i>
          {{ ucfirst($booking->status) }}
        </span>
      </div>
    </div>
  </div>

  <main class="main-content">
    <div class="main-inner">

      @if($errors->any())
      <div class="error-alert">
        <div class="error-alert-icon"><i class="fa-solid fa-exclamation"></i></div>
        <div>
          <div class="error-alert-title">Terjadi kesalahan:</div>
          <ul>
            @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
          </ul>
        </div>
      </div>
      @endif

      <!-- Detail Card -->
      <div class="detail-card">
        <div class="detail-card-header">
          <div class="detail-card-icon"><i class="fa-solid fa-receipt"></i></div>
          <div class="detail-card-title">Detail Pemesanan</div>
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
              <span class="route-val">
                {{ $booking->schedule->route->origin_city }}
                <i class="fa-solid fa-arrow-right"></i>
                {{ $booking->schedule->route->destination_city }}
              </span>
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
            <div class="detail-row-key"><i class="fa-solid fa-chair"></i> Kursi Dipesan</div>
            <div class="detail-row-val">{{ $booking->seats_booked }} kursi</div>
          </div>
          <div class="detail-row">
            <div class="detail-row-key"><i class="fa-solid fa-location-dot"></i> Alamat Jemput</div>
            <div class="detail-row-val addr">{{ $booking->pickup_address }}</div>
          </div>
          <div class="detail-row">
            <div class="detail-row-key"><i class="fa-solid fa-tag"></i> Total Harga</div>
            <div class="detail-row-val price">Rp {{ number_format($booking->total_price,0,',','.') }}</div>
          </div>
          @if(optional($booking->cancellation_deadline))
          <div class="detail-row">
            <div class="detail-row-key"><i class="fa-solid fa-calendar-xmark"></i> Batas Pembatalan</div>
            <div class="detail-row-val">{{ $booking->cancellation_deadline->format('d M Y, H:i') }} WIB</div>
          </div>
          @endif
          @if($booking->cancelled_at)
          <div class="detail-row">
            <div class="detail-row-key"><i class="fa-solid fa-ban"></i> Dibatalkan Pada</div>
            <div class="detail-row-val" style="color:var(--error);">{{ $booking->cancelled_at->format('d M Y, H:i') }} WIB</div>
          </div>
          @endif
        </div>

        @if($booking->service_type === 'carter' && $booking->carterDetail)
        <div class="carter-section">
          <div class="detail-card-header">
            <div class="detail-card-icon"><i class="fa-solid fa-van-shuttle"></i></div>
            <div class="detail-card-title">Detail Carter</div>
          </div>
          <div class="detail-rows">
            <div class="detail-row">
              <div class="detail-row-key"><i class="fa-regular fa-calendar-check"></i> Carter Sampai</div>
              <div class="detail-row-val">{{ $booking->carterDetail->end_date?->format('d M Y') }}</div>
            </div>
            <div class="detail-row">
              <div class="detail-row-key"><i class="fa-solid fa-moon"></i> Total Hari</div>
              <div class="detail-row-val">{{ $booking->carterDetail->total_days }} hari</div>
            </div>
            <div class="detail-row">
              <div class="detail-row-key"><i class="fa-solid fa-wallet"></i> Biaya Sopir/Hari</div>
              <div class="detail-row-val">Rp {{ number_format($booking->carterDetail->driver_daily_cost,0,',','.') }}</div>
            </div>
          </div>
        </div>
        @endif
      </div>

      <!-- Cancel Section -->
      @if($canCancel)
      <div class="cancel-card can-cancel">
        <div class="cancel-card-body">
          <div class="cancel-warning">
            <div class="cancel-warning-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div>
              <div class="cancel-warning-title">Batalkan Booking Ini</div>
              <div class="cancel-warning-desc">Pembatalan hanya dapat dilakukan sebelum batas waktu yang ditentukan. Tindakan ini tidak dapat dibatalkan setelah dikonfirmasi.</div>
            </div>
          </div>
          <form id="cancelForm" method="POST" action="{{ route('public.booking.status.cancel') }}">
            @csrf
            <input type="hidden" name="booking_code" value="{{ $booking->booking_code }}">
            <input type="hidden" name="phone_wa" value="{{ $booking->phone_wa }}">
            <button type="button" class="btn-cancel" onclick="openModal()">
              <i class="fa-solid fa-ban"></i>
              Batalkan Booking
            </button>
          </form>
        </div>
      </div>
      @else
      <div class="cancel-card no-cancel">
        <div class="cancel-card-body">
          <div class="no-cancel-inner">
            <div class="no-cancel-icon"><i class="fa-solid fa-lock"></i></div>
            <div>
              <div class="no-cancel-text">Pembatalan Tidak Tersedia</div>
              <div class="no-cancel-sub">Status sudah diproses atau telah melewati batas waktu pembatalan.</div>
            </div>
          </div>
        </div>
      </div>
      @endif

      <!-- Back -->
      <div class="back-row">
        <a href="{{ route('public.booking.status.form') }}" class="back-link">
          <i class="fa-solid fa-arrow-left"></i>
          Kembali ke Cek Status
        </a>
      </div>

    </div>
  </main>

  <!-- CANCEL MODAL -->
  <div class="modal-overlay" id="cancelModal">
    <div class="modal">
      <div class="modal-icon"><i class="fa-solid fa-ban"></i></div>
      <div class="modal-title">Batalkan Booking?</div>
      <p class="modal-desc">Anda akan membatalkan booking <strong>{{ $booking->booking_code }}</strong>. Tindakan ini permanen dan tidak dapat diurungkan.</p>
      <div class="modal-actions">
        <button type="button" class="modal-btn-back" onclick="closeModal()">
          <i class="fa-solid fa-arrow-left"></i> Kembali
        </button>
        <button type="button" class="modal-btn-cancel-confirm" onclick="submitCancel()">
          <i class="fa-solid fa-ban"></i> Ya, Batalkan
        </button>
      </div>
    </div>
  </div>

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
    const burger = document.getElementById('burger');
    const mobileMenu = document.getElementById('mobileMenu');
    burger.addEventListener('click', () => mobileMenu.classList.toggle('open'));

    const modal = document.getElementById('cancelModal');
    function openModal()  { modal.classList.add('open'); document.body.style.overflow = 'hidden'; }
    function closeModal() { modal.classList.remove('open'); document.body.style.overflow = ''; }
    function submitCancel() { document.getElementById('cancelForm').submit(); }
    modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });
  </script>

</body>
</html>