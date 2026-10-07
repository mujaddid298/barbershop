<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Booking Saya · Men's Hair Studio</title>
    <link rel="icon" type="image/png" href="{{ asset('icons/mens.png') }}">
    <meta name="description" content="Pantau status antrean dan riwayat pemesanan Anda di Men's Hair Studio Barbershop">
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

        .glass-panel {
            background: rgba(46, 46, 46, 0.4);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border);
        }

        .btn-gold {
            background: var(--gold);
            color: var(--dark);
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-gold:hover {
            background: var(--gold-light);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            color: var(--gold);
            border: 1px solid var(--gold);
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-outline:hover {
            background: var(--gold);
            color: var(--dark);
        }

        /* Tab system */
        .tab-btn {
            position: relative;
            padding: 1rem 1.5rem;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tab-btn:hover {
            color: var(--text);
        }

        .tab-btn.active {
            color: var(--gold);
        }

        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 2.5px;
            background: var(--gold);
            border-radius: 1px;
        }

        .tab-panel {
            display: none;
            animation: fadeSlideIn 0.4s ease forwards;
        }

        .tab-panel.active {
            display: block;
        }

        @keyframes fadeSlideIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
    </style>
</head>

<body>

    <x-header-user />

    <!-- MAIN CONTENT -->
    <main class="flex-grow pt-28 pb-12 md:py-36 px-4 md:px-8">
        <div class="max-w-4xl mx-auto">

            <!-- Alerts -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm font-medium">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Page Header -->
            <div class="mb-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                <div>
                    <span class="text-xs tracking-[0.2em] text-[#C9A84C] uppercase font-semibold">Grooming Studio</span>
                    <h1 class=" text-3xl md:text-4xl font-bold mt-1 text-[#F0EDE8]">Riwayat Booking</h1>
                    <p class="text-sm text-gray-400 mt-2">Pantau status antrean aktif dan riwayat pangkas rambut Anda.
                    </p>
                </div>
                <a href="{{ route('user.booking.create') }}"
                    class="btn-gold px-5 py-3 rounded-xl text-xs tracking-wider uppercase flex items-center justify-center gap-2 self-start sm:self-auto shadow-lg">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Booking Baru
                </a>
            </div>

            <!-- Tabs System -->
            <div class="glass-panel rounded-3xl overflow-hidden relative">
                <div class="flex border-b border-[#3D3D3D]">
                    <button type="button" class="tab-btn active whitespace-nowrap" onclick="switchTab('active', this)">
                        <span class="flex items-center gap-2">
                            Aktif & Mendatang
                        </span>
                    </button>
                    <button type="button" class="tab-btn whitespace-nowrap" onclick="switchTab('past', this)">
                        <span class="flex items-center gap-2">

                            Selesai & Batal
                        </span>
                    </button>
                </div>

                @php
                    $today = \Carbon\Carbon::today('Asia/Jakarta')->toDateString();

                    $activeBookings = $bookings->filter(function ($b) use ($today) {
                        return in_array($b->status, ['paid', 'waiting_payment']) && $b->tanggal >= $today;
                    });

                    $pastBookings = $bookings->filter(function ($b) use ($today) {
                        return in_array($b->status, ['done', 'cancel']) || $b->tanggal < $today;
                    });
                @endphp

                <div id="tab-active" class="tab-panel active p-6 md:p-8">
                    @if ($activeBookings->isNotEmpty())
                        <div class="flex flex-col gap-5">
                            @foreach ($activeBookings as $booking)
                                <div
                                    class="bg-[#1C1C1C] border border-[#2E2E2E] rounded-2xl p-5 md:p-6 transition hover:border-[#C9A84C]/40 relative overflow-hidden">
                                    <div
                                        class="absolute -top-10 -right-10 w-24 h-24 rounded-full bg-[#C9A84C]/2 blur-xl">
                                    </div>

                                    <div class="flex flex-col md:flex-row justify-between gap-5 relative z-10">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2.5 mb-2.5">
                                                <span
                                                    class="px-2.5 py-0.5 rounded text-[9px] font-bold tracking-wider uppercase bg-[#C9A84C]/10 border border-[#C9A84C]/25 text-[#C9A84C]">
                                                    Booking ID #BK-{{ sprintf('%04d', $booking->id) }}
                                                </span>
                                                @if ($booking->status === 'waiting_payment')
                                                    <span
                                                        class="px-2.5 py-0.5 rounded text-[9px] font-bold tracking-wider uppercase bg-amber-500/10 border border-amber-500/20 text-amber-400">
                                                        Belum Bayar
                                                    </span>
                                                @else
                                                    <span
                                                        class="px-2.5 py-0.5 rounded text-[9px] font-bold tracking-wider uppercase bg-blue-500/10 border border-blue-500/20 text-blue-400">
                                                        Lunas (Aktif)
                                                    </span>
                                                @endif
                                            </div>

                                            <h3 class=" text-xl font-bold text-[#F0EDE8]">
                                                {{ $booking->layanan ? $booking->layanan->nama : 'Pangkas Rambut' }}
                                            </h3>
                                            <p class="text-xs text-gray-400 mt-1 leading-relaxed max-w-xl">
                                                Barber:
                                                <strong>{{ $booking->barber ? $booking->barber->nama : '-' }}</strong> ·
                                                Durasi: <span>{{ $booking->layanan ? $booking->layanan->durasi : 30 }}
                                                    Menit</span>
                                            </p>

                                            <!-- Booking Date Details -->
                                            <div
                                                class="flex flex-wrap items-center gap-y-1.5 gap-x-4 mt-4 pt-4 border-t border-[#2A2A2A] text-xs text-gray-300">
                                                <span class="flex items-center gap-1.5">
                                                    <svg width="14" height="14" viewBox="0 0 24 24"
                                                        fill="none" stroke="#C9A84C" stroke-width="2">
                                                        <rect x="3" y="4" width="18" height="18" rx="2"
                                                            ry="2" />
                                                        <line x1="16" y1="2" x2="16"
                                                            y2="6" />
                                                        <line x1="8" y1="2" x2="8"
                                                            y2="6" />
                                                        <line x1="3" y1="10" x2="21"
                                                            y2="10" />
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('l, d F Y') }}
                                                </span>
                                                <span class="flex items-center gap-1.5">
                                                    <svg width="14" height="14" viewBox="0 0 24 24"
                                                        fill="none" stroke="#C9A84C" stroke-width="2">
                                                        <circle cx="12" cy="12" r="10" />
                                                        <polyline points="12 6 12 12 16 14" />
                                                    </svg>
                                                    Pukul
                                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $booking->jam)->format('H:i') }}
                                                    WIB (Estimasi)
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Invoice summary & Actions -->
                                        <div
                                            class="flex flex-col justify-between items-start md:items-end min-w-[150px] border-t md:border-t-0 md:border-l border-[#2A2A2A] pt-4 md:pt-0 md:pl-6">
                                            <div class="text-left md:text-right w-full mb-3 md:mb-0">
                                                <span
                                                    class="text-[10px] uppercase text-gray-500 tracking-wider font-semibold block">Total
                                                    Bayar</span>
                                                <span class=" text-lg font-bold text-[#C9A84C] block mt-0.5">Rp
                                                    {{ number_format($booking->harga, 0, ',', '.') }}</span>
                                                @if ($booking->diskon > 0)
                                                    <span class="text-[9px] text-emerald-400 font-semibold block">Diskon
                                                        Rp {{ number_format($booking->diskon, 0, ',', '.') }}</span>
                                                @endif
                                            </div>

                                            <div class="flex gap-2 w-full md:w-auto">
                                                @if ($booking->status === 'waiting_payment')
                                                    <a href="{{ route('user.booking.success', $booking->id) }}"
                                                        class="btn-gold px-4 py-2 rounded-lg text-xs flex-1 md:flex-initial text-center font-bold tracking-wide uppercase">
                                                        Bayar Sekarang
                                                    </a>
                                                @else
                                                    <!-- Live Queue monitors shortcut -->
                                                    <a href="{{ route('live-antrian') }}" target="_blank"
                                                        class="btn-outline px-4 py-2 rounded-lg text-xs flex-1 md:flex-initial text-center font-bold tracking-wide uppercase flex items-center justify-center gap-1.5">
                                                        <span
                                                            class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                                        Pantau Antrean
                                                    </a>
                                                @endif
                                                <a href="{{ route('user.booking.success', $booking->id) }}"
                                                    class="px-4 py-2 rounded-lg border border-[#2E2E2E] hover:border-[#C9A84C]/50 hover:text-white transition text-xs font-semibold text-gray-400 text-center flex-1 md:flex-initial">
                                                    Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-16 text-center">
                            <svg class="mx-auto text-gray-600 mb-3" width="36" height="36"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            <p class="text-sm text-gray-500">Anda tidak memiliki booking aktif atau terjadwal saat ini.
                            </p>
                            <a href="{{ route('user.booking.create') }}"
                                class="btn-outline px-5 py-2.5 rounded-xl text-xs mt-4 inline-block font-semibold">Booking
                                Sekarang</a>
                        </div>
                    @endif
                </div>

                <div id="tab-past" class="tab-panel p-6 md:p-8">
                    @if ($pastBookings->isNotEmpty())
                        <div class="flex flex-col gap-4">
                            @foreach ($pastBookings as $booking)
                                <div
                                    class="bg-[#1C1C1C]/60 border border-[#2E2E2E] rounded-xl p-4.5 p-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 hover:border-gray-700 transition">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="text-xs font-bold text-gray-400">#BK-{{ sprintf('%04d', $booking->id) }}</span>
                                            @if ($booking->status === 'done')
                                                <span
                                                    class="px-2 py-0.5 rounded text-[8px] font-bold uppercase bg-emerald-500/10 border border-emerald-500/25 text-emerald-400">
                                                    Selesai
                                                </span>
                                            @elseif ($booking->status === 'cancel')
                                                <span
                                                    class="px-2 py-0.5 rounded text-[8px] font-bold uppercase bg-red-500/10 border border-red-500/25 text-red-400">
                                                    Batal
                                                </span>
                                            @else
                                                <span
                                                    class="px-2 py-0.5 rounded text-[8px] font-bold uppercase bg-gray-500/10 border border-gray-500/20 text-gray-400">
                                                    Kadaluarsa
                                                </span>
                                            @endif
                                        </div>

                                        <h4 class="text-sm font-semibold text-gray-200 mt-1.5">
                                            {{ $booking->layanan ? $booking->layanan->nama : 'Pangkas Rambut' }}</h4>
                                        <p class="text-[11px] text-gray-500 mt-0.5">
                                            Barber: <span>{{ $booking->barber ? $booking->barber->nama : '-' }}</span>
                                            ·
                                            Jadwal:
                                            <span>{{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d M Y') }}</span>
                                        </p>
                                    </div>

                                    <div
                                        class="flex sm:flex-col items-end justify-between sm:justify-center w-full sm:w-auto border-t sm:border-t-0 border-[#2A2A2A] pt-3 sm:pt-0">
                                        <div class="sm:text-right mb-2 sm:mb-0">
                                            <span class="text-[9px] uppercase text-gray-500 block">Total Biaya</span>
                                            <span class="text-xs font-bold text-[#C9A84C] block mt-0.5">Rp
                                                {{ number_format($booking->harga, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex gap-2">
                                            @if ($booking->status === 'done')
                                                @if ($booking->rating)
                                                    <div class="flex items-center text-yellow-500 bg-[#2E2E2E] px-2 py-1 rounded border border-[#3D3D3D]" title="Rating: {{ $booking->rating }}/5">
                                                        @for($i=1; $i<=5; $i++)
                                                            <svg class="w-3 h-3 {{ $i <= $booking->rating ? 'text-yellow-500' : 'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                        @endfor
                                                    </div>
                                                @else
                                                    <button type="button" onclick="openRatingModal({{ $booking->id }})"
                                                        class="px-3 py-1.5 text-[10px] rounded-lg bg-[#C9A84C] text-black hover:bg-[#E2C97E] transition font-bold tracking-wide uppercase">
                                                        Beri Rating
                                                    </button>
                                                @endif
                                            @endif
                                            <a href="{{ route('user.booking.success', $booking->id) }}"
                                                class="px-3 py-1.5 text-[10px] rounded-lg border border-[#2E2E2E] hover:border-gray-500 hover:text-white transition font-medium text-gray-400">
                                                Lihat Nota
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-16 text-center text-gray-500">
                            <p class="text-sm">Belum ada riwayat booking masa lalu.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Rating -->
    <div id="ratingModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeRatingModal()"></div>
        <div class="bg-[#1C1C1C] border border-[#3D3D3D] rounded-2xl p-6 w-full max-w-md relative z-10 shadow-2xl">
            <h3 class="text-xl font-bold text-white mb-2">Berikan Penilaian</h3>
            <p class="text-sm text-gray-400 mb-6">Bagaimana pengalaman Anda dengan barber kami?</p>
            
            <form id="ratingForm" method="POST" action="">
                @csrf
                <div class="flex justify-center gap-2 mb-6" id="starContainer">
                    @for($i=1; $i<=5; $i++)
                        <button type="button" class="star-btn text-gray-600 hover:scale-110 transition-transform" data-rating="{{ $i }}" onclick="setRating({{ $i }})">
                            <svg class="w-10 h-10 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </button>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="ratingValue" value="0">
                
                <div class="mb-6">
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Komentar (Opsional)</label>
                    <textarea name="komentar" rows="3" class="w-full bg-[#2E2E2E] border border-[#3D3D3D] rounded-xl p-3 text-sm text-white focus:outline-none focus:border-[#C9A84C] transition-colors" placeholder="Tuliskan pengalaman Anda..."></textarea>
                </div>
                
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeRatingModal()" class="px-5 py-2.5 rounded-xl border border-[#3D3D3D] text-gray-300 hover:text-white hover:bg-[#2E2E2E] transition text-sm font-semibold">Batal</button>
                    <button type="submit" id="submitRatingBtn" class="bg-[#C9A84C] text-black px-5 py-2.5 rounded-xl hover:bg-[#E2C97E] transition text-sm font-bold opacity-50 cursor-not-allowed" disabled>Kirim Penilaian</button>
                </div>
            </form>
        </div>
    </div>

    <x-footer />

    <script>
        function switchTab(tabName, btn) {
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));

            document.getElementById(`tab-${tabName}`).classList.add('active');
            btn.classList.add('active');
        }

        let currentRating = 0;
        function openRatingModal(bookingId) {
            document.getElementById('ratingForm').action = `/user/booking/${bookingId}/rate`;
            document.getElementById('ratingModal').classList.remove('hidden');
            setRating(0); // Reset
            document.querySelector('textarea[name="komentar"]').value = '';
        }
        
        function closeRatingModal() {
            document.getElementById('ratingModal').classList.add('hidden');
        }
        
        function setRating(rating) {
            currentRating = rating;
            document.getElementById('ratingValue').value = rating;
            
            const stars = document.querySelectorAll('.star-btn');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.remove('text-gray-600');
                    star.classList.add('text-yellow-500');
                } else {
                    star.classList.remove('text-yellow-500');
                    star.classList.add('text-gray-600');
                }
            });
            
            const submitBtn = document.getElementById('submitRatingBtn');
            if (rating > 0) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }
    </script>
</body>

</html>
