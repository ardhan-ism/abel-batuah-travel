<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cek Ketersediaan – Abel Batuah Travel</title>
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

    .nav-actions {
      display: flex;
      align-items: center;
      gap: 12px;
    }
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
    .btn-outline-nav:hover { background: var(--navy); color: var(--white); }
    .btn-outline-nav.active { background: var(--navy); color: var(--white); }

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
      display: none;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
      padding: 6px;
      background: none;
      border: none;
    }
    .burger span {
      display: block;
      width: 24px; height: 2px;
      background: var(--navy);
      border-radius: 2px;
      transition: all 0.3s;
    }

    .mobile-menu {
      display: none;
      flex-direction: column;
      gap: 10px;
      padding: 16px 5% 20px;
      background: white;
      border-bottom: 1px solid var(--gray-light);
      position: fixed;
      top: 72px; left: 0; right: 0;
      z-index: 99;
      animation: slideDown 0.25s ease;
    }
    .mobile-menu.open { display: flex; }
    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-8px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .mobile-menu a {
      padding: 12px 16px;
      border-radius: 8px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      text-align: center;
    }
    .mobile-menu .m-outline { border: 1.5px solid var(--navy); color: var(--navy); }
    .mobile-menu .m-solid   { background: var(--blue); color: white; }

    /* ─── PAGE HEADER ─── */
    .page-header {
      padding: 100px 5% 40px;
      background: var(--white);
      border-bottom: 1px solid var(--gray-light);
      animation: fadeUp 0.5s ease forwards;
    }
    .page-header-inner {
      max-width: 760px;
      margin: 0 auto;
    }
    .breadcrumb {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 16px;
      font-size: 13px;
    }
    .breadcrumb a {
      color: var(--gray);
      text-decoration: none;
      font-weight: 500;
      transition: color 0.2s;
    }
    .breadcrumb a:hover { color: var(--blue); }
    .breadcrumb .sep { color: var(--gray); font-size: 11px; }
    .breadcrumb .current { color: var(--navy); font-weight: 600; }

    .page-title {
      font-size: clamp(24px, 3vw, 36px);
      font-weight: 800;
      color: var(--navy);
      margin-bottom: 6px;
    }
    .page-subtitle {
      font-size: 15px;
      color: var(--gray);
    }

    /* ─── MAIN CONTENT ─── */
    .main-content {
      flex: 1;
      padding: 40px 5% 60px;
    }
    .main-inner {
      max-width: 760px;
      margin: 0 auto;
    }

    /* ─── ERROR ALERT ─── */
    .error-alert {
      background: var(--error-bg);
      border: 1.5px solid var(--error-border);
      border-radius: 12px;
      padding: 16px 20px;
      margin-bottom: 24px;
      display: flex;
      gap: 12px;
      align-items: flex-start;
      animation: fadeUp 0.4s ease forwards;
    }
    .error-alert-icon {
      width: 32px; height: 32px;
      border-radius: 8px;
      background: var(--error);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 13px;
      flex-shrink: 0;
      margin-top: 1px;
    }
    .error-alert-title {
      font-size: 13px;
      font-weight: 700;
      color: var(--error);
      margin-bottom: 6px;
    }
    .error-alert ul {
      list-style: none;
      padding: 0;
    }
    .error-alert ul li {
      font-size: 13px;
      color: #B91C1C;
      padding: 2px 0;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .error-alert ul li::before {
      content: '';
      display: inline-block;
      width: 4px; height: 4px;
      border-radius: 50%;
      background: #B91C1C;
      flex-shrink: 0;
    }

    /* ─── FORM CARD ─── */
    .form-card {
      background: white;
      border: 1.5px solid var(--gray-light);
      border-radius: 20px;
      padding: 36px;
      box-shadow: 0 4px 24px rgba(11,31,75,0.06);
      animation: fadeUp 0.5s ease 0.1s both;
    }

    .form-card-header {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 32px;
      padding-bottom: 24px;
      border-bottom: 1px solid var(--gray-light);
    }
    .form-card-icon {
      width: 48px; height: 48px;
      border-radius: 14px;
      background: var(--navy);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 20px;
      flex-shrink: 0;
    }
    .form-card-title {
      font-size: 18px;
      font-weight: 700;
      color: var(--navy);
    }
    .form-card-desc {
      font-size: 13px;
      color: var(--gray);
      margin-top: 2px;
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }
    .form-group { display: flex; flex-direction: column; gap: 8px; }
    .form-group.full { grid-column: 1 / -1; }

    .form-label {
      font-size: 13px;
      font-weight: 600;
      color: var(--navy);
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .form-label i { color: var(--blue); font-size: 12px; }

    .form-control {
      width: 100%;
      padding: 12px 16px;
      border: 1.5px solid var(--gray-light);
      border-radius: 10px;
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
      font-weight: 400;
      color: var(--text);
      background: white;
      transition: all 0.2s;
      outline: none;
      appearance: none;
      -webkit-appearance: none;
    }
    .form-control:focus {
      border-color: var(--blue);
      box-shadow: 0 0 0 3px rgba(26,77,179,0.08);
    }
    .form-control:disabled {
      background: var(--off-white);
      color: var(--gray);
      cursor: not-allowed;
    }
    .form-control::placeholder { color: var(--gray); }

    /* Custom select arrow */
    .select-wrapper {
      position: relative;
    }
    .select-wrapper .form-control {
      padding-right: 40px;
      cursor: pointer;
    }
    .select-wrapper::after {
      content: '\f078';
      font-family: 'Font Awesome 6 Free';
      font-weight: 900;
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray);
      font-size: 11px;
      pointer-events: none;
      transition: color 0.2s;
    }
    .select-wrapper:focus-within::after { color: var(--blue); }

    /* Loading state for destination select */
    .select-wrapper.loading::after {
      content: '\f110';
      animation: spin 0.8s linear infinite;
    }
    @keyframes spin {
      from { transform: translateY(-50%) rotate(0deg); }
      to   { transform: translateY(-50%) rotate(360deg); }
    }

    /* Date input icon override */
    input[type="date"]::-webkit-calendar-picker-indicator {
      opacity: 0.5;
      cursor: pointer;
    }

    .form-footer {
      margin-top: 28px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      flex-wrap: wrap;
    }

    .btn-submit {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 32px;
      background: var(--navy);
      color: white;
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
      font-weight: 700;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.25s;
      box-shadow: 0 4px 20px rgba(11,31,75,0.2);
    }
    .btn-submit:hover {
      background: var(--blue);
      transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(26,77,179,0.25);
    }
    .btn-submit:active { transform: translateY(0); }

    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--gray);
      font-size: 13px;
      font-weight: 500;
      text-decoration: none;
      transition: color 0.2s;
    }
    .back-link:hover { color: var(--navy); }

    /* ─── FOOTER ─── */
    footer {
      background: #07132E;
      padding: 32px 5%;
      color: rgba(255,255,255,0.6);
    }
    .footer-inner {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      flex-wrap: wrap;
    }
    .footer-brand {
      font-size: 14px;
      font-weight: 600;
      color: white;
    }
    .footer-brand span { font-weight: 400; color: rgba(255,255,255,0.5); font-size: 13px; }
    .footer-contacts {
      display: flex;
      align-items: center;
      gap: 20px;
      flex-wrap: wrap;
    }
    .contact-item {
      display: flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
      color: rgba(255,255,255,0.55);
      font-size: 13px;
      transition: color 0.2s;
    }
    .contact-item:hover { color: white; }
    .contact-item i { font-size: 14px; }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(16px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 640px) {
      .nav-actions { display: none; }
      .burger { display: flex; }
      .form-card { padding: 24px 20px; }
      .form-grid { grid-template-columns: 1fr; }
      .form-group.full { grid-column: 1; }
      .form-footer { flex-direction: column-reverse; align-items: stretch; }
      .btn-submit { justify-content: center; }
      .back-link { justify-content: center; }
      .footer-inner { flex-direction: column; align-items: flex-start; gap: 16px; }
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
        <span class="current">Cek Ketersediaan</span>
      </div>
      <h1 class="page-title">Cek Ketersediaan Jadwal</h1>
      <p class="page-subtitle">Pilih kota keberangkatan, tujuan, dan tanggal perjalanan Anda.</p>
    </div>
  </div>

  <!-- MAIN -->
  <main class="main-content">
    <div class="main-inner">

      <!-- Error Alert -->
      @if ($errors->any())
      <div class="error-alert">
        <div class="error-alert-icon">
          <i class="fa-solid fa-exclamation"></i>
        </div>
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

      <!-- Form Card -->
      <div class="form-card">
        <div class="form-card-header">
          <div class="form-card-icon">
            <i class="fa-solid fa-route"></i>
          </div>
          <div>
            <div class="form-card-title">Cari Jadwal Tersedia</div>
            <div class="form-card-desc">Isi detail perjalanan Anda untuk menemukan jadwal yang sesuai.</div>
          </div>
        </div>

        <form method="GET" action="{{ route('public.search') }}">
          <div class="form-grid">

            <!-- Kota Keberangkatan -->
            <div class="form-group">
              <label class="form-label" for="origin">
                <i class="fa-solid fa-location-dot"></i>
                Kota Keberangkatan
              </label>
              <div class="select-wrapper">
                <select id="origin" name="origin" class="form-control" required>
                  <option value="">Pilih kota asal</option>
                  @foreach ($origins as $o)
                    <option value="{{ $o }}" @selected(old('origin') == $o)>{{ $o }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <!-- Kota Tujuan -->
            <div class="form-group">
              <label class="form-label" for="destination">
                <i class="fa-solid fa-flag-checkered"></i>
                Kota Tujuan
              </label>
              <div class="select-wrapper" id="destWrapper">
                <select id="destination" name="destination" class="form-control" required disabled>
                  <option value="">Pilih kota tujuan</option>
                </select>
              </div>
            </div>

            <!-- Tanggal -->
            <div class="form-group full">
              <label class="form-label" for="date">
                <i class="fa-regular fa-calendar"></i>
                Tanggal Keberangkatan
              </label>
              <input
                type="date"
                id="date"
                name="date"
                class="form-control"
                value="{{ old('date') }}"
                min="{{ date('Y-m-d') }}"
                required
              >
            </div>

          </div>

          <div class="form-footer">
            <a href="{{ route('home') }}" class="back-link">
              <i class="fa-solid fa-arrow-left"></i>
              Kembali ke Beranda
            </a>
            <button type="submit" class="btn-submit">
              <i class="fa-solid fa-magnifying-glass"></i>
              Cari Jadwal
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
    // Mobile menu
    const burger = document.getElementById('burger');
    const mobileMenu = document.getElementById('mobileMenu');
    burger.addEventListener('click', () => mobileMenu.classList.toggle('open'));

    // Dynamic destination select
    const originEl = document.getElementById('origin');
    const destEl = document.getElementById('destination');
    const destWrapper = document.getElementById('destWrapper');

    async function loadDestinations(origin) {
      destEl.innerHTML = `<option value="">Pilih kota tujuan</option>`;
      destEl.disabled = true;

      if (!origin) return;

      destWrapper.classList.add('loading');

      try {
        const res = await fetch(`{{ route('public.destinations') }}?origin=${encodeURIComponent(origin)}`);
        const data = await res.json();

        data.forEach(d => {
          const opt = document.createElement('option');
          opt.value = d;
          opt.textContent = d;
          @if(old('destination'))
          if (d === @json(old('destination'))) opt.selected = true;
          @endif
          destEl.appendChild(opt);
        });

        destEl.disabled = false;
      } catch (e) {
        destEl.innerHTML = `<option value="">Gagal memuat tujuan</option>`;
      } finally {
        destWrapper.classList.remove('loading');
      }
    }

    originEl.addEventListener('change', (e) => loadDestinations(e.target.value));

    @if(old('origin'))
      loadDestinations(@json(old('origin')));
    @endif
  </script>

</body>
</html>