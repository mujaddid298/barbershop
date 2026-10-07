<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Appointment · Men's Hair Studio</title>
    <link rel="icon" type="image/png" href="{{ asset('icons/mens.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>

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

        body {
            background-color: var(--dark);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .floating-bar {
            background: rgba(28, 28, 28, 0.96);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
        }

        .btn-gold {
            background: var(--gold);
            color: var(--dark);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-gold:hover:not(:disabled) {
            background: var(--gold-light);
            transform: translateY(-2px);
        }

        .btn-gold:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-outline {
            background: transparent;
            color: var(--gold);
            border: 1px solid var(--gold);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            background: var(--gold);
            color: var(--dark);
        }

        /* Glass panel */
        .glass-panel {
            background: rgba(46, 46, 46, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border);
        }

        /* Step cards transitions */
        .step-content {
            display: none;
            animation: fadeIn 0.4s ease-in-out forwards;
        }

        .step-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Selected items */
        .selectable-card {
            border: 1px solid var(--border);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .selectable-card:hover {
            border-color: rgba(201, 168, 76, 0.5);
            transform: translateY(-2px);
        }

        .selectable-card.selected {
            border-color: var(--gold);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--dark);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--gold);
        }

        /* Time slots */
        .time-slot {
            border: 1px solid var(--border);
            color: var(--muted);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .time-slot:hover {
            border-color: var(--gold);
            color: var(--text);
        }

        .time-slot.selected {
            background: var(--gold);
            color: var(--dark) !important;
            border-color: var(--gold);
            font-weight: 600;
        }
    </style>
</head>

<body>
    <x-header-user />

    <main class="flex-grow flex items-center justify-center pt-28 pb-12 md:py-36 px-4 md:px-8">
        <div class="max-w-5xl w-full">
            <div class="mb-12 max-w-4xl mx-auto px-4">
                <div class="relative flex items-center justify-between">

                    <div class="absolute top-5 left-5 right-5 h-[2px] bg-[#3D3D3D] rounded-full">
                    </div>
                    <!-- Active Line -->
                    <div id="progressLine"
                        class="absolute top-5 left-[6%] h-[2px] bg-[#C9A84C] rounded-full transition-all duration-500"
                        style="width: 0%;">
                    </div>

                    <!-- STEP 1 -->
                    <div class="step-indicator relative z-10 flex flex-col items-center text-center group"
                        data-step="1">
                        <div
                            class="w-11 h-11 rounded-full flex items-center justify-center bg-[#C9A84C] text-[#1C1C1C] font-bold shadow-lg transition-all duration-300">
                            1
                        </div>
                        <span
                            class="mt-3 text-[9px] sm:text-xs font-semibold tracking-[0.05em] sm:tracking-[0.2em] uppercase text-[#C9A84C]">
                            Layanan
                        </span>
                    </div>

                    <!-- STEP 2 -->
                    <div class="step-indicator relative z-10 flex flex-col items-center text-center group"
                        data-step="2">
                        <div
                            class="w-11 h-11 rounded-full flex items-center justify-center bg-[#2A2A2A] border border-[#444] text-gray-400 font-bold shadow-md transition-all duration-300">
                            2
                        </div>
                        <span
                            class="mt-3 text-[9px] sm:text-xs font-semibold tracking-[0.05em] sm:tracking-[0.2em] uppercase text-gray-400">
                            Barber
                        </span>
                    </div>

                    <!-- STEP 3 -->
                    <div class="step-indicator relative z-10 flex flex-col items-center text-center group"
                        data-step="3">
                        <div
                            class="w-11 h-11 rounded-full flex items-center justify-center bg-[#2A2A2A] border border-[#444] text-gray-400 font-bold shadow-md transition-all duration-300">
                            3
                        </div>
                        <span
                            class="mt-3 text-[9px] sm:text-xs font-semibold tracking-[0.05em] sm:tracking-[0.2em] uppercase text-gray-400">
                            Jadwal
                        </span>
                    </div>

                    <!-- STEP 4 -->
                    <div class="step-indicator relative z-10 flex flex-col items-center text-center group"
                        data-step="4">
                        <div
                            class="w-11 h-11 rounded-full flex items-center justify-center bg-[#2A2A2A] border border-[#444] text-gray-400 font-bold shadow-md transition-all duration-300">
                            4
                        </div>
                        <span
                            class="mt-3 text-[9px] sm:text-xs font-semibold tracking-[0.05em] sm:tracking-[0.2em] uppercase text-gray-400">
                            Konfirmasi
                        </span>
                    </div>

                </div>
            </div>
            <div class="glass-panel rounded-3xl p-6 md:p-10 shadow-2xl relative overflow-hidden">

                <form id="bookingForm" method="POST" action="{{ route('user.booking.store') }}">
                    @csrf

                    @if ($errors->any())
                        <div
                            class="mb-6 p-4 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-sm">
                            <div class="flex items-start gap-3">
                                <svg class="flex-shrink-0 mt-0.5" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="15" y1="9" x2="9" y2="15" />
                                    <line x1="9" y1="9" x2="15" y2="15" />
                                </svg>
                                <div>
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <input type="hidden" name="layanan_id" id="selectedLayananId">
                    <input type="hidden" name="barber_id" id="selectedBarberId">
                    <input type="hidden" name="jam" id="selectedJam">
                    <input type="hidden" name="promo_code" id="selectedPromoCode">

                    <!-- pilih layanan -->
                    <div id="step1" class="step-content active">
                        <div class="mb-8">
                            <span class="text-xs tracking-[0.2em] text-[#C9A84C] uppercase font-semibold">Langkah 1 dari
                                4</span>
                            <h2 class=" text-3xl font-bold mt-1 text-[#F0EDE8]">Pilih Layanan</h2>
                            <p class="text-sm text-gray-400 mt-2">Pilih salah satu layanan premium kami untuk kebutuhan
                                grooming Anda.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse ($layanans as $layanan)
                                <div class="selectable-card rounded-2xl p-6 flex flex-col justify-between h-full bg-[#1C1C1C]"
                                    onclick="selectLayanan({{ $layanan->id }}, '{{ $layanan->name }}', {{ $layanan->harga }}, {{ $layanan->durasi }})">
                                    <div>
                                        <div class="flex justify-end  items-end mb-4">
                                            <div
                                                class="check-badge hidden w-6 h-6 rounded-full bg-[#C9A84C] flex items-center justify-center">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                                    stroke="#1C1C1C" stroke-width="3" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                            </div>
                                        </div>

                                        <h3 class=" text-lg font-bold text-[#F0EDE8]">{{ $layanan->nama }}
                                        </h3>
                                        <p class="text-xs text-gray-400 mt-2 line-clamp-3 leading-relaxed">
                                            {{ $layanan->deskripsi }}</p>
                                    </div>

                                    <div class="mt-6 pt-4 border-t border-[#2E2E2E] flex items-end justify-between">
                                        <div>
                                            <span
                                                class="text-[10px] uppercase text-gray-400 tracking-wider">Durasi</span>
                                            <div class="text-sm font-semibold mt-0.5 text-[#F0EDE8]">
                                                {{ $layanan->durasi }} Menit</div>
                                        </div>
                                        <div class="text-right">
                                            <span
                                                class="text-[10px] uppercase text-gray-400 tracking-wider">Harga</span>
                                            <div class=" text-lg font-bold text-[#C9A84C]">Rp
                                                {{ number_format($layanan->harga, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-3 text-center py-12">
                                    <p class="text-gray-400">Belum ada layanan tersedia.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- pilih barber -->
                    <div id="step2" class="step-content">
                        <div class="mb-8">
                            <span class="text-xs tracking-[0.2em] text-[#C9A84C] uppercase font-semibold">Langkah 2
                                dari 4</span>
                            <h2 class=" text-3xl font-bold mt-1 text-[#F0EDE8]">Pilih Barber</h2>
                            <p class="text-sm text-gray-400 mt-2">Pilih barber profesional favorit Anda untuk
                                mendapatkan hasil potongan terbaik.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @forelse ($barbers as $barber)
                                <div class="selectable-card rounded-2xl overflow-hidden bg-[#1C1C1C] flex flex-col justify-between"
                                    onclick="selectBarber({{ $barber->id }}, '{{ $barber->nama }}', '{{ $barber->foto ? asset('storage/' . $barber->foto) : '' }}')">

                                    <div class="relative h-60 w-full overflow-hidden bg-[#252525]">
                                        @if ($barber->foto)
                                            <img src="{{ asset('storage/' . $barber->foto) }}"
                                                alt="{{ $barber->nama }}"
                                                class="w-full h-full object-cover object-top filter grayscale-[20%]">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg width="48" height="48" viewBox="0 0 24 24"
                                                    fill="none" stroke="#3D3D3D" stroke-width="1.5">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                                    <circle cx="12" cy="7" r="4" />
                                                </svg>
                                            </div>
                                        @endif

                                        <div
                                            class="absolute top-4 right-4 check-badge hidden w-8 h-8 rounded-full bg-[#C9A84C] flex items-center justify-center shadow-lg">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                stroke="#1C1C1C" stroke-width="3" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                        </div>

                                        <div class="absolute bottom-4 left-4">
                                            <span
                                                class="px-3 py-1 rounded-full text-[10px] font-semibold tracking-wider uppercase bg-[#C9A84C]/10 border border-[#C9A84C]/30 text-[#C9A84C]">
                                                Ready
                                            </span>
                                        </div>
                                    </div>

                                    <div class="p-6">
                                        <h3 class=" text-lg font-bold text-[#F0EDE8]">{{ $barber->nama }}
                                        </h3>
                                        @if($barber->bookings_avg_rating)
                                            <div class="flex items-center gap-1 mt-1">
                                                <svg class="w-3.5 h-3.5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                                <span class="text-xs font-bold text-gray-300">{{ number_format($barber->bookings_avg_rating, 1) }}</span>
                                            </div>
                                        @endif
                                        <p class="text-xs text-gray-400 mt-2 flex items-center gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Tersedia Hari Ini
                                        </p>
                                        <div
                                            class="mt-4 pt-4 border-t border-[#2E2E2E] text-xs text-gray-400 flex items-center gap-2">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="#C9A84C" stroke-width="2">
                                                <path
                                                    d="M12 2L13.5 8H20L14.5 12L16.5 18L12 14L7.5 18L9.5 12L4 8H10.5Z" />
                                            </svg>
                                            Expertise: <span class="text-white font-medium">Classic & Modern
                                                Fade</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-3 text-center py-12">
                                    <p class="text-gray-400">Belum ada barber tersedia.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <!-- tanggal dan waktu -->
                    <div id="step3" class="step-content">
                        <div class="mb-8">
                            <span class="text-xs tracking-[0.2em] text-[#C9A84C] uppercase font-semibold">Langkah 3
                                dari 4</span>
                            <h2 class=" text-3xl font-bold mt-1 text-[#F0EDE8]">Pilih Tanggal</h2>
                            <p class="text-sm text-gray-400 mt-2">Pilih tanggal kedatangan untuk mendapatkan estimasi
                                waktu pangkas kosong tercepat.</p>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <!-- Left: Calendar Selection -->
                            <div
                                class="lg:col-span-1 p-6 rounded-2xl bg-[#1C1C1C] border border-[#3D3D3D] flex flex-col gap-4">
                                <label class="text-xs tracking-widest uppercase text-gray-400 font-semibold">Tentukan
                                    Tanggal</label>
                                <input type="date" name="tanggal" id="tanggalInput" min="{{ date('Y-m-d') }}"
                                    value="{{ date('Y-m-d') }}"
                                    class="bg-transparent border border-[#3D3D3D] rounded-xl px-4 py-3 text-sm text-[#F0EDE8] outline-none w-full focus:border-[#C9A84C] transition duration-300"
                                    onchange="updateSummaryDate(this.value)">
                                <div class="text-xs text-gray-400 leading-relaxed mt-2 flex gap-2 items-start">
                                    <svg class="flex-shrink-0 text-[#C9A84C] mt-0.5" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="12" y1="8" x2="12" y2="12" />
                                        <line x1="12" y1="16" x2="12.01" y2="16" />
                                    </svg>
                                    <span>Pemesanan diperbolehkan mulai hari ini hingga 7 hari kedepan.</span>
                                </div>
                            </div>

                            <div
                                class="lg:col-span-2 p-6 rounded-2xl bg-[#1C1C1C] border border-[#3D3D3D] relative overflow-hidden flex flex-col justify-between">
                                <div class="absolute -top-10 -right-10 w-24 h-24 rounded-full bg-[#C9A84C]/5 blur-xl">
                                </div>

                                <div>
                                    <label
                                        class="text-xs tracking-widest uppercase text-gray-400 font-semibold mb-4 block">Estimasi
                                        Waktu Pangkas</label>

                                    <!-- Loading State -->
                                    <div id="estimationLoading"
                                        class="flex flex-col items-center justify-center py-12 gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-t-[#C9A84C] border-r-transparent border-b-transparent border-l-transparent animate-spin">
                                        </div>
                                        <span class="text-xs text-gray-400">Menghitung antrean...</span>
                                    </div>

                                    <div id="estimationDetails" class="hidden flex flex-col gap-6">
                                        <div
                                            class="flex items-center gap-4 bg-[#252525] p-5 rounded-xl border border-[#3D3D3D]">
                                            <div
                                                class="w-12 h-12 rounded-xl bg-[#C9A84C]/10 flex items-center justify-center border border-[#C9A84C]/30 text-[#C9A84C] flex-shrink-0">
                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="1.5">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <polyline points="12 6 12 12 16 14" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-[10px] text-gray-400 uppercase tracking-wider">Pukul
                                                    (Estimasi)</div>
                                                <div class="text-xl font-bold text-white mt-0.5">
                                                    <span id="estimatedStartTime" class="text-[#C9A84C]">--:--</span>
                                                    <span class="text-xs text-gray-400 font-normal">s/d</span>
                                                    <span id="estimatedEndTime" class="text-[#C9A84C]">--:--</span>
                                                    <span class="text-sm font-semibold">WIB</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-2 gap-4">
                                            <div
                                                class="bg-[#252525]/50 p-4 rounded-xl border border-[#3C3C3C]/50 flex items-center gap-3">
                                                <div class="text-[#C9A84C]">
                                                    <svg width="18" height="18" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                                        <circle cx="9" cy="7" r="4" />
                                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="text-[9px] uppercase tracking-wider text-gray-400">
                                                        Antrean Aktif</div>
                                                    <div class="text-sm font-bold text-white mt-0.5"><span
                                                            id="estimatedQueueCount">0</span> Orang</div>
                                                </div>
                                            </div>

                                            <!-- Duration -->
                                            <div
                                                class="bg-[#252525]/50 p-4 rounded-xl border border-[#3C3C3C]/50 flex items-center gap-3">
                                                <div class="text-[#C9A84C]">
                                                    <svg width="18" height="18" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2">
                                                        <circle cx="12" cy="12" r="10" />
                                                        <polyline points="12 6 12 12 14 14" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="text-[9px] uppercase tracking-wider text-gray-400">
                                                        Durasi Pangkas</div>
                                                    <div class="text-sm font-bold text-white mt-0.5"><span
                                                            id="estimatedDuration">--</span> Menit</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="mt-6 p-4 rounded-xl bg-amber-500/5 border border-amber-500/10 text-amber-200/90 text-xs flex gap-3 items-start leading-relaxed">
                                        <svg class="flex-shrink-0 text-[#C9A84C] mt-0.5" width="14"
                                            height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <circle cx="12" cy="12" r="10" />
                                            <line x1="12" y1="8" x2="12" y2="12" />
                                            <line x1="12" y1="16" x2="12.01" y2="16" />
                                        </svg>
                                        <span>Penentuan jam dihitung otomatis berdasarkan sisa waktu pangkas antrean
                                            aktif di depan Anda. Anda tidak perlu memilih jam secara manual.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- konfirmasi -->
                    <div id="step4" class="step-content">
                        <div class="mb-8">
                            <span class="text-xs tracking-[0.2em] text-[#C9A84C] uppercase font-semibold">Langkah 4
                                dari 4</span>
                            <h2 class=" text-3xl font-bold mt-1 text-[#F0EDE8]">Konfirmasi Pemesanan</h2>
                            <p class="text-sm text-gray-400 mt-2">Mohon periksa kembali detail pemesanan dan isi nomor
                                WhatsApp Anda.</p>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                            <div
                                class="lg:col-span-2 p-6 rounded-2xl bg-[#1C1C1C] border border-[#3D3D3D] flex flex-col gap-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-xs tracking-widest uppercase text-gray-400 font-semibold">Nama
                                            Pemesan</label>
                                        <input type="text" value="{{ Auth::user()->name }}" disabled
                                            class="bg-transparent border border-[#3D3D3D] rounded-xl px-4 py-3 text-sm text-[#8A8A8A] outline-none cursor-not-allowed">
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-xs tracking-widest uppercase text-gray-400 font-semibold">Nomor
                                            WhatsApp (Aktif)</label>
                                        <input type="tel" name="nohp" id="nohpInput"
                                            placeholder="Contoh: 081234567890" value="{{ Auth::user()->nohp }}"
                                            class="bg-transparent border border-[#3D3D3D] rounded-xl px-4 py-3 text-sm text-[#F0EDE8] outline-none focus:border-[#C9A84C] transition duration-300">

                                    </div>
                                </div>

                                <!-- Promo Section -->
                                <div class="border-t border-[#2E2E2E] pt-6 flex flex-col gap-4">
                                    <label
                                        class="text-xs tracking-widest uppercase text-gray-400 font-semibold">Gunakan
                                        Kode Promo</label>
                                    <div class="flex gap-3">
                                        <input type="text" id="promoInput"
                                            placeholder="Masukkan kode promo (misal: HEMAT10)"
                                            class="flex-1 bg-transparent border border-[#3D3D3D] rounded-xl px-4 py-3 text-sm text-[#F0EDE8] uppercase outline-none focus:border-[#C9A84C] transition duration-300">
                                        <button type="button" id="applyPromoBtn" onclick="applyPromoCode()"
                                            class="btn-gold px-4 md:px-6 py-3 rounded-xl text-sm whitespace-nowrap flex items-center justify-center">

                                            <svg class="w-5 h-5 md:hidden" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M20 12V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v5m16 0v5a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-5m16 0H4" />
                                            </svg>

                                            <span class="hidden md:inline">Gunakan</span>
                                        </button>
                                    </div>
                                    <div id="promoMessage" class="text-xs hidden"></div>

                                    @if ($promos->isNotEmpty())
                                        <div class="mt-2">
                                            <span
                                                class="text-[10px] uppercase text-gray-400 tracking-wider font-semibold">Promo
                                                Aktif:</span>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-2">
                                                @foreach ($promos as $p)
                                                    <div onclick="selectPromoBadge('{{ $p->kode }}')"
                                                        class="p-3 rounded-xl border border-[#2E2E2E] bg-[#252525]/40 hover:border-[#C9A84C]/50 transition duration-300 cursor-pointer flex justify-between items-start">
                                                        <div>
                                                            <span
                                                                class="text-xs font-bold text-[#C9A84C] block">{{ $p->kode }}</span>
                                                            <span
                                                                class="text-[10px] text-gray-400 mt-0.5 line-clamp-1">{{ $p->nama }}</span>
                                                        </div>
                                                        <span
                                                            class="text-[10px] font-semibold px-2 py-0.5 rounded bg-[#C9A84C]/10 text-[#C9A84C] border border-[#C9A84C]/25">
                                                            @if ($p->tipe === 'persentase')
                                                                {{ $p->nominal }}% OFF
                                                            @else
                                                                -Rp {{ number_format($p->nominal, 0, ',', '.') }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div
                                    class="p-4 rounded-xl bg-amber-500/5 border border-amber-500/20 text-amber-200/90 text-xs flex gap-3 items-start leading-relaxed">

                                    <div>
                                        <span class="font-semibold block mb-0.5">Catatan Pembayaran:</span>
                                        Booking Anda berstatus <strong class="text-[#C9A84C]">Waiting Payment</strong>.
                                        Setelah konfirmasi, admin akan memverifikasi kedatangan jika
                                        diperlukan via WhatsApp chat.
                                    </div>
                                </div>
                            </div>

                            <div
                                class="lg:col-span-1 p-6 rounded-2xl bg-[#1C1C1C] border border-[#C9A84C]/30 relative overflow-hidden flex flex-col justify-between">
                                <div class="absolute -top-10 -right-10 w-24 h-24 rounded-full bg-[#C9A84C]/5 blur-xl">
                                </div>

                                <div>
                                    <h3
                                        class=" font-bold text-lg border-b border-[#2E2E2E] pb-3 text-[#F0EDE8] flex items-center gap-2">

                                        Ringkasan Booking
                                    </h3>

                                    <!-- Service Detail -->
                                    <div class="mt-4 flex flex-col gap-1">
                                        <span class="text-[10px] uppercase text-gray-400 tracking-wider">Layanan</span>
                                        <span id="summaryLayananName"
                                            class="text-sm font-bold text-[#F0EDE8]">-</span>
                                        <span id="summaryLayananDuration" class="text-xs text-gray-400">-</span>
                                    </div>

                                    <!-- Barber Detail -->
                                    <div class="mt-4 flex flex-col gap-1">
                                        <span class="text-[10px] uppercase text-gray-400 tracking-wider">Barber</span>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            <div id="summaryBarberImgContainer"
                                                class="w-6 h-6 rounded-full bg-[#2E2E2E] overflow-hidden hidden">
                                                <img id="summaryBarberImg" src=""
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <span id="summaryBarberName"
                                                class="text-sm font-bold text-[#F0EDE8]">-</span>
                                        </div>
                                    </div>

                                    <!-- Date/Time Detail -->
                                    <div class="mt-4 flex flex-col gap-1">
                                        <span class="text-[10px] uppercase text-gray-400 tracking-wider">Jadwal
                                            Kedatangan</span>
                                        <span id="summaryDateTime" class="text-sm font-bold text-[#F0EDE8]">-</span>
                                    </div>

                                    <!-- Price Details -->
                                    <div class="mt-6 pt-4 border-t border-[#2E2E2E] flex flex-col gap-2">
                                        <div class="flex justify-between items-center text-xs text-gray-400">
                                            <span>Subtotal</span>
                                            <span id="summarySubtotal">Rp 0</span>
                                        </div>
                                        <div id="summaryPromoRow"
                                            class="flex justify-between items-center text-xs text-emerald-400 hidden">
                                            <span class="flex items-center gap-1">
                                                Diskon (<span id="appliedPromoBadge"></span>)
                                                <button type="button" onclick="removePromoCode()"
                                                    class="text-white hover:text-rose-300 ml-1 text-xs bg-rose-600 px-2 py-1 rounded-lg">Hapus</button>
                                            </span>
                                            <span id="summaryDiscount">-Rp 0</span>
                                        </div>
                                        <div class="flex justify-between items-end pt-2 border-t border-[#2E2E2E]/40">
                                            <span class="text-xs text-white font-semibold">Total Biaya</span>
                                            <span id="summaryLayananPrice"
                                                class=" text-xl font-bold text-[#C9A84C]">Rp 0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- navigasi btn -->
                    <div class="mt-10 pt-6 border-t border-[#3D3D3D] flex justify-between items-center z-10">
                        <button type="button" id="prevBtn" class="btn-outline px-6 py-3 rounded-xl text-sm hidden"
                            onclick="navigateStep(-1)">
                            Sebelumnya
                        </button>
                        <div></div>
                        <button type="button" id="nextBtn"
                            class="btn-gold px-8 py-3 rounded-xl text-sm flex items-center gap-2"
                            onclick="navigateStep(1)">
                            <span>Selanjutnya</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- footer -->
    <x-footer />

    <script>
        let currentStep = 1;
        const totalSteps = 4;

        let bookingData = {
            layananId: null,
            layananName: '',
            layananPrice: 0,
            layananDuration: 0,
            barberId: null,
            barberName: '',
            barberImg: '',
            tanggal: '{{ date('Y-m-d') }}',
            jam: null,
            promoCode: '',
            promoDiscount: 0
        };

        updateSummaryDate(bookingData.tanggal);

        function selectLayanan(id, name, price, duration) {
            bookingData.layananId = id;
            bookingData.layananName = name;
            bookingData.layananPrice = price;
            bookingData.layananDuration = duration;

            document.getElementById('selectedLayananId').value = id;

            // hapus penggunaan promo
            removePromoCode(true);

            const cards = document.querySelectorAll('#step1 .selectable-card');
            cards.forEach(card => card.classList.remove('selected'));

            const selectedCards = document.querySelectorAll('#step1 .check-badge');
            selectedCards.forEach(badge => badge.classList.add('hidden'));


            const currentCard = event.currentTarget;
            currentCard.classList.add('selected');
            currentCard.querySelector('.check-badge').classList.remove('hidden');

            // Update layanan
            document.getElementById('summaryLayananName').innerText = name;
            document.getElementById('summaryLayananDuration').innerText = `${duration} Menit`;

            updateInvoiceTotal();

            bookingData.jam = null;
            document.getElementById('selectedJam').value = '';
            fetchQueueEstimation();

            validateStep();
        }

        function selectBarber(id, name, img) {
            bookingData.barberId = id;
            bookingData.barberName = name;
            bookingData.barberImg = img;

            document.getElementById('selectedBarberId').value = id;

            // Update UI card styling
            const cards = document.querySelectorAll('#step2 .selectable-card');
            cards.forEach(card => card.classList.remove('selected'));

            const selectedBadges = document.querySelectorAll('#step2 .check-badge');
            selectedBadges.forEach(badge => badge.classList.add('hidden'));

            // Set styling on selected card
            const currentCard = event.currentTarget;
            currentCard.classList.add('selected');
            currentCard.querySelector('.check-badge').classList.remove('hidden');

            // Update Invoice Summary
            document.getElementById('summaryBarberName').innerText = name;

            const imgContainer = document.getElementById('summaryBarberImgContainer');
            const summaryImg = document.getElementById('summaryBarberImg');
            if (img) {
                summaryImg.src = img;
                imgContainer.classList.remove('hidden');
            } else {
                imgContainer.classList.add('hidden');
            }

            bookingData.jam = null;
            document.getElementById('selectedJam').value = '';
            fetchQueueEstimation();

            validateStep();
        }

        function fetchQueueEstimation() {
            if (!bookingData.layananId || !bookingData.barberId || !bookingData.tanggal) {
                return;
            }

            const loadingEl = document.getElementById('estimationLoading');
            const detailsEl = document.getElementById('estimationDetails');

            if (loadingEl && detailsEl) {
                loadingEl.classList.remove('hidden');
                detailsEl.classList.add('hidden');
            }

            const url =
                `{{ route('user.booking.estimate-time') }}?barber_id=${bookingData.barberId}&layanan_id=${bookingData.layananId}&tanggal=${bookingData.tanggal}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (loadingEl) loadingEl.classList.add('hidden');
                    if (data.success) {
                        if (detailsEl) detailsEl.classList.remove('hidden');

                        // Update values
                        document.getElementById('estimatedStartTime').innerText = data.estimated_start_time;
                        document.getElementById('estimatedEndTime').innerText = data.estimated_end_time;
                        document.getElementById('estimatedQueueCount').innerText = data.queue_count;
                        document.getElementById('estimatedDuration').innerText = data.duration;

                        bookingData.jam = data.estimated_start_time;
                        document.getElementById('selectedJam').value = data.estimated_start_time;

                        updateSummaryDateTime();
                        validateStep();
                    } else {
                        alert(data.message || "Gagal mendapatkan estimasi antrean.");
                    }
                })
                .catch(error => {
                    if (loadingEl) loadingEl.classList.add('hidden');
                    console.error('Error fetching queue estimation:', error);
                });
        }

        function updateSummaryDate(val) {
            bookingData.tanggal = val;
            bookingData.jam = null;
            document.getElementById('selectedJam').value = '';

            fetchQueueEstimation();
            updateSummaryDateTime();
        }

        function updateSummaryDateTime() {
            if (!bookingData.tanggal) return;

            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const dateObj = new Date(bookingData.tanggal);
            const formattedDate = dateObj.toLocaleDateString('id-ID', options);

            const timeStr = bookingData.jam ? ` Pukul ${bookingData.jam} WIB` : '';
            document.getElementById('summaryDateTime').innerText = formattedDate + timeStr;
        }

        function navigateStep(direction) {
            if (direction > 0 && !validateStep(true)) {
                return;
            }

            document.getElementById(`step${currentStep}`).classList.remove('active');
            currentStep += direction;
            document.getElementById(`step${currentStep}`).classList.add('active');

            if (currentStep === 3) {
                fetchQueueEstimation();
            }
            updateStepIndicators();

            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            if (currentStep === 1) {
                prevBtn.classList.add('hidden');
            } else {
                prevBtn.classList.remove('hidden');
            }

            if (currentStep === totalSteps) {
                nextBtn.innerHTML = `
                    <span>Konfirmasi</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                `;
            } else {
                nextBtn.innerHTML = `
                    <span>Selanjutnya</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                `;
            }

            window.scrollTo({
                top: document.querySelector('.glass-panel').offsetTop - 100,
                behavior: 'smooth'
            });

            validateStep();
        }

        function updateStepIndicators() {
            const indicators = document.querySelectorAll('.step-indicator');
            const progressPercentage = ((currentStep - 1) / (totalSteps - 1)) * 90;
            document.getElementById('progressLine').style.width = `${progressPercentage}%`;

            indicators.forEach(ind => {
                const stepNum = parseInt(ind.getAttribute('data-step'));
                const numberDiv = ind.querySelector('div');
                const textSpan = ind.querySelector('span');

                if (stepNum < currentStep) {
                    numberDiv.className =
                        "w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm bg-[#C9A84C] text-black border border-[#C9A84C]/50";
                    textSpan.className =
                        "text-xs font-semibold tracking-wider uppercase text-[#C9A84C] hidden sm:inline";
                } else if (stepNum === currentStep) {
                    numberDiv.className =
                        "w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm bg-[#C9A84C] text-[#1C1C1C] border border-[#C9A84C]";
                    textSpan.className =
                        "text-xs font-semibold tracking-wider uppercase text-[#C9A84C] hidden sm:inline";
                } else {
                    numberDiv.className =
                        "w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm bg-[#2E2E2E] text-gray-400 border border-[#3D3D3D]";
                    textSpan.className =
                        "text-xs font-semibold tracking-wider uppercase text-gray-400 hidden sm:inline";
                }
            });
        }

        function validateStep(triggerAlert = false) {
            const nextBtn = document.getElementById('nextBtn');
            let isValid = true;

            if (currentStep === 1) {
                if (!bookingData.layananId) {
                    isValid = false;
                    if (triggerAlert) alert("Silakan pilih salah satu layanan sebelum melanjutkan.");
                }
            } else if (currentStep === 2) {
                if (!bookingData.barberId) {
                    isValid = false;
                    if (triggerAlert) alert("Silakan pilih barber sebelum melanjutkan.");
                }
            } else if (currentStep === 3) {
                if (!bookingData.jam) {
                    isValid = false;
                    if (triggerAlert) alert(
                        "Sedang menghitung estimasi waktu pangkas kosong tercepat. Mohon tunggu beberapa saat.");
                }
            } else if (currentStep === 4) {
                const nohpInput = document.getElementById('nohpInput').value;
                if (!nohpInput || nohpInput.trim().length < 10) {
                    isValid = false;
                    if (triggerAlert) alert("Silakan masukkan nomor WhatsApp aktif yang valid (min. 10 digit).");
                } else {
                    if (triggerAlert) {
                        document.getElementById('bookingForm').submit();
                    }
                }
            }

            nextBtn.disabled = !isValid;
            return isValid;
        }

        // Promo Helper Functions
        function selectPromoBadge(code) {
            document.getElementById('promoInput').value = code;
            applyPromoCode();
        }

        function applyPromoCode() {
            const codeInput = document.getElementById('promoInput').value.trim();
            if (!codeInput) {
                alert('Silakan masukkan kode promo terlebih dahulu.');
                return;
            }

            if (!bookingData.layananId) {
                alert('Silakan pilih layanan terlebih dahulu pada Langkah 1.');
                return;
            }

            const msgEl = document.getElementById('promoMessage');
            msgEl.className = 'text-xs mt-1 text-gray-400';
            msgEl.innerText = 'Memverifikasi kode promo...';
            msgEl.classList.remove('hidden');

            fetch('{{ route('user.booking.check-promo') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        kode: codeInput,
                        layanan_id: bookingData.layananId
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        msgEl.className = 'text-xs mt-1 text-emerald-400';
                        msgEl.innerText = data.message;

                        bookingData.promoCode = data.kode;
                        bookingData.promoDiscount = data.diskon;

                        document.getElementById('selectedPromoCode').value = data.kode;
                        updateInvoiceTotal();
                    } else {
                        msgEl.className = 'text-xs mt-1 text-rose-400';
                        msgEl.innerText = data.message;

                        removePromoCode(false);
                    }
                })
                .catch(err => {
                    console.error(err);
                    msgEl.className = 'text-xs mt-1 text-rose-400';
                    msgEl.innerText = 'Gagal memproses verifikasi promo.';
                });
        }

        function removePromoCode(clearMessage = true) {
            bookingData.promoCode = '';
            bookingData.promoDiscount = 0;
            document.getElementById('selectedPromoCode').value = '';
            document.getElementById('promoInput').value = '';

            updateInvoiceTotal();

            if (clearMessage) {
                document.getElementById('promoMessage').classList.add('hidden');
            }
        }

        function updateInvoiceTotal() {
            const subtotal = bookingData.layananPrice;
            const discount = bookingData.promoDiscount;
            const total = subtotal - discount;

            document.getElementById('summarySubtotal').innerText = `Rp ${subtotal.toLocaleString('id-ID')}`;
            document.getElementById('summaryLayananPrice').innerText = `Rp ${total.toLocaleString('id-ID')}`;

            if (discount > 0) {
                document.getElementById('summaryDiscount').innerText = `-Rp ${discount.toLocaleString('id-ID')}`;
                document.getElementById('appliedPromoBadge').innerText = bookingData.promoCode;
                document.getElementById('summaryPromoRow').classList.remove('hidden');
            } else {
                document.getElementById('summaryPromoRow').classList.add('hidden');
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const nohpInput = document.getElementById('nohpInput');

            if (nohpInput) {
                nohpInput.addEventListener('input', validateStep);
            }
        });
    </script>
</body>

</html>
