<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Men's Hair Studio</title>
    <link rel="icon" type="image/png" href="{{ asset('icons/mens.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/4.0.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <style>
        :root {
            --gold: #C9A84C;
            --gold-light: #E2C97E;
            --charcoal: #252525;
            --dark: #1C1C1C;
            --surface: #2E2E2E;
            --border: #3D3D3D;
            --muted: #8A8A8A;
            --text: #F0EDE8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--dark);
            color: var(--text);
        }

        .gold-line {
            width: 60px;
            height: 2px;
            background: var(--gold);
            margin: 0 auto 1.5rem;
        }

        .gold-line-left {
            margin: 0 0 1.5rem;
        }

        .nav-link {
            position: relative;
            color: #d1d5db;
            font-size: 14px;
            transition: .3s;
        }

        .nav-link:hover {
            color: #C9A84C;
        }

        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -6px;
            width: 0%;
            height: 1px;
            background: #C9A84C;
            transition: .3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn-gold {
            background: var(--gold);
            color: var(--dark);
            padding: 0.85rem 2.5rem;
            font-weight: 600;
            font-size: 0.8rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
        }

        .btn-gold:hover {
            background: var(--gold-light);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            color: var(--gold);
            padding: 0.85rem 2.5rem;
            font-weight: 600;
            font-size: 0.8rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            border: 1px solid var(--gold);
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
        }

        .btn-outline:hover {
            background: var(--gold);
            color: var(--dark);
        }

        .section-tag {
            font-size: 0.75rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--gold);
            font-weight: 500;
            margin-bottom: 0.75rem;
            display: block;
        }

        .service-card {
            background: var(--surface);
            border: 1px solid var(--border);
            padding: 2.5rem 2rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 3px;
            height: 0;
            background: var(--gold);
            transition: height 0.4s ease;
        }

        .service-card:hover {
            border-color: var(--gold);
            transform: translateY(-4px);
        }

        .service-price {
            color: var(--gold);
            font-size: 2rem;
            font-weight: 700;
        }

        .barber-card {
            background: var(--surface);
            border: 1px solid var(--border);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .barber-card:hover {
            border-color: var(--gold);
            transform: translateY(-6px);
        }

        .barber-img {
            width: 100%;
            height: 320px;
            object-fit: cover;
            filter: grayscale(30%);
            transition: filter 0.4s;
        }

        .barber-card:hover .barber-img {
            filter: grayscale(0%);
        }

        .gallery-item {
            overflow: hidden;
            position: relative;
        }

        .gallery-item img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            transition: transform 0.5s ease, filter 0.4s;
            filter: brightness(0.85);
        }

        .gallery-item:hover img {
            transform: scale(1.08);
            filter: brightness(1);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: rgba(201, 168, 76, 0.08);
            opacity: 0;
            transition: opacity 0.4s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        /* ── HERO ── */
        .hero-bg {
            background-color: #1C1C1C;
            position: relative;
            overflow: hidden;
            min-height: 100vh;
        }

        .hero-left-img {
            position: absolute;
            background: url('https://images.unsplash.com/photo-1503951914875-452162b0f3f1?w=1800&q=80') center/cover no-repeat;
            opacity: 0.12;
        }

        .hero-content {
            position: relative;
            z-index: 10;
        }

        .hero-right-img {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 45%;
            z-index: 5;
        }

        .hero-right-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.55;
        }

        .hero-right-fade {
            position: absolute;
            inset: 0;
            background: #1C1C1C;
            -webkit-mask-image: linear-gradient(to right, black 0%, transparent 40%);
            mask-image: linear-gradient(to right, black 0%, transparent 40%);
        }

        .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--gold);
            line-height: 1;
        }

        .testimonial-card {
            background: var(--surface);
            border: 1px solid var(--border);
            padding: 2rem;
            position: relative;
        }

        .testimonial-card::before {
            content: '"';
            font-family: 'Playfair Display', serif;
            font-size: 5rem;
            color: var(--gold);
            opacity: 0.2;
            position: absolute;
            top: -0.5rem;
            left: 1.5rem;
            line-height: 1;
        }

        .stars {
            color: var(--gold);
            letter-spacing: 2px;
        }

        .badge {
            display: inline-block;
            background: rgba(201, 168, 76, 0.1);
            border: 1px solid rgba(201, 168, 76, 0.28);
            color: var(--gold-light);
            font-size: 0.7rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            padding: 0.3rem 0.9rem;
            margin-bottom: 1rem;
        }

        .floating-bar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background: rgba(28, 28, 28, 0.96);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
        }

        footer a {
            color: var(--muted);
            text-decoration: none;
            transition: color 0.3s;
            font-size: 0.9rem;
        }

        footer a:hover {
            color: var(--gold);
        }

        .social-btn {
            width: 38px;
            height: 38px;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            transition: all 0.3s;
            text-decoration: none;
        }

        .social-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        @media (max-width: 768px) {
            .hero-right-img {
                display: none;
            }

            nav {
                margin: 10px 10px 10px 10px !important;
            }
        }
    </style>
</head>

