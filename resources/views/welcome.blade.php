<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mens Studio — Premium Barbershop Bengkalis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --gold: #C9A84C;
            --gold-light: #E2C97E;
            --dark: #1C1C1C;
            --muted: #8A8A8A;
            --text: #F0EDE8;
            --border: #3D3D3D;
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
            font-family: ui-sans-serif, system-ui, sans-serif;
        }

        .hero-bg {
            background-color: var(--dark);
            position: relative;
            overflow: hidden;
            min-height: 100vh;
        }

        .hero-right-img {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 50%;
            z-index: 5;
        }

        .hero-right-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.45;
        }

        .hero-right-fade {
            position: absolute;
            inset: 0;
            background: var(--dark);
            -webkit-mask-image: linear-gradient(to right, black 0%, transparent 50%);
            mask-image: linear-gradient(to right, black 0%, transparent 50%);
        }

        .hero-bottom-fade {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: linear-gradient(to bottom, transparent, var(--dark));
            z-index: 6;
        }

        .hero-content {
            position: relative;
            z-index: 10;
        }

        .badge {
            display: inline-block;
            background: rgba(201, 168, 76, 0.1);
            border: 1px solid rgba(201, 168, 76, 0.28);
            color: var(--gold-light);
            font-size: 0.7rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            padding: 0.35rem 1rem;
            margin-bottom: 1.5rem;
        }

        .btn-gold {
            background: var(--gold);
            color: var(--dark);
            padding: 0.9rem 2.5rem;
            font-weight: 700;
            font-size: 0.8rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
            border-radius: 0.75rem;
        }

        .btn-gold:hover {
            background: var(--gold-light);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(201, 168, 76, 0.25);
        }

        .btn-outline {
            background: transparent;
            color: var(--gold);
            padding: 0.9rem 2.5rem;
            font-weight: 700;
            font-size: 0.8rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            border: 1px solid var(--gold);
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
            border-radius: 0.75rem;
        }

        .btn-outline:hover {
            background: var(--gold);
            color: var(--dark);
            transform: translateY(-2px);
        }

        .gold-line {
            width: 48px;
            height: 2px;
            background: var(--gold);
            margin-bottom: 1.5rem;
        }

        .noise {
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            opacity: 0.35;
            pointer-events: none;
            z-index: 4;
        }

        /* Stat items */
        .stat-val {
            font-size: 2.4rem;
            font-weight: 800;
            color: var(--gold);
            line-height: 1;
            letter-spacing: -0.02em;
        }

        .stat-label {
            font-size: 0.7rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--muted);
            margin-top: 0.3rem;
        }

        /* Vertical gold accent line left of stats */
        .stat-item {
            padding-left: 1rem;
            border-left: 2px solid rgba(201, 168, 76, 0.3);
        }

        /* Nav */
        .nav-logo-text {
            font-size: 0.85rem;
            font-weight: 800;
            letter-spacing: 0.25em;
            color: var(--gold);
        }

        .nav-sub {
            font-size: 0.6rem;
            letter-spacing: 0.35em;
            color: var(--muted);
            margin-top: 2px;
        }


        @media (max-width: 768px) {
            .hero-right-img {
                display: none;
            }
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav
        class="fixed top-4 left-1/2 -translate-x-1/2 w-[95%] max-w-7xl z-50 bg-[#1E1E1E]/90 border border-[#3A3A3A] rounded-2xl shadow-lg backdrop-blur-md">
        <div class="px-6 py-4 flex items-center justify-between">
            <!-- Brand -->
            <a href="#" class="flex items-center gap-3">
                <img src="{{ asset('icons/mens.png') }}" alt="" width="50">
                <div>
                    <div class="nav-logo-text">MENS STUDIO</div>
                    <div class="nav-sub">BARBERSHOP</div>
                </div>
            </a>



            <!-- CTA buttons -->
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}"
                    class="hidden md:inline-flex items-center px-5 py-2.5 rounded-xl border border-[#C9A84C]/50 text-[#C9A84C] text-sm font-semibold hover:bg-[#C9A84C]/10 transition duration-300">
                    Masuk
                </a>
                <a href="{{ route('live-antrian') }}"
                    class="inline-flex items-center px-5 py-2.5 rounded-xl bg-[#C9A84C] text-black text-sm font-semibold hover:scale-105 hover:bg-[#E2C97E] transition duration-300">
                    Live Antrian
                </a>
            </div>
        </div>
    </nav>

    <!-- ── HERO ── -->
    <section class="hero-bg flex items-center">
        <div class="noise"></div>

        <div class="hero-right-img">
            <img src="https://images.unsplash.com/photo-1621605815971-fbc98d665033?w=900&q=80" alt="Barber at work">
            <div class="hero-right-fade"></div>
        </div>
        <div class="hero-bottom-fade"></div>

        <!-- Gold glow top-left -->
        <div
            class="absolute top-1/3 -left-32 w-[500px] h-[500px] rounded-full bg-[#C9A84C]/5 blur-[120px] pointer-events-none z-4">
        </div>

        <!-- Content -->
        <div class="max-w-7xl mx-auto px-6 py-40 hero-content w-full">
            <div class="max-w-lg">
                <span class="badge rounded-xl">Premium Barbershop · Bengkalis, Riau</span>

                <h1 class="font-extrabold leading-[1.05] mb-6 tracking-tight"
                    style="font-size: clamp(3rem, 6.5vw, 5.5rem); color: var(--text)">
                    Style Is<br>
                    <span style="color: var(--gold)">Your Signature</span>
                </h1>

                <div class="gold-line"></div>

                <p class="mb-10 leading-relaxed text-base" style="color: var(--muted); max-width: 420px">
                    Pengalaman grooming premium dengan tangan‑tangan ahli. Potong rambut bukan hanya tentang rambut —
                    ini tentang siapa kamu.
                </p>

                <!-- Auth CTA -->
                <div class="flex flex-wrap gap-4 mb-16">
                    <a href="{{ route('register') }}" class="btn-gold">
                        Buat Akun Gratis
                    </a>
                    <a href="{{ route('login') }}" class="btn-outline">
                        Sudah Punya Akun
                    </a>
                </div>


            </div>
        </div>


    </section>

    <!-- ── MINIMAL BOTTOM BAR ── -->
    <div class="bg-[#1A1A1A] border-t border-[#2E2E2E] py-5 text-center">
        <p class="text-xs text-[#8A8A8A] tracking-wider">
            &copy; {{ date('Y') }} Mens Studio Barbershop. All Rights Reserved.
            <a href="{{ route('live-antrian') }}" class="ml-4 text-[#C9A84C] hover:underline">Live Antrean →</a>
        </p>
    </div>
</body>

</html>
