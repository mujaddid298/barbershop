<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('icons/mens.png') }}">

    <title>@yield('title', 'Men\'s Hair Studio')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --gold: #C9A84C;
            --gold-light: #E2C97E;
            --charcoal: #1A1A1A;
            --dark: #111111;
            --surface: #222222;
            --border: #333333;
            --muted: #6B6B6B;
            --text: #F0EDE8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--dark);
            color: var(--text);
            min-height: 100vh;
        }

        .font-display {
            font-family: 'Playfair Display', serif;
        }

        .font-serif {
            font-family: 'Playfair Display', serif !important;
        }
    </style>


</head>

<body>

    <div class="flex min-h-screen">

        {{-- Backdrop overlay for mobile sidebar --}}
        <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 z-40 bg-black/60 hidden md:hidden"></div>

        @php
            use Illuminate\Support\Facades\Auth;

            $menus = [
                ['header' => 'Utama'],

                [
                    'title' => 'Dashboard',
                    'route' => 'admin.dashboard',
                    'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="#2E2E2E" stroke-width="1.5" class="w-4 h-4">
                                                                                            <rect x="3" y="3" width="7" height="7" rx="1"/>
                                                                                            <rect x="14" y="3" width="7" height="7" rx="1"/>
                                                                                            <rect x="3" y="14" width="7" height="7" rx="1"/>
                                                                                            <rect x="14" y="14" width="7" height="7" rx="1"/>
                                                                                            </svg>',
                ],

                [
                    'title' => 'Live Antrean',
                    'route' => 'live-antrian',
                    'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="#2E2E2E" stroke-width="1.5" class="w-4 h-4">
                                                                                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                                                                                            <line x1="8" y1="21" x2="16" y2="21"/>
                                                                                            <line x1="12" y1="17" x2="12" y2="21"/>
                                                                                            </svg>',
                ],

                [
                    'title' => 'Pelanggan',
                    'route' => 'admin.datauser',
                    'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="#2E2E2E" stroke-width="1.5" class="w-4 h-4">
                                                                                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                                                                            <circle cx="9" cy="7" r="4"/>
                                                                                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                                                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                                                                            </svg>',
                ],

                ['header' => 'Layanan'],

                // [
                //     'title' => 'Reservasi',
                //     'route' => 'admin.dashboard',
                //     'badge' => $pendingCount ?? 0,   // angka badge, 0 = tidak tampil
                //     'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="#2E2E2E" stroke-width="1.5" class="w-4 h-4">
    //                 <rect x="3" y="4" width="18" height="18" rx="2"/>
    //                 <line x1="16" y1="2" x2="16" y2="6"/>
    //                 <line x1="8" y1="2" x2="8" y2="6"/>
    //                 <line x1="3" y1="10" x2="21" y2="10"/>
    //                 </svg>',
                // ],

                [
                    'title' => 'Layanan & Harga',
                    'route' => 'admin.layanan',
                    'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="#2E2E2E" stroke-width="1.5" class="w-4 h-4">
                                                                                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                                                                                            <line x1="3" y1="6" x2="21" y2="6"/>
                                                                                            <path d="M16 10a4 4 0 0 1-8 0"/>
                                                                                            </svg>',
                ],
                [
                    'title' => 'Barber',
                    'route' => 'admin.barber',
                    'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="#2E2E2E" stroke-width="1.5" class="w-4 h-4">
                                        <circle cx="6" cy="6" r="3"/>
                                        <circle cx="6" cy="18" r="3"/>
                                        <line x1="8.12" y1="8.12" x2="21" y2="21"/>
                                        <line x1="8.12" y1="15.88" x2="21" y2="3"/>
                                    </svg>',
                ],

                [
                    'title' => 'promosi',
                    'route' => 'admin.promo',
                    'icon' =>
                        '<svg viewBox="0 0 24 24" fill="none" stroke="#2E2E2E" stroke-width="1.5" class="w-4 h-4"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>                                         </svg>',
                ],

                [
                    'title' => 'Hasil Karya',
                    'route' => 'admin.hasil-karya.index',
                    'icon' =>
                        '<svg viewBox="0 0 24 24" fill="none" stroke="#2E2E2E" stroke-width="1.5" class="w-4 h-4"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>',
                ],

                [
                    'title' => 'riwayat pemesanan',
                    'route' => 'admin.booking.history',
                    'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="#2E2E2E" stroke-width="1.5" class="w-4 h-4">
                                        <path d="M12 8v4l3 3"/>
                                        <path d="M3.05 11a9 9 0 1 0 .5-4.5"/>
                                        <polyline points="1 7 3 9 5 7"/>
                                    </svg>',
                ],

                [
                    'title' => 'Keuangan',
                    'route' => 'admin.finance.index',
                    'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="#2E2E2E" stroke-width="1.5" class="w-4 h-4">
                                        <line x1="12" y1="1" x2="12" y2="23"/>
                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                                    </svg>',
                ],
            ];
        @endphp
        <x-sidebar :user="Auth::user()" :menus="$menus" />

        <div class="flex-1 flex flex-col min-w-0">

            {{-- Mobile Header --}}
            <header class="md:hidden flex items-center justify-between px-4 py-3 bg-[#111] border-b border-[#2E2E2E]">
                <button type="button" onclick="toggleSidebar()" class="p-2 text-white hover:text-[#C9A84C] focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <span class="font-display text-sm font-bold text-[#C9A84C] tracking-wider uppercase">Mens Studio</span>
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-semibold bg-[#C9A84C] text-[#111]">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </header>

            <main class="flex-grow p-4 md:p-6 min-w-0">
                @yield('content')
            </main>

        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar-container');
            const overlay = document.getElementById('sidebar-overlay');
            if (sidebar) {
                sidebar.classList.toggle('-translate-x-full');
            }
            if (overlay) {
                overlay.classList.toggle('hidden');
            }
        }
    </script>
</body>

</html>
