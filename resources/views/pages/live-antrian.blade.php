<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Antrean — Men's Hair Studio</title>
    <link rel="icon" type="image/png" href="{{ asset('icons/mens.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --gold: #C9A84C;
            --gold-light: #E2C97E;
            --charcoal: #1E1E1E;
            --dark: #121212;
            --surface: #262626;
            --border: #3D3D3D;
            --muted: #8A8A8A;
            --text: #F0EDE8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--dark);
            color: var(--text);
            min-height: 100vh;
        }

        .pulse-live {
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
            animation: pulseRed 1.8s infinite;
        }

        @keyframes pulseRed {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 6px rgba(239, 68, 68, 0);
            }

            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
            }
        }




        .gold-glow {
            box-shadow: 0 0 15px rgba(201, 168, 76, 0.15);
        }

        .transition-all-custom {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>

<body class="bg-[#121212] overflow-x-hidden">


    <!-- NAVIGATION HEADER -->
    <header class="max-w-7xl mx-auto px-4 md:px-8 py-6 flex items-center justify-between border-b border-[#2C2C2C]">
        <div class="flex items-center gap-3">
            <img src="{{ asset('icons/mens.png') }}" alt="Logo" class="h-10 w-auto">
            <div>
                <div class=" text-sm font-bold tracking-[0.25em] text-[#C9A84C] leading-none">MEN'S HAIR
                    STUDIO</div>
                <div class="text-[9px] tracking-[0.35em] text-gray-400 mt-1 uppercase">Barbershop Live</div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <span
                class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-red-500/10 border border-red-500/20 text-red-500 text-xs font-semibold tracking-wider uppercase">
                <span class="w-2.5 h-2.5 rounded-full bg-red-500 pulse-live"></span>
                Live Monitor
            </span>
            <a href="javascript:void(0)" onclick="window.history.back();"
                class="text-sm font-medium text-gray-400 hover:text-[#C9A84C] transition duration-300 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 md:px-8 py-10">




        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <!--  Antrian Sekarang -->
            <div class="lg:col-span-2">
                <div class="flex items-center gap-3 mb-6">
                    <h2 class="text-xl md:text-2xl  font-bold text-white tracking-wide">Antrian Sekarang</h2>
                    <div class="flex-1 h-px bg-[#2D2D2D]"></div>
                    <span
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/25 text-emerald-500 text-[10px] font-bold tracking-wider uppercase">

                        Aktif
                    </span>
                </div>

                <div id="active-queues-container">
                    @php
                        $activeItems = collect($barberStatusList)->where('is_busy', true);
                    @endphp

                    @if ($activeItems->isNotEmpty())
                        <div class="grid grid-cols-1 {{ $activeItems->count() > 1 ? 'md:grid-cols-2' : '' }} gap-6">
                            @foreach ($activeItems as $item)
                                <div
                                    class="bg-[#1E1E1E] border-2 border-[#C9A84C] rounded-3xl p-8 flex flex-col justify-between relative overflow-hidden gold-glow min-h-[380px]">
                                    <!-- Decorative watermark -->
                                    <div
                                        class="absolute -right-10 -bottom-10 text-[180px] font-black text-[#C9A84C]/5 select-none pointer-events-none  leading-none">
                                        {{ $item['current_queue']['nomor_antrian'] }}
                                    </div>

                                    <div class="flex justify-between items-start z-10">
                                        <div>
                                            <span
                                                class="inline-block px-3.5 py-1 rounded-full bg-[#C9A84C]/10 border border-[#C9A84C]/30 text-[#C9A84C] text-[10px] font-bold tracking-wider uppercase mb-3">
                                                Sedang Dipotong
                                            </span>
                                            <h3 class="text-2xl font-bold text-white  leading-tight">
                                                {{ $item['current_queue']['nama_customer'] }}</h3>
                                            <p class="text-xs text-gray-400 mt-1">
                                                {{ $item['current_queue']['layanan'] }} ·
                                                {{ $item['current_queue']['durasi'] }} Menit</p>
                                        </div>

                                        <div class="text-right">
                                            <p class="text-[10px] text-[#7aaef5] font-mono">Mulai</p>
                                            <p class="text-xs text-white font-semibold font-mono mt-0.5">
                                                {{ $item['current_queue']['estimasi_jam'] }} WIB</p>
                                        </div>
                                    </div>

                                    <!-- Giant Number in Center -->
                                    <div class="text-center my-6 z-10">
                                        <span
                                            class=" font-black text-[#C9A84C] tracking-tight leading-none text-[8rem] md:text-[11rem]">
                                            {{ $item['current_queue']['nomor_antrian'] }}
                                        </span>
                                    </div>

                                    <div
                                        class="flex items-center gap-3 pt-4 border-t border-[#2D2D2D] z-10 bg-[#1E1E1E]">
                                        <div
                                            class="w-10 h-10 rounded-full overflow-hidden bg-zinc-800 border border-[#3D3D3D] flex-shrink-0">
                                            <img src="{{ $item['foto'] }}" alt="{{ $item['nama'] }}"
                                                class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="text-[9px] text-gray-500 font-bold uppercase tracking-wider">
                                                Barber</p>
                                            <p class="text-xs text-white font-semibold">{{ $item['nama'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty Active State -->
                        <div
                            class="bg-[#1E1E1E] border border-[#2D2D2D] rounded-3xl p-12 text-center gold-glow flex flex-col items-center justify-center min-h-[380px]">
                            <div
                                class="w-20 h-20 rounded-2xl bg-zinc-800 flex items-center justify-center mb-4 border border-[#3C3C3C]">
                                <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor"
                                    stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z">
                                    </path>
                                </svg>
                            </div>
                            <p class=" text-xl font-semibold text-white">Tidak ada antrean sedang dipotong</p>
                            <p class="text-xs text-gray-500 mt-1.5 max-w-xs leading-relaxed">Semua kursi kosong atau
                                menunggu antrean dipanggil oleh admin.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!--  Antrian Berikutnya -->
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <h2 class="text-xl md:text-2xl  font-bold text-white tracking-wide">Antrian Berikutnya
                    </h2>
                    <div class="flex-1 h-px bg-[#2D2D2D]"></div>
                    <span id="upcoming-count-badge"
                        class="px-2.5 py-0.5 rounded-full bg-[#1E1E1E] border border-[#2D2D2D] text-[10px] text-gray-400 font-mono">
                        {{ count($upcomingQueuesList) }} Antrean
                    </span>
                </div>

                <div id="upcoming-queues-container" class="space-y-3 max-h-[600px] overflow-y-auto pr-1">
                    @forelse ($upcomingQueuesList as $queue)
                        <div
                            class="bg-[#1E1E1E] hover:bg-[#232323] border border-[#2D2D2D] hover:border-[#C9A84C]/30 rounded-2xl p-4 flex items-center justify-between gap-4 transition duration-200 gold-glow">
                            <div class="flex items-center gap-3.5 min-w-0">
                                <div
                                    class="w-14 h-14 rounded-xl bg-zinc-800 border border-[#3D3D3D] flex items-center justify-center flex-shrink-0">
                                    <span
                                        class=" font-black text-xl text-[#C9A84C]">{{ $queue['nomor_antrian'] }}</span>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-sm font-bold text-white truncate">{{ $queue['nama_customer'] }}
                                    </h4>
                                    <p class="text-[10px] text-gray-400 truncate mt-0.5">{{ $queue['layanan_nama'] }}
                                        · {{ $queue['barber_nama'] }}</p>
                                </div>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <span
                                    class="inline-block px-2 py-0.5 rounded bg-amber-500/10 border border-amber-500/20 text-amber-500 text-[9px] font-bold tracking-wider uppercase mb-1">
                                    Menunggu
                                </span>
                                <p class="text-[10px] font-mono text-gray-400">{{ $queue['estimasi_jam'] }} WIB</p>
                            </div>
                        </div>
                    @empty
                        <div
                            class="bg-[#1E1E1E]/50 border border-dashed border-[#2D2D2D] rounded-2xl p-8 text-center text-gray-500 py-12">
                            <svg class="mx-auto w-10 h-10 text-gray-600 mb-2.5" fill="none" stroke="currentColor"
                                stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-xs">Tidak ada antrean mendatang hari ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-6 mb-12 my-10">
            <div class="bg-[#1E1E1E] border border-[#2D2D2D] rounded-2xl p-4 md:p-6 text-center gold-glow">
                <span
                    class="text-[10px] md:text-xs font-bold tracking-widest text-gray-400 uppercase block mb-1">Menunggu</span>
                <span id="stat-waiting"
                    class="text-3xl md:text-5xl font-bold  text-[#C9A84C]">{{ $totalWaiting }}</span>
                <span class="text-[10px] md:text-xs text-gray-500 block mt-1">Orang di Antrean</span>
            </div>
            <div class="bg-[#1E1E1E] border border-[#2D2D2D] rounded-2xl p-4 md:p-6 text-center gold-glow">
                <span class="text-[10px] md:text-xs font-bold tracking-widest text-gray-400 uppercase block mb-1">Sedang
                    Dipangkas</span>
                <span id="stat-active"
                    class="text-3xl md:text-5xl font-bold  text-[#7aaef5]">{{ $totalActive }}</span>
                <span class="text-[10px] md:text-xs text-gray-500 block mt-1">Kursi Terisi</span>
            </div>
            <div class="bg-[#1E1E1E] border border-[#2D2D2D] rounded-2xl p-4 md:p-6 text-center gold-glow">
                <span
                    class="text-[10px] md:text-xs font-bold tracking-widest text-gray-400 uppercase block mb-1">Selesai
                    Hari Ini</span>
                <span id="stat-done"
                    class="text-3xl md:text-5xl font-bold  text-emerald-500">{{ $totalSelesai }}</span>
                <span class="text-[10px] md:text-xs text-gray-500 block mt-1">Pelanggan Selesai</span>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <x-footer />

    <script>
        const POLLING_INTERVAL = 8000;
        const currentUrl = window.location.href;

        function fetchQueueUpdates() {
            fetch(currentUrl, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        updateStats(data.stats);
                        updateActiveQueues(data.barbers);
                        updateUpcomingQueues(data.upcoming);
                    }
                })
                .catch(error => {
                    console.error('Error fetching queue updates:', error);
                });
        }

        function updateStats(stats) {
            document.getElementById('stat-waiting').textContent = stats.waiting;
            document.getElementById('stat-active').textContent = stats.active;
            document.getElementById('stat-done').textContent = stats.done;
        }

        function updateActiveQueues(barbers) {
            const container = document.getElementById('active-queues-container');
            const activeBarbers = barbers.filter(b => b.is_busy && b.current_queue);

            if (activeBarbers.length === 0) {
                container.innerHTML = `
                    <div class="bg-[#1E1E1E] border border-[#2D2D2D] rounded-3xl p-12 text-center gold-glow flex flex-col items-center justify-center min-h-[380px]">
                        <div class="w-20 h-20 rounded-2xl bg-zinc-800 flex items-center justify-center mb-4 border border-[#3C3C3C]">
                            <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"></path>
                            </svg>
                        </div>
                        <p class=" text-xl font-semibold text-white">Tidak ada antrean sedang dipotong</p>
                        <p class="text-xs text-gray-500 mt-1.5 max-w-xs leading-relaxed">Semua kursi kosong atau menunggu antrean dipanggil oleh admin.</p>
                    </div>
                `;
                return;
            }

            const isMulti = activeBarbers.length > 1;
            let html = `<div class="grid grid-cols-1 ${isMulti ? 'md:grid-cols-2' : ''} gap-6">`;

            activeBarbers.forEach(item => {
                html += `
                    <div class="bg-[#1E1E1E] border-2 border-[#C9A84C] rounded-3xl p-8 flex flex-col justify-between relative overflow-hidden gold-glow min-h-[380px]">
                        <div class="absolute -right-10 -bottom-10 text-[180px] font-black text-[#C9A84C]/5 select-none pointer-events-none  leading-none">
                            ${item.current_queue.nomor_antrian}
                        </div>
                        
                        <div class="flex justify-between items-start z-10">
                            <div>
                                <span class="inline-block px-3.5 py-1 rounded-full bg-[#C9A84C]/10 border border-[#C9A84C]/30 text-[#C9A84C] text-[10px] font-bold tracking-wider uppercase mb-3">
                                     Sedang Dipotong
                                </span>
                                <h3 class="text-2xl font-bold text-white  leading-tight">${item.current_queue.nama_customer}</h3>
                                <p class="text-xs text-gray-400 mt-1">${item.current_queue.layanan} · ${item.current_queue.durasi} Menit</p>
                            </div>
                            
                            <div class="text-right">
                                <p class="text-[10px] text-[#7aaef5] font-mono">Mulai</p>
                                <p class="text-xs text-white font-semibold font-mono mt-0.5">${item.current_queue.estimasi_jam} WIB</p>
                            </div>
                        </div>

                        <div class="text-center my-6 z-10">
                            <span class=" font-black text-[#C9A84C] tracking-tight leading-none text-[8rem] md:text-[11rem]">
                                ${item.current_queue.nomor_antrian}
                            </span>
                        </div>

                        <div class="flex items-center gap-3 pt-4 border-t border-[#2D2D2D] z-10 bg-[#1E1E1E]">
                            <div class="w-10 h-10 rounded-full overflow-hidden bg-zinc-800 border border-[#3D3D3D] flex-shrink-0">
                                <img src="${item.foto}" alt="${item.nama}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="text-[9px] text-gray-500 font-bold uppercase tracking-wider">Barber</p>
                                <p class="text-xs text-white font-semibold">${item.nama}</p>
                            </div>
                        </div>
                    </div>
                `;
            });

            html += `</div>`;
            container.innerHTML = html;
        }

        function updateUpcomingQueues(upcoming) {
            const container = document.getElementById('upcoming-queues-container');
            const countBadge = document.getElementById('upcoming-count-badge');
            countBadge.textContent = `${upcoming.length} Antrean`;

            if (upcoming.length === 0) {
                container.innerHTML = `
                    <div class="bg-[#1E1E1E]/50 border border-dashed border-[#2D2D2D] rounded-2xl p-8 text-center text-gray-500 py-12">
                        <svg class="mx-auto w-10 h-10 text-gray-600 mb-2.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-xs">Tidak ada antrean mendatang hari ini.</p>
                    </div>
                `;
                return;
            }

            let html = '';
            upcoming.forEach(queue => {
                html += `
                    <div class="bg-[#1E1E1E] hover:bg-[#232323] border border-[#2D2D2D] hover:border-[#C9A84C]/30 rounded-2xl p-4 flex items-center justify-between gap-4 transition duration-200 gold-glow">
                        <div class="flex items-center gap-3.5 min-w-0">
                            <div class="w-14 h-14 rounded-xl bg-zinc-800 border border-[#3D3D3D] flex items-center justify-center flex-shrink-0">
                                <span class=" font-black text-xl text-[#C9A84C]">${queue.nomor_antrian}</span>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-sm font-bold text-white truncate">${queue.nama_customer}</h4>
                                <p class="text-[10px] text-gray-400 truncate mt-0.5">${queue.layanan_nama} · ${queue.barber_nama}</p>
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <span class="inline-block px-2 py-0.5 rounded bg-amber-500/10 border border-amber-500/20 text-amber-500 text-[9px] font-bold tracking-wider uppercase mb-1">
                                Menunggu
                            </span>
                            <p class="text-[10px] font-mono text-gray-400">${queue.estimasi_jam} WIB</p>
                        </div>
                    </div>
                `;
            });
            container.innerHTML = html;
        }

        setInterval(fetchQueueUpdates, POLLING_INTERVAL);
    </script>
</body>

</html>