<body>
    <nav id="navbar"
        class="floating-bar fixed top-4 left-1/2 -translate-x-1/2 w-[95%] max-w-7xl z-50 bg-[#1E1E1E]/90 border border-[#3A3A3A] rounded-2xl shadow-lg backdrop-blur-md transition-transform duration-300">
        <div class="">
            <div class="px-6 py-4 flex items-center justify-between">
                <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('icons/mens.png') }}" alt="" width="50">
                    <div>
                        <div class=" text-sm font-bold tracking-[0.25em] text-[#C9A84C] leading-none">MEN'S HAIR STUDIO
                        </div>
                        <div class="text-[10px] tracking-[0.35em] text-gray-400 mt-1">BARBERSHOP</div>
                    </div>
                </a>

                <div class="hidden md:flex items-center gap-8">
                    <a href="#services" class="nav-link">Layanan</a>
                    <a href="#barbers" class="nav-link">Barber</a>
                    <a href="#gallery" class="nav-link">Galeri</a>
                    <a href="#contact" class="nav-link">Kontak</a>
                    <a href="{{ route('user.profile') }}" class="nav-link">Profile</a>
                    <a href="{{ route('user.booking.history') }}" class="nav-link">Riwayat</a>
                    <a href="{{ route('live-antrian') }}" class="nav-link">Live Antrean</a>
                </div>

                <div class="md:flex items-center gap-2">
                    <a href="{{ route('user.booking.create') }}"
                        class="hidden md:inline-flex items-center px-5 py-2.5 rounded-xl bg-[#C9A84C] text-black text-sm font-semibold hover:scale-105 transition duration-300">
                        Booking Sekarang
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="nav-link hidden md:inline-flex items-center px-5 py-2.5 rounded-xl bg-[#C9A84C] text-black text-sm font-semibold hover:scale-105 transition duration-300"><i
                                class="fi fi-br-sign-out-alt"></i></button>
                    </form>
                </div>
                <button class="md:hidden flex flex-col gap-1.5 p-2 rounded-lg hover:bg-white/5 transition"
                    onclick="toggleMenu()">
                    <span class="block w-6 h-px bg-white"></span>
                    <span class="block w-6 h-px bg-white"></span>
                    <span class="block w-4 h-px bg-[#C9A84C]"></span>
                </button>
            </div>

            <div id="mobileMenu" class="hidden md:hidden border-t border-[#3A3A3A] px-6 py-5 flex flex-col gap-3">
                <a href="#services" class="nav-link block py-2">Layanan</a>
                <a href="#barbers" class="nav-link block py-2">Barber</a>
                <a href="#gallery" class="nav-link block py-2">Galeri</a>
                <a href="#contact" class="nav-link block py-2">Kontak</a>
                <a href="{{ route('user.profile') }}" class="nav-link block py-2">Profile</a>
                <a href="{{ route('user.booking.history') }}" class="nav-link block py-2">Riwayat Booking</a>
                <a href="{{ route('live-antrian') }}" class="nav-link block py-2 text-[#C9A84C]">Live Antrean</a>
                <a href="{{ route('user.booking.create') }}"
                    class="mt-3 text-center px-5 py-3 rounded-xl bg-[#C9A84C] text-black font-semibold">Booking
                    Sekarang</a>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero-bg flex items-center pt-20">
        <div class="hero-left-img"></div>

        <div class="hero-right-img">
            <img src="https://images.unsplash.com/photo-1621605815971-fbc98d665033?w=900&q=80" alt="Barber at work">
            <div class="hero-right-fade"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-24 hero-content w-full">
            <div class="max-w-xl">
                <span class="badge rounded-xl">Premium Barbershop · Bengkalis</span>
                <h1 class=" font-bold leading-tight mb-6"
                    style="font-size: clamp(2.8rem, 6vw, 5rem); color: var(--text)">
                    Style Is<br>
                    <span style="color: var(--gold)">Your Signature</span>
                </h1>
                <p class="mb-10 leading-relaxed" style="color: var(--muted); font-size: 1.1rem; max-width: 460px">
                    Pengalaman grooming premium dengan tangan-tangan ahli. Potong rambut bukan hanya tentang rambut —
                    ini tentang siapa kamu.
                </p>
                <div class="flex flex-wrap gap-4 mb-16">
                    <a href="{{ route('user.booking.create') }}" class="btn-gold rounded-xl">Booking Sekarang</a>
                    <a href="{{ route('live-antrian') }}" class="btn-outline rounded-xl flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                        Live Antrean
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- PROMOTIONS & DISCOUNTS -->
    <section id="promotions" class="py-20" style="background: var(--dark); border-bottom: 1px solid var(--border)">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="section-tag">Penawaran Spesial</span>
                <div class="gold-line"></div>
                <h2 class=" font-bold text-4xl" style="color: var(--text)">
                    Promo & Diskon Menarik
                </h2>
                <p class="mt-4 max-w-md mx-auto text-sm" style="color: var(--muted)">
                    Gunakan kode promo berikut saat checkout pemesanan untuk mendapatkan potongan harga spesial dari
                    kami.
                </p>
            </div>

            @if ($promos->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($promos as $promo)
                        <div
                            class="relative overflow-hidden rounded-2xl border border-[#3D3D3D] bg-[#2E2E2E]/40 p-6 backdrop-blur-md flex flex-col justify-between hover:border-[#C9A84C]/50 transition-all duration-300">
                            <!-- Glow background element -->
                            <div class="absolute -top-12 -right-12 w-24 h-24 rounded-full bg-[#C9A84C]/5 blur-xl">
                            </div>

                            <div>
                                <div class="flex justify-between items-start mb-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-[10px] font-bold tracking-wider uppercase bg-[#C9A84C]/10 border border-[#C9A84C]/30 text-[#C9A84C]">
                                        Active Promo
                                    </span>

                                </div>

                                <h3 class="text-lg font-bold text-white ">{{ $promo->nama }}</h3>
                                <p class="text-xs text-gray-400 mt-2 leading-relaxed">
                                    {{ $promo->deskripsi ?: 'Nikmati promo potongan harga spesial dari Mans hair studio.' }}
                                </p>

                                <div
                                    class="mt-4 pt-4 border-t border-[#3D3D3D]/50 flex flex-col gap-1.5 text-[10px] text-gray-400">
                                    <div class="flex justify-between">
                                        <span>Minimal Transaksi:</span>
                                        <span class="text-white font-medium">Rp
                                            {{ number_format($promo->minimal_transaksi, 0, ',', '.') }}</span>
                                    </div>
                                    @if ($promo->akhir_berlaku)
                                        <div class="flex justify-between">
                                            <span>Berlaku hingga:</span>
                                            <span
                                                class="text-[#C9A84C] font-medium">{{ $promo->akhir_berlaku->format('d M Y') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-6 flex items-center justify-between gap-3 z-10">
                                <div
                                    class="bg-[#1C1C1C] border border-[#3D3D3D] rounded-xl px-4 py-2 flex items-center justify-between flex-1">
                                    <span
                                        class="text-xs font-mono font-bold tracking-wider text-[#C9A84C] select-all cursor-pointer"
                                        title="Klik untuk menyalin">{{ $promo->kode }}</span>
                                    <button onclick="copyPromoCode('{{ $promo->kode }}')"
                                        class="text-[10px] text-gray-400 hover:text-white font-semibold transition ml-2">Salin</button>
                                </div>
                                <a href="{{ route('user.booking.create') }}"
                                    class="btn-gold rounded-xl text-center py-2.5 px-4 text-xs font-bold whitespace-nowrap"
                                    style="letter-spacing: 0.05em; padding: 0.7rem 1.2rem;">
                                    Gunakan
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-12 text-center bg-[#2E2E2E]/20 rounded-2xl border border-[#3D3D3D]">
                    <svg class="mx-auto text-gray-500 mb-3" width="36" height="36" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    <p class="text-sm text-gray-400">Saat ini tidak ada promo aktif yang tersedia.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- SERVICES -->
    <section id="services" class="py-24" style="background: var(--charcoal)">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-16">
                <span class="section-tag">Apa yang Kami Tawarkan</span>

                <div class="gold-line"></div>

                <h2 class=" font-bold text-4xl" style="color: var(--text)">
                    Layanan Kami
                </h2>

                <p class="mt-4 max-w-md mx-auto" style="color: var(--muted)">
                    Setiap layanan dikerjakan dengan presisi tinggi dan produk premium pilihan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 items-stretch">

                @forelse ($layanans as $layanan)
                    <div class="service-card rounded-xl h-full flex flex-col">


                        <h3 class=" font-semibold text-xl mb-2" style="color: var(--text)">
                            {{ $layanan->nama }}
                        </h3>
                        <p class="text-sm leading-relaxed mb-4 flex-grow" style="color: var(--muted)">
                            {{ $layanan->deskripsi }}
                        </p>

                        <div class="flex items-end justify-between pt-4 mt-auto"
                            style="border-top: 1px solid var(--border)">

                            <div>
                                <div class="service-price">
                                    Rp {{ number_format($layanan->harga, 0, ',', '.') }}
                                </div>

                                <div class="text-xs mt-1" style="color: var(--muted)">
                                    Estimasi Waktu: {{ $layanan->durasi }} menit
                                </div>
                            </div>

                            <a href="{{ route('user.booking.create') }}" class="btn-outline rounded-xl"
                                style="padding: 0.5rem 1.2rem; font-size: 0.7rem">
                                Book
                            </a>

                        </div>

                    </div>

                @empty

                    <p class="col-span-3 text-center" style="color: var(--muted)">
                        Belum ada layanan tersedia.
                    </p>
                @endforelse

            </div>

        </div>
    </section>

    <!-- BARBERS -->
    <section id="barbers" class="py-24" style="background: var(--dark)">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="section-tag">Tim Kami</span>
                <div class="gold-line"></div>
                <h2 class=" font-bold text-4xl" style="color: var(--text)">Para Barber Ahli</h2>
                <p class="mt-4 max-w-md mx-auto" style="color: var(--muted)">Setiap barber kami tersertifikasi dan
                    berpengalaman lebih dari 3 tahun di industri.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($barbers as $barber)
                    <div class="barber-card rounded-xl">

                        <div class="relative overflow-hidden h-72">
                            <img src="{{ asset('storage/' . $barber->foto) }}" alt="{{ $barber->nama }}"
                                class="barber-img w-full h-full object-cover object-top">
                        </div>

                        <div class="p-6" style="background: var(--surface)">
                            <div class="flex items-start justify-between mb-1">
                                <div>
                                    <h3 class=" font-semibold text-xl" style="color: var(--text)">
                                        {{ $barber->nama }}
                                    </h3>
                                    @if ($barber->bookings_avg_rating)
                                        <div class="flex items-center gap-1 mt-1">
                                            <svg class="w-3.5 h-3.5 text-yellow-500" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <span
                                                class="text-xs font-bold text-gray-300">{{ number_format($barber->bookings_avg_rating, 1) }}</span>
                                        </div>
                                    @endif

                                    <p class="text-sm" style="color: var(--gold)">

                                        @if ($barber->status)
                                            <span>Aktif</span>
                                        @else
                                            <span>Tidak Aktif</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="mt-4 pt-4 flex items-center gap-2"
                                style="border-top: 1px solid var(--border)">

                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="#C9A84C" stroke-width="2">
                                    <path d="M12 2L13.5 8H20L14.5 12L16.5 18L12 14L7.5 18L9.5 12L4 8H10.5Z" />
                                </svg>

                                <span class="text-sm" style="color: var(--muted)">
                                    Keahlian:
                                    <span style="color: var(--text)">
                                        Classic & Fade
                                    </span>
                                </span>
                            </div>
                        </div>

                    </div>

                @empty

                    <p class="col-span-3 text-center" style="color: var(--muted)">
                        Belum ada barber tersedia.
                    </p>
                @endforelse


            </div>
        </div>
    </section>

    <section id="gallery" class="py-24" style="background: var(--charcoal)">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <span class="section-tag">Portofolio Kami</span>
                    <div class="gold-line gold-line-left"></div>
                    <h2 class=" font-bold text-4xl" style="color: var(--text)">Hasil Karya</h2>
                    <p class=" text-sm leading-relaxed" style="color: var(--muted)">Setiap potongan adalah
                        karya seni. Lihat transformasi nyata dari pelanggan kami.</p>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3  gap-2">
                @forelse ($hasilKaryas as $karya)
                    <div class="gallery-item cursor-pointer rounded-xl">
                        <img src="{{ asset('storage/' . $karya->foto) }}" alt="{{ $karya->judul }}" loading="lazy">
                        <div class="gallery-overlay flex flex-col justify-center items-center gap-1.5 p-2 text-center">
                            <span class="badge" style="margin-bottom:0">{{ $karya->judul }}</span>
                            @if ($karya->barber)
                                <span
                                    class="text-[9px] text-[#C9A84C] font-semibold tracking-wider uppercase bg-black/80 px-2.5 py-0.5 rounded border border-[#C9A84C]/30">
                                    Oleh: {{ $karya->barber->nama }}
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="col-span-3 text-center py-12 text-sm" style="color: var(--muted)">
                        Belum ada foto hasil karya tersedia.
                    </p>
                @endforelse
            </div>
        </div>
    </section>


    <!-- REVIEWS -->
    <section id="reviews" class="py-24" style="background: var(--surface)">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="section-tag">Ulasan Pelanggan</span>
                <div class="gold-line"></div>
                <h2 class=" font-bold text-4xl" style="color: var(--text)">Apa Kata Mereka</h2>
                <p class="mt-4 max-w-md mx-auto" style="color: var(--muted)">Pengalaman nyata dari pelanggan kami.</p>
            </div>

            @if ($reviews->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($reviews as $review)
                        <div
                            class="bg-[#1C1C1C] border border-[#3D3D3D] rounded-2xl p-6 transition-all duration-300 hover:border-[#C9A84C]/50 relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-[#2E2E2E] border border-[#3D3D3D] flex items-center justify-center text-[#C9A84C] font-bold text-lg">
                                        {{ substr($review->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-white">{{ $review->user->name }}</h4>
                                        <p class="text-[10px] text-gray-400">Untuk barber: {{ $review->barber->nama }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center text-yellow-500">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="text-xs font-bold ml-1">{{ $review->rating }}</span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-400 italic">"{{ $review->komentar }}"</p>
                            <div class="mt-4 pt-4 border-t border-[#3D3D3D]/50 text-right">
                                <span
                                    class="text-[10px] text-gray-500">{{ \Carbon\Carbon::parse($review->updated_at)->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-sm" style="color: var(--muted)">Belum ada ulasan saat ini.</p>
            @endif
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="py-24" style="background: var(--dark)">
        <div class="max-w-3xl mx-auto px-6">
            <div class="text-center mb-12">
                <span class="section-tag">Ada yang ditanyakan?</span>
                <div class="gold-line"></div>
                <h2 class=" font-bold text-4xl" style="color: var(--text)">Pertanyaan Umum</h2>
                <p class="mt-3 text-sm" style="color: var(--muted)">Semua yang perlu kamu tahu sebelum booking.</p>
            </div>

            <div class="flex flex-col gap-4" id="faq-list">

                <!-- FAQ Item 5 -->
                <div
                    class="bg-[#2E2E2E]/40 border border-[#3D3D3D] rounded-2xl overflow-hidden transition-all duration-300 hover:border-[#C9A84C]/25">
                    <button
                        class="w-full text-left px-6 py-5 flex justify-between items-center text-white focus:outline-none"
                        onclick="toggleFaq(5)">
                        <span class="font-semibold text-sm">Bagaimana jika pemotongan dibatalkan saat sudah melakukan
                            pembayaran?</span>
                        <svg id="faq-icon-5"
                            class="w-4 h-4 text-[#C9A84C] transform transition-transform duration-300" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </button>
                    <div id="faq-ans-5" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                        <div class="px-6 pb-5 text-xs text-gray-400 leading-relaxed border-t border-[#3D3D3D]/30 pt-3">
                            Jika pemotongan dibatalkan, maka dana akan dikembalikan 50%, kecuali jika Anda mengundur
                            jadwal pemotongan.
                        </div>
                    </div>
                </div>
                <!-- FAQ Item 1 -->
                <div
                    class="bg-[#2E2E2E]/40 border border-[#3D3D3D] rounded-2xl overflow-hidden transition-all duration-300 hover:border-[#C9A84C]/25">
                    <button
                        class="w-full text-left px-6 py-5 flex justify-between items-center text-white focus:outline-none"
                        onclick="toggleFaq(1)">
                        <span class="font-semibold text-sm">Apakah saya harus melakukan booking terlebih dahulu?</span>
                        <svg id="faq-icon-1"
                            class="w-4 h-4 text-[#C9A84C] transform transition-transform duration-300" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </button>
                    <div id="faq-ans-1" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                        <div class="px-6 pb-5 text-xs text-gray-400 leading-relaxed border-t border-[#3D3D3D]/30 pt-3">
                            Booking sangat disarankan untuk menjamin ketersediaan kursi dan menghindari antrean panjang.
                            Namun, kami tetap melayani pelanggan walk-in sesuai ketersediaan slot kosong.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div
                    class="bg-[#2E2E2E]/40 border border-[#3D3D3D] rounded-2xl overflow-hidden transition-all duration-300 hover:border-[#C9A84C]/25">
                    <button
                        class="w-full text-left px-6 py-5 flex justify-between items-center text-white focus:outline-none"
                        onclick="toggleFaq(2)">
                        <span class="font-semibold text-sm">Berapa lama estimasi waktu potong rambut?</span>
                        <svg id="faq-icon-2"
                            class="w-4 h-4 text-[#C9A84C] transform transition-transform duration-300" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </button>
                    <div id="faq-ans-2" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                        <div class="px-6 pb-5 text-xs text-gray-400 leading-relaxed border-t border-[#3D3D3D]/30 pt-3">
                            Untuk layanan potongan rambut pria standar, proses pengerjaan berkisar antara 30 hingga 45
                            menit, yang dikerjakan secara presisi dan detail oleh barber profesional kami.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div
                    class="bg-[#2E2E2E]/40 border border-[#3D3D3D] rounded-2xl overflow-hidden transition-all duration-300 hover:border-[#C9A84C]/25">
                    <button
                        class="w-full text-left px-6 py-5 flex justify-between items-center text-white focus:outline-none"
                        onclick="toggleFaq(3)">
                        <span class="font-semibold text-sm">Apakah bisa memilih barber tertentu saat melakukan
                            reservasi?</span>
                        <svg id="faq-icon-3"
                            class="w-4 h-4 text-[#C9A84C] transform transition-transform duration-300" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </button>
                    <div id="faq-ans-3" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                        <div class="px-6 pb-5 text-xs text-gray-400 leading-relaxed border-t border-[#3D3D3D]/30 pt-3">
                            Tentu saja! Saat melakukan booking online melalui halaman pemesanan kami, Anda dapat bebas
                            memilih barber favorit Anda yang tersedia pada jadwal tersebut.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div
                    class="bg-[#2E2E2E]/40 border border-[#3D3D3D] rounded-2xl overflow-hidden transition-all duration-300 hover:border-[#C9A84C]/25">
                    <button
                        class="w-full text-left px-6 py-5 flex justify-between items-center text-white focus:outline-none"
                        onclick="toggleFaq(4)">
                        <span class="font-semibold text-sm">Bagaimana jika saya ingin menjadwal ulang atau membatalkan
                            booking?</span>
                        <svg id="faq-icon-4"
                            class="w-4 h-4 text-[#C9A84C] transform transition-transform duration-300" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </button>
                    <div id="faq-ans-4" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                        <div class="px-6 pb-5 text-xs text-gray-400 leading-relaxed border-t border-[#3D3D3D]/30 pt-3">
                            Anda dapat melakukan pembatalan atau penjadwalan ulang melalui menu Profil Anda
                            selambat-lambatnya 1 jam sebelum jadwal yang telah ditentukan.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact" class="py-24 relative overflow-hidden"
        style="background: var(--charcoal); border-top: 1px solid var(--border);">
        <!-- Subtle Glow Background -->
        <div
            class="absolute top-1/4 left-1/4 w-[400px] h-[400px] rounded-full bg-[#C9A84C]/5 blur-[120px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-1/4 right-1/4 w-[400px] h-[400px] rounded-full bg-[#C9A84C]/3 blur-[120px] pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <span class="section-tag">Hubungi Kami</span>
                <div class="gold-line"></div>
                <h2 class=" font-bold text-4xl" style="color: var(--text)">Kunjungi Studio Kami</h2>
                <p class="mt-4 max-w-md mx-auto text-sm" style="color: var(--muted)">
                    Grooming premium menanti Anda. Hubungi kami untuk reservasi khusus atau langsung kunjungi lokasi
                    kami.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <!-- Info Column (Lg: 5/12) -->
                <div class="lg:col-span-5 flex flex-col gap-6">
                    <!-- Opening Hours Card -->
                    <div
                        class="bg-[#2E2E2E]/40 border border-[#3D3D3D] rounded-2xl p-6 hover:border-[#C9A84C]/30 transition-all duration-300">
                        <div class="flex items-center gap-4 mb-4">
                            <div
                                class="w-10 h-10 rounded-xl bg-[#C9A84C]/10 border border-[#C9A84C]/20 flex items-center justify-center text-[#C9A84C]">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.5">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg>
                            </div>
                            <div>
                                <h3 class=" font-bold text-lg text-white">Jam Operasional</h3>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span id="store-status-badge"
                                        class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                                    <span id="store-status-text" class="text-xs font-semibold text-green-400">Buka
                                        Sekarang</span>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm text-[#8A8A8A]">
                            <div class="flex justify-between border-b border-[#3D3D3D]/50 pb-2">
                                <span>Senin - Jumat</span>
                                <span class="text-white font-medium">09:00 - 21:00 WIB</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Sabtu - Minggu</span>
                                <span class="text-white font-medium">09:00 - 22:00 WIB</span>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Details Card -->
                    <div
                        class="bg-[#2E2E2E]/40 border border-[#3D3D3D] rounded-2xl p-6 hover:border-[#C9A84C]/30 transition-all duration-300 space-y-4">
                        <h3 class=" font-bold text-lg text-white mb-2">Informasi Kontak</h3>

                        <div class="flex items-start gap-4">
                            <div
                                class="w-8 h-8 rounded-lg bg-[#C9A84C]/10 border border-[#C9A84C]/20 flex items-center justify-center text-[#C9A84C] flex-shrink-0 mt-0.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Telepon & WhatsApp</p>
                                <p class="text-sm text-white font-medium mt-0.5">+62 123-4567-8910</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div
                                class="w-8 h-8 rounded-lg bg-[#C9A84C]/10 border border-[#C9A84C]/20 flex items-center justify-center text-[#C9A84C] flex-shrink-0 mt-0.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                    <polyline points="22,6 12,13 2,6" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Email Studio</p>
                                <p class="text-sm text-white font-medium mt-0.5">info@menshairstudio.com</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div
                                class="w-8 h-8 rounded-lg bg-[#C9A84C]/10 border border-[#C9A84C]/20 flex items-center justify-center text-[#C9A84C] flex-shrink-0 mt-0.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Lokasi Kami</p>
                                <p class="text-sm text-white font-medium mt-0.5">Jl. Ahmad Yani No. 25, Bengkalis, Riau
                                    28712</p>
                            </div>
                        </div>

                        <div class="pt-2">
                            <a href="https://wa.me/621234567890?text=Halo%Menshair%20Studio,%20saya%20ingin%20tanya-tanya%20layanan."
                                target="_blank"
                                class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-sm transition duration-300">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.003 5.324 5.328 0 11.859 0c3.161.001 6.136 1.233 8.375 3.474 2.238 2.24 3.467 5.218 3.465 8.385-.005 6.537-5.33 11.861-11.86 11.861-2.007-.001-3.98-.512-5.736-1.488L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.725 1.451 5.402.002 9.799-4.394 9.802-9.797.002-2.618-1.01-5.08-2.858-6.93C16.47 2.029 14.011 1.017 11.86 1.017c-5.405 0-9.803 4.396-9.806 9.799-.001 1.637.458 3.235 1.328 4.678L2.37 19.92l4.277-1.122-.001.002zM18.113 15.01c-.328-.164-1.942-.958-2.242-1.068-.3-.11-.52-.164-.738.164-.219.328-.848 1.068-1.039 1.287-.19.219-.383.246-.711.082-.328-.164-1.386-.51-2.64-1.627-.975-.87-1.633-1.946-1.825-2.274-.19-.328-.02-.505.143-.668.148-.146.328-.383.493-.575.164-.192.219-.328.328-.547.11-.219.055-.411-.027-.575-.082-.164-.738-1.78-1.01-2.438-.266-.64-.537-.552-.738-.562-.19-.01-.41-.01-.628-.01-.218 0-.574.082-.875.411-.3.328-1.148 1.123-1.148 2.738 0 1.616 1.176 3.178 1.34 3.397.164.22 2.313 3.532 5.602 4.95.782.337 1.393.539 1.87.69.786.25 1.5.215 2.065.13.629-.094 1.942-.794 2.216-1.56.274-.767.274-1.424.192-1.56-.083-.137-.3-.219-.628-.383z" />
                                </svg>
                                Chat via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <div
                        class="bg-[#2E2E2E]/40 border border-[#3D3D3D] rounded-3xl p-8 hover:border-[#C9A84C]/30 transition-all duration-300 relative">
                        <h3 class=" font-bold text-2xl text-white mb-2">Kirim Pesan</h3>
                        <p class="text-sm text-gray-400 mb-8">Punya pertanyaan, feedback, atau penawaran khusus?
                            Silakan isi form di bawah ini.</p>

                        <form id="contact-form" onsubmit="handleContactSubmit(event)" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="relative">
                                    <input type="text" id="contact-name" required placeholder=" "
                                        class="peer w-full bg-[#1C1C1C] border border-[#3D3D3D] rounded-xl px-4 py-3.5 text-sm text-white placeholder-transparent focus:outline-none focus:border-[#C9A84C] transition duration-200" />
                                    <label for="contact-name"
                                        class="absolute left-4 top-3.5 text-sm text-gray-400 pointer-events-none transition-all duration-200 
                                               peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400
                                               peer-focus:top-[-10px] peer-focus:text-xs peer-focus:text-[#C9A84C] peer-focus:bg-[#252525] peer-focus:px-2
                                               peer-[:not(:placeholder-shown)]:top-[-10px] peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:text-[#C9A84C] peer-[:not(:placeholder-shown)]:bg-[#252525] peer-[:not(:placeholder-shown)]:px-2">
                                        Nama Lengkap
                                    </label>
                                </div>
                                <div class="relative">
                                    <input type="email" id="contact-email" required placeholder=" "
                                        class="peer w-full bg-[#1C1C1C] border border-[#3D3D3D] rounded-xl px-4 py-3.5 text-sm text-white placeholder-transparent focus:outline-none focus:border-[#C9A84C] transition duration-200" />
                                    <label for="contact-email"
                                        class="absolute left-4 top-3.5 text-sm text-gray-400 pointer-events-none transition-all duration-200 
                                               peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400
                                               peer-focus:top-[-10px] peer-focus:text-xs peer-focus:text-[#C9A84C] peer-focus:bg-[#252525] peer-focus:px-2
                                               peer-[:not(:placeholder-shown)]:top-[-10px] peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:text-[#C9A84C] peer-[:not(:placeholder-shown)]:bg-[#252525] peer-[:not(:placeholder-shown)]:px-2">
                                        Alamat Email
                                    </label>
                                </div>
                            </div>

                            <div class="relative">
                                <input type="text" id="contact-subject" required placeholder=" "
                                    class="peer w-full bg-[#1C1C1C] border border-[#3D3D3D] rounded-xl px-4 py-3.5 text-sm text-white placeholder-transparent focus:outline-none focus:border-[#C9A84C] transition duration-200" />
                                <label for="contact-subject"
                                    class="absolute left-4 top-3.5 text-sm text-gray-400 pointer-events-none transition-all duration-200 
                                           peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400
                                           peer-focus:top-[-10px] peer-focus:text-xs peer-focus:text-[#C9A84C] peer-focus:bg-[#252525] peer-focus:px-2
                                           peer-[:not(:placeholder-shown)]:top-[-10px] peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:text-[#C9A84C] peer-[:not(:placeholder-shown)]:bg-[#252525] peer-[:not(:placeholder-shown)]:px-2">
                                    Subjek
                                </label>
                            </div>

                            <div class="relative">
                                <textarea id="contact-message" required rows="4" placeholder=" "
                                    class="peer w-full bg-[#1C1C1C] border border-[#3D3D3D] rounded-xl px-4 py-3.5 text-sm text-white placeholder-transparent focus:outline-none focus:border-[#C9A84C] transition duration-200 resize-none"></textarea>
                                <label for="contact-message"
                                    class="absolute left-4 top-3.5 text-sm text-gray-400 pointer-events-none transition-all duration-200 
                                           peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400
                                           peer-focus:top-[-10px] peer-focus:text-xs peer-focus:text-[#C9A84C] peer-focus:bg-[#252525] peer-focus:px-2
                                           peer-[:not(:placeholder-shown)]:top-[-10px] peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:text-[#C9A84C] peer-[:not(:placeholder-shown)]:bg-[#252525] peer-[:not(:placeholder-shown)]:px-2">
                                    Tulis pesan Anda di sini...
                                </label>
                            </div>

                            <button type="submit"
                                class="w-full btn-gold rounded-xl py-4 font-bold flex items-center justify-center gap-2">
                                <span>Kirim Pesan Sekarang</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <line x1="22" y1="2" x2="11" y2="13" />
                                    <polygon points="22 2 15 22 11 13 2 9 22 2" />
                                </svg>
                            </button>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Google Map  -->
            <div class="mt-12 rounded-3xl overflow-hidden border border-[#3D3D3D] shadow-2xl h-[350px] relative group">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.4892273086853!2d102.10804897197241!3d1.478940894657981!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d15f005668264f%3A0xedaf0e3054bda58e!2sMen&#39;s%20hair%20studio!5e0!3m2!1sen!2sid!4v1781233283710!5m2!1sen!2sid"
                    class="w-full h-full border-0 grayscale opacity-80 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <div class="absolute inset-0 pointer-events-none border border-inset border-white/5 rounded-3xl"></div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-[#1C1C1C] border-t border-[#3D3D3D] pt-20 pb-8 text-sm">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 mb-16">
            <!-- Brand Column -->
            <div class="lg:col-span-4 space-y-6">
                <a href="#" class="flex items-center gap-3">
                    <img src="{{ asset('icons/mens.png') }}" alt="Logo" class="h-10 w-auto">
                    <div>
                        <div class=" text-sm font-bold tracking-[0.25em] text-[#C9A84C] leading-none">MEN'S HAIR
                            STUDIO</div>
                        <div class="text-[10px] tracking-[0.35em] text-gray-400 mt-1">BARBERSHOP</div>
                    </div>
                </a>
                <p class="text-gray-400 leading-relaxed max-w-sm">
                    Man's hair studio Barbershop menghadirkan standar baru dalam pelayanan grooming pria premium.
                    Pengalaman
                    mencukur berkelas dengan keahlian presisi tinggi.
                </p>
                <div class="flex items-center gap-3">
                    <a href="#" class="social-btn rounded-xl" title="Instagram">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z" />
                        </svg>
                    </a>
                    <a href="#" class="social-btn rounded-xl" title="Facebook">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M9 8H7v3h2v9h4v-9h3.61L17 8h-4V7.22c0-.538.29-.8.792-.8H17V3h-2.583C11.934 3 10 4.225 10 7.22V8H9z" />
                        </svg>
                    </a>
                    <a href="#" class="social-btn rounded-xl" title="TikTok">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12.525.02c1.31.03 2.612.44 3.731 1.2-.243.83-.564 1.637-.96 2.404-.73-.418-1.554-.643-2.396-.653V13.8a4.912 4.912 0 1 1-2.906-4.502v2.4a2.511 2.511 0 1 0 .506 2.1V0h2.025z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="lg:col-span-2 space-y-6">
                <h4 class=" font-bold text-white tracking-wider text-base">Layanan Kami</h4>
                <ul class="space-y-3">
                    <li><a href="#services">Premium Haircut</a></li>
                    <li><a href="#services">Beard Grooming</a></li>
                    <li><a href="#services">Hair Coloring</a></li>
                    <li><a href="#services">Face Massage</a></li>
                    <li><a href="#services">Royal Treatment</a></li>
                </ul>
            </div>

            <!-- Navigation Links -->
            <div class="lg:col-span-2 space-y-6">
                <h4 class=" font-bold text-white tracking-wider text-base">Halaman Utama</h4>
                <ul class="space-y-3">
                    <li><a href="#services">Layanan</a></li>
                    <li><a href="#barbers">Barber Ahli</a></li>
                    <li><a href="#gallery">Galeri</a></li>
                    <li><a href="#contact">Kontak Kami</a></li>
                </ul>
            </div>

            <!-- Map/Newsletter/Operation Info -->
            <div class="lg:col-span-4 space-y-6">
                <h4 class=" font-bold text-white tracking-wider text-base">Alamat & Navigasi</h4>
                <p class="text-gray-400 leading-relaxed">
                    Studio Mans hair studio berlokasi di area strategis Bengkalis. Klik tombol di bawah untuk melihat
                    rute di
                    Google Maps.
                </p>
                <a href="https://maps.google.com/?q=Bengkalis" target="_blank"
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-[#2E2E2E] border border-[#3D3D3D] text-white hover:border-[#C9A84C]/50 hover:text-[#C9A84C] font-semibold text-xs transition duration-300">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21" />
                        <line x1="9" y1="3" x2="9" y2="18" />
                        <line x1="15" y1="6" x2="15" y2="21" />
                    </svg>
                    Buka Petunjuk Arah
                </a>
            </div>
        </div>

        <!-- Bottom Copyright -->
        <div
            class="max-w-7xl mx-auto px-6 pt-8 border-t border-[#3D3D3D]/50 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-gray-500">
            <p>&copy; {{ date('Y') }} Mans hair studio Barbershop. All Rights Reserved.</p>

        </div>
    </footer>

    <script>
        function toggleFaq(id) {
            const ans = document.getElementById(`faq-ans-${id}`);
            const icon = document.getElementById(`faq-icon-${id}`);
            if (!ans || !icon) return;

            if (ans.style.maxHeight && ans.style.maxHeight !== '0px') {
                ans.style.maxHeight = '0px';
                icon.classList.remove('rotate-180');
            } else {
                for (let i = 1; i <= 5; i++) {
                    const otherAns = document.getElementById(`faq-ans-${i}`);
                    const otherIcon = document.getElementById(`faq-icon-${i}`);
                    if (otherAns && otherAns.style.maxHeight !== '0px') {
                        otherAns.style.maxHeight = '0px';
                        if (otherIcon) otherIcon.classList.remove('rotate-180');
                    }
                }
                ans.style.maxHeight = ans.scrollHeight + 'px';
                icon.classList.add('rotate-180');
            }
        }

        function handleContactSubmit(event) {
            event.preventDefault();
            alert('Coming Soon');
        }

        function resetContactForm() {
            const form = document.getElementById('contact-form');
            if (form) form.reset();
            const toast = document.getElementById('contact-toast');
            if (toast) {
                toast.style.opacity = '0';
                toast.style.pointerEvents = 'none';
            }
        }

        function updateStoreStatus() {
            const statusBadge = document.getElementById('store-status-badge');
            const statusText = document.getElementById('store-status-text');
            if (!statusBadge || !statusText) return;

            const now = new Date();
            const hour = now.getHours();
            const day = now.getDay(); // 0 is Sunday, 6 is Saturday

            const closeHour = (day === 0 || day === 6) ? 22 : 21;

            if (hour >= 9 && hour < closeHour) {
                statusBadge.className = 'w-2 h-2 rounded-full bg-green-500 animate-pulse';
                statusText.textContent = 'Buka Sekarang';
                statusText.className = 'text-xs font-semibold text-green-400';
            } else {
                statusBadge.className = 'w-2 h-2 rounded-full bg-red-500';
                statusText.textContent = 'Tutup · Buka besok pukul 09:00';
                statusText.className = 'text-xs font-semibold text-red-400';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateStoreStatus();
            setInterval(updateStoreStatus, 60000);
        });

        function copyPromoCode(code) {
            navigator.clipboard.writeText(code).then(() => {
                alert('Kode promo "' + code + '" berhasil disalin!');
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        }

        function toggleMenu() {
            const m = document.getElementById('mobileMenu');
            m.classList.toggle('hidden');
        }

        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                const id = a.getAttribute('href').substring(1);
                const el = document.getElementById(id);
                if (el) {
                    e.preventDefault();
                    el.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    document.getElementById('mobileMenu')?.classList.add('hidden');
                }
            });
        });

        const nav = document.querySelector('.floating-bar');
        window.addEventListener('scroll', () => {
            nav.style.borderBottomColor = window.scrollY > 50 ?
                'rgba(201,168,76,0.2)' :
                'var(--border)';
        });


        let lastScrollTop = 0;
        const navbar = document.getElementById("navbar");

        window.addEventListener("scroll", function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop) {
                navbar.classList.add("-translate-y-[150%]");
            } else {
                navbar.classList.remove("-translate-y-[150%]");
            }

            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        });
    </script>
</body>

</html>
