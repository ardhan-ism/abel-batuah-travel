<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Abel Batuah Travel</title>
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
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'Poppins', sans-serif;
      background: var(--white);
      color: var(--text);
      overflow-x: hidden;
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
      transition: box-shadow 0.3s;
    }
    .navbar.scrolled { box-shadow: 0 4px 24px rgba(11,31,75,0.12); }

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
    .logo-text { line-height: 1.2; }
    .logo-text .brand { font-size: 15px; font-weight: 700; color: var(--navy); }
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
    .btn-outline-nav:hover {
      background: var(--navy);
      color: var(--white);
    }

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
    .btn-solid-nav:hover {
      background: var(--navy);
      border-color: var(--navy);
    }

    /* Burger */
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

    /* Mobile menu */
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
    .mobile-menu .m-outline {
      border: 1.5px solid var(--navy);
      color: var(--navy);
    }
    .mobile-menu .m-solid {
      background: var(--blue);
      color: white;
    }

    /* ─── HERO ─── */
    .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      padding: 100px 5% 60px;
      background: var(--off-white);
      position: relative;
      overflow: hidden;
    }

    /* Geometric background shapes */
    .hero::before {
      content: '';
      position: absolute;
      top: -100px; right: -100px;
      width: 600px; height: 600px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(26,77,179,0.07) 0%, transparent 70%);
      pointer-events: none;
    }
    .hero::after {
      content: '';
      position: absolute;
      bottom: -80px; left: -80px;
      width: 400px; height: 400px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(11,31,75,0.05) 0%, transparent 70%);
      pointer-events: none;
    }

    /* Decorative lines */
    .hero-lines {
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      pointer-events: none;
      overflow: hidden;
    }
    .hero-lines::before {
      content: '';
      position: absolute;
      top: 30%; right: 8%;
      width: 1px; height: 200px;
      background: linear-gradient(to bottom, transparent, rgba(26,77,179,0.2), transparent);
    }
    .hero-lines::after {
      content: '';
      position: absolute;
      top: 20%; right: 12%;
      width: 1px; height: 120px;
      background: linear-gradient(to bottom, transparent, rgba(26,77,179,0.15), transparent);
    }

    .hero-inner {
      max-width: 1200px;
      width: 100%;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
      align-items: center;
      position: relative;
      z-index: 1;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(26,77,179,0.08);
      border: 1px solid rgba(26,77,179,0.15);
      border-radius: 100px;
      padding: 6px 16px;
      font-size: 12px;
      font-weight: 600;
      color: var(--blue);
      margin-bottom: 20px;
      opacity: 0;
      animation: fadeUp 0.6s ease 0.1s forwards;
    }

    .hero-title {
      font-size: clamp(32px, 4vw, 52px);
      font-weight: 800;
      line-height: 1.15;
      color: var(--navy);
      margin-bottom: 16px;
      opacity: 0;
      animation: fadeUp 0.6s ease 0.2s forwards;
    }
    .hero-title .accent-word {
      color: var(--blue);
      position: relative;
    }
    .hero-title .accent-word::after {
      content: '';
      position: absolute;
      bottom: 0; left: 0; right: 0;
      height: 3px;
      background: var(--accent);
      border-radius: 2px;
    }

    .hero-desc {
      font-size: 15px;
      font-weight: 400;
      line-height: 1.7;
      color: var(--gray);
      margin-bottom: 32px;
      max-width: 480px;
      opacity: 0;
      animation: fadeUp 0.6s ease 0.3s forwards;
    }

    .hero-btns {
      display: flex;
      gap: 14px;
      flex-wrap: wrap;
      opacity: 0;
      animation: fadeUp 0.6s ease 0.4s forwards;
    }

    .btn-primary {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 14px 28px;
      background: var(--navy);
      color: white;
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
      font-weight: 600;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.25s;
      box-shadow: 0 4px 20px rgba(11,31,75,0.25);
    }
    .btn-primary:hover {
      background: var(--blue);
      transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(26,77,179,0.3);
    }

    .btn-secondary {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 14px 28px;
      background: transparent;
      color: var(--navy);
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
      font-weight: 600;
      border: 2px solid var(--navy);
      border-radius: 10px;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.25s;
    }
    .btn-secondary:hover {
      background: var(--navy);
      color: white;
      transform: translateY(-2px);
    }

    /* ─── HERO RIGHT PANEL ─── */
    .hero-visual {
      background: var(--navy);
      border-radius: 20px;
      padding: 32px 28px;
      position: relative;
      overflow: hidden;
      opacity: 0;
      animation: fadeLeft 0.7s ease 0.3s forwards;
    }
    .hero-visual::before {
      content: '';
      position: absolute;
      top: -40px; right: -40px;
      width: 200px; height: 200px;
      border-radius: 50%;
      background: rgba(255,255,255,0.04);
    }
    .hero-visual::after {
      content: '';
      position: absolute;
      bottom: -20px; left: -20px;
      width: 120px; height: 120px;
      border-radius: 50%;
      background: rgba(255,255,255,0.03);
    }

    .visual-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 24px;
      position: relative;
      z-index: 1;
    }
    .visual-title {
      font-size: 13px;
      font-weight: 600;
      color: rgba(255,255,255,0.7);
      letter-spacing: 1px;
      text-transform: uppercase;
    }
    .visual-dot { width: 8px; height: 8px; background: var(--accent); border-radius: 50%; }

    .destination-list {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 8px;
      position: relative;
      z-index: 1;
    }
    .destination-item {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 12px 14px;
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 10px;
      transition: all 0.2s;
      cursor: default;
      animation: fadeUp 0.5s ease forwards;
      opacity: 0;
    }
    .destination-item:hover {
      background: rgba(255,255,255,0.12);
      border-color: rgba(255,255,255,0.18);
      transform: translateX(4px);
    }

    .dest-num {
      width: 26px; height: 26px;
      border-radius: 6px;
      background: rgba(255,255,255,0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      font-weight: 700;
      color: rgba(255,255,255,0.6);
      flex-shrink: 0;
    }
    .dest-name {
      font-size: 14px;
      font-weight: 500;
      color: white;
      flex: 1;
    }
    .dest-icon {
      color: rgba(255,255,255,0.3);
      font-size: 12px;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(16px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeLeft {
      from { opacity: 0; transform: translateX(24px); }
      to   { opacity: 1; transform: translateX(0); }
    }

    /* ─── DESTINATIONS SECTION ─── */
    .section-destinations {
      padding: 80px 5%;
      background: white;
    }
    .section-inner {
      max-width: 1200px;
      margin: 0 auto;
    }
    .section-label {
      font-size: 12px;
      font-weight: 700;
      color: var(--blue);
      letter-spacing: 2px;
      text-transform: uppercase;
      margin-bottom: 10px;
    }
    .section-title {
      font-size: clamp(24px, 3vw, 36px);
      font-weight: 800;
      color: var(--navy);
      margin-bottom: 8px;
    }
    .section-subtitle {
      font-size: 15px;
      color: var(--gray);
      margin-bottom: 48px;
      max-width: 500px;
    }

    .dest-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 16px;
    }
    .dest-card {
      border: 1.5px solid var(--gray-light);
      border-radius: 14px;
      padding: 20px 18px;
      display: flex;
      align-items: center;
      gap: 14px;
      transition: all 0.25s;
      opacity: 0;
      transform: translateY(12px);
    }
    .dest-card.visible {
      animation: fadeUp 0.5s ease forwards;
    }
    .dest-card:hover {
      border-color: var(--blue);
      background: var(--off-white);
      box-shadow: 0 4px 20px rgba(26,77,179,0.08);
      transform: translateY(-3px);
    }
    .dest-card-num {
      width: 32px; height: 32px;
      border-radius: 8px;
      background: var(--gray-light);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      font-weight: 700;
      color: var(--navy);
      flex-shrink: 0;
      transition: all 0.25s;
    }
    .dest-card:hover .dest-card-num {
      background: var(--blue);
      color: white;
    }
    .dest-card-name {
      font-size: 14px;
      font-weight: 600;
      color: var(--text);
    }

    /* ─── CTA SECTION ─── */
    .section-cta {
      padding: 80px 5%;
      background: var(--navy);
      position: relative;
      overflow: hidden;
    }
    .section-cta::before {
      content: '';
      position: absolute;
      top: -120px; right: -80px;
      width: 500px; height: 500px;
      border-radius: 50%;
      background: rgba(255,255,255,0.03);
    }
    .section-cta::after {
      content: '';
      position: absolute;
      bottom: -60px; left: 5%;
      width: 200px; height: 200px;
      border-radius: 50%;
      background: rgba(255,255,255,0.02);
    }
    .cta-inner {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 32px;
      flex-wrap: wrap;
      position: relative;
      z-index: 1;
    }
    .cta-text .cta-label {
      font-size: 12px;
      font-weight: 700;
      color: var(--accent);
      letter-spacing: 2px;
      text-transform: uppercase;
      margin-bottom: 10px;
    }
    .cta-text .cta-title {
      font-size: clamp(22px, 2.5vw, 32px);
      font-weight: 800;
      color: white;
      margin-bottom: 8px;
    }
    .cta-text .cta-desc {
      font-size: 14px;
      color: rgba(255,255,255,0.6);
      max-width: 400px;
      line-height: 1.6;
    }
    .cta-btns {
      display: flex;
      gap: 14px;
      flex-wrap: wrap;
      flex-shrink: 0;
    }
    .btn-cta-primary {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 14px 28px;
      background: white;
      color: var(--navy);
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
      font-weight: 700;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.25s;
    }
    .btn-cta-primary:hover {
      background: var(--accent);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(245,166,35,0.3);
    }
    .btn-cta-secondary {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 14px 28px;
      background: transparent;
      color: white;
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
      font-weight: 600;
      border: 2px solid rgba(255,255,255,0.3);
      border-radius: 10px;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.25s;
    }
    .btn-cta-secondary:hover {
      border-color: white;
      background: rgba(255,255,255,0.1);
      transform: translateY(-2px);
    }

    /* ─── FOOTER ─── */
    footer {
      background: #07132E;
      padding: 48px 5% 28px;
      color: rgba(255,255,255,0.6);
    }
    .footer-inner {
      max-width: 1200px;
      margin: 0 auto;
    }
    .footer-top {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 40px;
      flex-wrap: wrap;
      padding-bottom: 32px;
      border-bottom: 1px solid rgba(255,255,255,0.08);
      margin-bottom: 24px;
    }
    .footer-brand .brand-name {
      font-size: 18px;
      font-weight: 700;
      color: white;
      margin-bottom: 6px;
    }
    .footer-brand .brand-desc {
      font-size: 13px;
      line-height: 1.6;
      max-width: 280px;
    }
    .footer-contact-title {
      font-size: 12px;
      font-weight: 700;
      color: rgba(255,255,255,0.4);
      letter-spacing: 1.5px;
      text-transform: uppercase;
      margin-bottom: 16px;
    }
    .contact-item {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 12px;
      text-decoration: none;
      color: rgba(255,255,255,0.6);
      font-size: 14px;
      transition: color 0.2s;
    }
    .contact-item:hover { color: white; }
    .contact-item i {
      width: 32px; height: 32px;
      border-radius: 8px;
      background: rgba(255,255,255,0.07);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 13px;
      color: rgba(255,255,255,0.5);
      flex-shrink: 0;
      transition: all 0.2s;
    }
    .contact-item:hover i {
      background: rgba(255,255,255,0.12);
      color: white;
    }
    .footer-bottom {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      flex-wrap: wrap;
      font-size: 12px;
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 900px) {
      .hero-inner {
        grid-template-columns: 1fr;
        gap: 40px;
      }
      .hero-visual { order: -1; }
    }

    @media (max-width: 640px) {
      .nav-actions { display: none; }
      .burger { display: flex; }
      .hero { padding: 90px 5% 50px; }
      .hero-btns { flex-direction: column; }
      .btn-primary, .btn-secondary { justify-content: center; }
      .cta-inner { flex-direction: column; }
      .cta-btns { width: 100%; }
      .btn-cta-primary, .btn-cta-secondary { flex: 1; justify-content: center; }
      .footer-top { flex-direction: column; gap: 28px; }
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar" id="navbar">
    <a href="/" class="logo">
      <div class="logo-icon">
        <i class="fa-solid fa-bus"></i>
      </div>
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

  <!-- HERO -->
  <section class="hero">
    <div class="hero-lines"></div>
    <div class="hero-inner">
      <!-- Left -->
      <div>
        <div class="hero-badge">
          <i class="fa-solid fa-location-dot"></i>
          Melayani 9 Tujuan di Kalimantan
        </div>
        <h1 class="hero-title">
          Perjalanan Nyaman<br>ke Seluruh<br>
          <span class="accent-word">Kalimantan</span>
        </h1>
        <p class="hero-desc">
          Abel Batuah Travel hadir untuk melayani perjalanan Anda antar kota di Kalimantan dengan armada terpercaya, jadwal tepat waktu, dan pelayanan terbaik.
        </p>
        <div class="hero-btns">
          <a href="{{ route('public.availability') }}" class="btn-primary">
            <i class="fa-solid fa-magnifying-glass"></i>
            Cek Ketersediaan
          </a>
          <a href="{{ route('public.booking.status.form') }}" class="btn-secondary">
            <i class="fa-solid fa-ticket"></i>
            Cek Status Booking
          </a>
        </div>
      </div>
      <!-- Right -->
      <div class="hero-visual">
        <div class="visual-header">
          <span class="visual-title">Tujuan Kami</span>
          <div class="visual-dot"></div>
        </div>
        <ul class="destination-list">
          @php
            $destinations = [
              'Tamiang Layang','Palangka Raya','Sampit',
              'Pangkalan Bun','Banjarmasin','Balikpapan',
              'Samarinda','Muara Teweh','Puruk Cahu'
            ];
          @endphp
          @foreach($destinations as $i => $dest)
          <li class="destination-item" style="animation-delay: {{ 0.5 + $i * 0.07 }}s">
            <div class="dest-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
            <span class="dest-name">{{ $dest }}</span>
            <i class="fa-solid fa-arrow-right dest-icon"></i>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </section>

  <!-- DESTINATIONS GRID -->
  <section class="section-destinations">
    <div class="section-inner">
      <div class="section-label">Tujuan Perjalanan</div>
      <h2 class="section-title">Kami Melayani 9 Kota</h2>
      <p class="section-subtitle">Temukan jadwal dan ketersediaan kursi untuk rute tujuan Anda.</p>
      <div class="dest-grid" id="destGrid">
        @php
          $icons = ['fa-map-pin','fa-city','fa-tree','fa-mountain','fa-water','fa-building','fa-flag','fa-star','fa-compass'];
        @endphp
        @foreach($destinations as $i => $dest)
        <div class="dest-card" style="animation-delay: {{ $i * 0.06 }}s">
          <div class="dest-card-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
          <span class="dest-card-name">{{ $dest }}</span>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- CTA SECTION -->
  <section class="section-cta">
    <div class="cta-inner">
      <div class="cta-text">
        <div class="cta-label">Siap Berangkat?</div>
        <div class="cta-title">Pesan Tiket Anda Sekarang</div>
        <p class="cta-desc">Cek ketersediaan kursi dan pesan tiket untuk rute perjalanan Anda hari ini.</p>
      </div>
      <div class="cta-btns">
        <a href="{{ route('public.availability') }}" class="btn-cta-primary">
          <i class="fa-solid fa-magnifying-glass"></i>
          Cek Ketersediaan
        </a>
        <a href="{{ route('public.booking.status.form') }}" class="btn-cta-secondary">
          <i class="fa-solid fa-ticket"></i>
          Cek Status Booking
        </a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="footer-inner">
      <div class="footer-top">
        <div class="footer-brand">
          <div class="brand-name">Abel Batuah Travel</div>
          <p class="brand-desc">Layanan transportasi antar kota terpercaya di wilayah Kalimantan dengan armada nyaman dan tepat waktu.</p>
        </div>
        <div>
          <div class="footer-contact-title">Hubungi Kami</div>
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
      <div class="footer-bottom">
        <span>&copy; {{ date('Y') }} Abel Batuah Travel. Semua hak dilindungi.</span>
        <span>Kalimantan Tengah, Indonesia</span>
      </div>
    </div>
  </footer>

  <script>
    // Navbar scroll effect
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('scrolled', window.scrollY > 10);
    });

    // Mobile menu toggle
    const burger = document.getElementById('burger');
    const mobileMenu = document.getElementById('mobileMenu');
    burger.addEventListener('click', () => {
      mobileMenu.classList.toggle('open');
    });

    // Scroll-triggered animations for dest cards
    const cards = document.querySelectorAll('.dest-card');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, { threshold: 0.1 });
    cards.forEach(card => observer.observe(card));
  </script>

</body>
</html>