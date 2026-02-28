<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cek Status Booking - Abel Batuah Travel</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --navy: #0B1F4B; --blue: #1A4DB3; --accent: #F5A623;
      --white: #FFFFFF; --off-white: #F7F9FC; --gray-light: #EBF0FA;
      --gray: #8A99B5; --text: #1C2B4A;
      --green: #059669; --green-bg: #ECFDF5; --green-border: #A7F3D0;
      --error: #DC2626; --error-bg: #FEF2F2; --error-border: #FECACA;
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
    .mobile-menu { display: none; flex-direction: column; gap: 10px; padding: 16px 5% 20px; background: white; border-bottom: 1px solid var(--gray-light); position: fixed; top: 72px; left: 0; right: 0; z-index: 99;  }
    .mobile-menu.open { display: flex; animation: slideDown 0.25s ease;}
    .mobile-menu a { padding: 12px 16px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; text-align: center; }
    .mobile-menu .m-outline { border: 1.5px solid var(--navy); color: var(--navy); }
    .mobile-menu .m-solid { background: var(--blue); color: white; }

    /* LAYOUT */
    .main-content { flex: 1; display: flex; align-items: center; justify-content: center; padding: 100px 5% 60px; }
    .main-inner { width: 100%; max-width: 520px; display: flex; flex-direction: column; gap: 18px; }

    /* HEADING */
    .page-heading { text-align: center; animation: fadeUp 0.5s ease both; }
    .page-heading-icon { width: 60px; height: 60px; border-radius: 18px; background: var(--navy); display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; margin: 0 auto 16px; animation: popIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) 0.1s both; }
    .page-title { font-size: clamp(22px, 3vw, 30px); font-weight: 800; color: var(--navy); margin-bottom: 6px; }
    .page-subtitle { font-size: 14px; color: var(--gray); line-height: 1.6; }
    

    /* ALERTS */
    .success-alert { background: var(--green-bg); border: 1.5px solid var(--green-border); border-radius: 12px; padding: 14px 18px; display: flex; align-items: center; gap: 12px; animation: fadeUp 0.4s ease both; }
    .success-alert-icon { width: 32px; height: 32px; border-radius: 8px; background: var(--green); display: flex; align-items: center; justify-content: center; color: white; font-size: 13px; flex-shrink: 0; }
    .success-alert-text { font-size: 13px; font-weight: 600; color: #065F46; }
    .error-alert { background: var(--error-bg); border: 1.5px solid var(--error-border); border-radius: 12px; padding: 14px 18px; display: flex; gap: 12px; align-items: flex-start; animation: fadeUp 0.4s ease both; }
    .error-alert-icon { width: 32px; height: 32px; border-radius: 8px; background: var(--error); display: flex; align-items: center; justify-content: center; color: white; font-size: 13px; flex-shrink: 0; margin-top: 1px; }
    .error-alert-title { font-size: 13px; font-weight: 700; color: var(--error); margin-bottom: 5px; }
    .error-alert ul { list-style: none; padding: 0; }
    .error-alert ul li { font-size: 13px; color: #B91C1C; padding: 2px 0; display: flex; align-items: center; gap: 6px; }
    .error-alert ul li::before { content: ''; display: inline-block; width: 4px; height: 4px; border-radius: 50%; background: #B91C1C; flex-shrink: 0; }

    /* FORM CARD */
    .form-card { background: white; border: 1.5px solid var(--gray-light); border-radius: 20px; overflow: hidden; box-shadow: 0 4px 28px rgba(11,31,75,0.07); animation: fadeUp 0.5s ease 0.1s both; }
    .form-body { padding: 32px 32px 24px; display: flex; flex-direction: column; gap: 20px; }
    .form-group { display: flex; flex-direction: column; gap: 7px; }
    .form-label { font-size: 13px; font-weight: 600; color: var(--navy); display: flex; align-items: center; gap: 7px; }
    .form-label i { color: var(--blue); font-size: 11px; }
    .form-control { width: 100%; padding: 12px 14px; border: 1.5px solid var(--gray-light); border-radius: 10px; font-family: 'Poppins', sans-serif; font-size: 14px; color: var(--text); background: white; transition: all 0.2s; outline: none; }
    .form-control:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(26,77,179,0.08); }
    .form-control::placeholder { color: var(--gray); }
    .form-hint { font-size: 12px; color: var(--gray); display: flex; align-items: center; gap: 5px; }
    .form-hint i { font-size: 10px; }
    .form-divider { height: 1px; background: var(--gray-light); }
    .form-footer { padding: 18px 32px 24px; display: flex; flex-direction: column; gap: 14px; }
    .btn-submit { width: 100%; display: flex; align-items: center; justify-content: center; gap: 10px; padding: 14px 24px; background: var(--navy); color: white; font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 700; border: none; border-radius: 11px; cursor: pointer; transition: all 0.25s; box-shadow: 0 4px 20px rgba(11,31,75,0.2); }
    .btn-submit:hover { background: var(--blue); transform: translateY(-2px); box-shadow: 0 8px 28px rgba(26,77,179,0.25); }
    .btn-submit:active { transform: translateY(0); }
    .back-link-row { display: flex; justify-content: center; }
    .back-link { display: inline-flex; align-items: center; gap: 7px; color: var(--gray); font-size: 13px; font-weight: 500; text-decoration: none; transition: color 0.2s; }
    .back-link:hover { color: var(--navy); }

    /* FOOTER */
    footer { background: #07132E; padding: 32px 5%; color: rgba(255,255,255,0.6); }
    .footer-inner { max-width: 1200px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; }
    .footer-brand { font-size: 14px; font-weight: 600; color: white; }
    .footer-brand span { font-weight: 400; color: rgba(255,255,255,0.5); font-size: 13px; }
    .footer-contacts { display: flex; align-items: center; gap: 20px; flex-wrap: wrap; }
    .contact-item { display: flex; align-items: center; gap: 8px; text-decoration: none; color: rgba(255,255,255,0.55); font-size: 13px; transition: color 0.2s; }
    .contact-item:hover { color: white; }

    @keyframes fadeUp { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes popIn { from { transform: scale(0.5); opacity: 0; } to { transform: scale(1); opacity: 1; } }

    @media (max-width: 640px) {
      .nav-actions { display: none; } .burger { display: flex; }
      .form-body { padding: 24px 20px 18px; } .form-footer { padding: 14px 20px 22px; }
      .footer-inner { flex-direction: column; align-items: flex-start; gap: 16px; }
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

  <main class="main-content">
    <div class="main-inner">

      <div class="page-heading">
        <div class="page-heading-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
        <h1 class="page-title">Cek Status Booking</h1>
        <p class="page-subtitle">Masukkan kode booking dan nomor WhatsApp<br>yang digunakan saat pemesanan.</p>
      </div>

      @if(session('success'))
      <div class="success-alert">
        <div class="success-alert-icon"><i class="fa-solid fa-check"></i></div>
        <div class="success-alert-text">{{ session('success') }}</div>
      </div>
      @endif

      @if($errors->any())
      <div class="error-alert">
        <div class="error-alert-icon"><i class="fa-solid fa-exclamation"></i></div>
        <div>
          <div class="error-alert-title">Mohon perbaiki kesalahan berikut:</div>
          <ul>
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      </div>
      @endif

      <div class="form-card">
        <form method="GET" action="{{ route('public.booking.status.show') }}">
          <div class="form-body">

            <div class="form-group">
              <label class="form-label" for="booking_code">
                <i class="fa-solid fa-ticket"></i>
                Kode Booking
              </label>
              <input
                type="text" id="booking_code" name="booking_code"
                value="{{ old('booking_code') }}"
                placeholder="Contoh: ABT-20260222-00001"
                class="form-control" required autocomplete="off"
                style="text-transform:uppercase; letter-spacing:1px;"
              >
              <span class="form-hint">
                <i class="fa-solid fa-circle-info"></i>
                Kode booking dikirimkan saat pemesanan berhasil.
              </span>
            </div>

            <div class="form-divider"></div>

            <div class="form-group">
              <label class="form-label" for="phone_wa">
                <i class="fa-brands fa-whatsapp"></i>
                Nomor WhatsApp
              </label>
              <input
                type="text" id="phone_wa" name="phone_wa"
                value="{{ old('phone_wa') }}"
                placeholder="Contoh: 08123456789"
                class="form-control" required
              >
              <span class="form-hint">
                <i class="fa-solid fa-circle-info"></i>
                Gunakan nomor yang sama seperti saat melakukan pemesanan.
              </span>
            </div>

          </div>
          <div class="form-footer">
            <button type="submit" class="btn-submit">
              <i class="fa-solid fa-magnifying-glass"></i>
              Cek Status
            </button>
            <div class="back-link-row">
              <a href="{{ route('home') }}" class="back-link">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali ke Beranda
              </a>
            </div>
          </div>
        </form>
      </div>

    </div>
  </main>

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

    const bookingInput = document.getElementById('booking_code');
    bookingInput.addEventListener('input', (e) => {
      const pos = e.target.selectionStart;
      e.target.value = e.target.value.toUpperCase();
      e.target.setSelectionRange(pos, pos);
    });
  </script>

</body>
</html>