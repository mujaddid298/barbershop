@extends('layouts.admin')

@section('title', 'Riwayat Pemesanan — Men\'s Hair Studio')

@section('content')
    <div class="flex-1 bg-[#161616] min-h-screen px-8 py-7 rounded-2xl">

        <!-- Header -->
        <div class="flex items-center justify-between mb-7">
            <div>
                <p class="text-[9px] tracking-[3px] uppercase text-gray-400 font-semibold">Manajemen</p>
                <h1 class="text-xl font-medium text-[#eee] mt-1">Riwayat Pemesanan</h1>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 mb-7 text-white">
            <div class="bg-[#222] border border-[#2E2E2E] rounded-xl px-4 py-3.5 flex flex-col justify-between">
                <p class="text-[9px] tracking-[2px] uppercase text-gray-400 mb-1">Total Booking</p>
                <p class="text-[20px] font-semibold"
                    style="background: linear-gradient(135deg,#C9A84C,#E2C97E); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                    {{ $totalBookings }}
                </p>
            </div>
            <div class="bg-[#222] border border-[#2E2E2E] rounded-xl px-4 py-3.5 flex flex-col justify-between">
                <p class="text-[9px] tracking-[2px] uppercase text-gray-400 mb-1">Gross Revenue</p>
                <p class="text-[20px] font-semibold text-emerald-400">
                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                </p>
            </div>
            <div class="bg-[#222] border border-[#2E2E2E] rounded-xl px-4 py-3.5 flex flex-col justify-between">
                <p class="text-[9px] tracking-[2px] uppercase text-gray-400 mb-1">Selesai</p>
                <p class="text-[20px] font-semibold text-emerald-500">{{ $completedCount }}</p>
            </div>
            <div class="bg-[#222] border border-[#2E2E2E] rounded-xl px-4 py-3.5 flex flex-col justify-between">
                <p class="text-[9px] tracking-[2px] uppercase text-gray-400 mb-1">Aktif (Paid)</p>
                <p class="text-[20px] font-semibold text-[#7aaef5]">{{ $activePaidCount }}</p>
            </div>
            <div class="bg-[#222] border border-[#2E2E2E] rounded-xl px-4 py-3.5 flex flex-col justify-between">
                <p class="text-[9px] tracking-[2px] uppercase text-gray-400 mb-1">Batal</p>
                <p class="text-[20px] font-semibold text-red-500">{{ $canceledCount }}</p>
            </div>
            <div class="bg-[#222] border border-[#2E2E2E] rounded-xl px-4 py-3.5 flex flex-col justify-between">
                <p class="text-[9px] tracking-[2px] uppercase text-gray-400 mb-1">Pending</p>
                <p class="text-[20px] font-semibold text-amber-500">{{ $pendingCount }}</p>
            </div>
        </div>

        <!-- Search & Filter Form -->
        <form method="GET" action="{{ route('admin.booking.history') }}"
            class="grid grid-cols-1 md:grid-cols-5 gap-3 mb-6">
            <!-- Search field -->
            <div class="md:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama, email, kode promo..."
                    class="w-full bg-[#222] border border-[#2E2E2E] rounded-xl px-4 py-2.5 text-[12px] text-white placeholder-[#555] focus:outline-none focus:border-[#C9A84C]/80 transition duration-150" />
            </div>

            <!-- Status filter -->
            <div>
                <select name="status"
                    class="w-full bg-[#222] border border-[#2E2E2E] rounded-xl px-3 py-2.5 text-[12px] text-white focus:outline-none focus:border-[#C9A84C]/80 transition duration-150 cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="waiting_payment" {{ request('status') === 'waiting_payment' ? 'selected' : '' }}>Pending
                    </option>
                    <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Aktif (Paid)</option>
                    <option value="done" {{ request('status') === 'done' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancel" {{ request('status') === 'cancel' ? 'selected' : '' }}>Batal</option>
                </select>
            </div>

            <!-- Barber filter -->
            <div>
                <select name="barber_id"
                    class="w-full bg-[#222] border border-[#2E2E2E] rounded-xl px-3 py-2.5 text-[12px] text-white focus:outline-none focus:border-[#C9A84C]/80 transition duration-150 cursor-pointer">
                    <option value="">Semua Barber</option>
                    @foreach ($barbers as $barber)
                        <option value="{{ $barber->id }}" {{ request('barber_id') == $barber->id ? 'selected' : '' }}>
                            {{ $barber->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex gap-2">
                <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                    class="bg-[#222] border border-[#2E2E2E] rounded-xl px-3 py-2 text-[11px] text-[#ccc] outline-none flex-1 focus:border-[#C9A84C]/80 transition duration-150" />
                <button type="submit"
                    class="px-4 py-2.5 rounded-xl border transition-all duration-150 cursor-pointer hover:scale-[1.02] bg-[#C9A84C]/10 border-[#C9A84C]/30 hover:bg-[#C9A84C]/20 text-[11px] font-semibold text-[#C9A84C] whitespace-nowrap">
                    Filter
                </button>
                @if (request('search') || request('status') || request('barber_id') || request('tanggal'))
                    <a href="{{ route('admin.booking.history') }}"
                        class="px-4 py-2.5 rounded-xl border border-[#2E2E2E] text-[11px] text-gray-400 hover:text-white hover:bg-white/[0.02] transition-colors duration-150 flex items-center justify-center font-medium">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        <!-- Bookings Table -->
        <div class="flex items-center gap-3 mb-4">
            <p class="text-[9px] tracking-[3px] uppercase text-gray-400 font-semibold">Daftar Riwayat Booking</p>
            <div class="flex-1 border-t border-[#2E2E2E]"></div>
        </div>

        <div class="overflow-x-auto">
            @if ($bookings->isNotEmpty())
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b border-[#2E2E2E]">
                            <th class="text-[9px] tracking-[2px] uppercase font-semibold text-left px-3 pb-3 text-gray-400">
                                ID Booking</th>
                            <th class="text-[9px] tracking-[2px] uppercase font-semibold text-left px-3 pb-3 text-gray-400">
                                Pelanggan</th>
                            <th class="text-[9px] tracking-[2px] uppercase font-semibold text-left px-3 pb-3 text-gray-400">
                                Layanan</th>
                            <th class="text-[9px] tracking-[2px] uppercase font-semibold text-left px-3 pb-3 text-gray-400">
                                Barber</th>
                            <th class="text-[9px] tracking-[2px] uppercase font-semibold text-left px-3 pb-3 text-gray-400">
                                Jadwal</th>
                            <th class="text-[9px] tracking-[2px] uppercase font-semibold text-left px-3 pb-3 text-gray-400">
                                Harga</th>
                            <th class="text-[9px] tracking-[2px] uppercase font-semibold text-left px-3 pb-3 text-gray-400">
                                Status</th>
                            <th
                                class="text-[9px] tracking-[2px] uppercase font-semibold text-right px-3 pb-3 text-gray-400">
                                Detail</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#242424]">
                        @foreach ($bookings as $booking)
                            <tr class="group hover:bg-white/[0.02] transition-colors duration-100">
                                <!-- ID -->
                                <td class="px-3 py-3.5 text-xs font-mono font-bold text-gray-400">
                                    #BK-{{ sprintf('%04d', $booking->id) }}
                                </td>

                                <!-- Pelanggan -->
                                <td class="px-3 py-3.5">
                                    <div class="flex items-center gap-2.5">
                                        @if ($booking->user->foto)
                                            <div
                                                class="w-7 h-7 rounded-full overflow-hidden border border-[#2E2E2E] flex-shrink-0">
                                                <img src="{{ asset('storage/' . $booking->user->foto) }}" alt=""
                                                    class="w-full h-full object-cover">
                                            </div>
                                        @else
                                            <div class="w-7 h-7 rounded-full flex items-center justify-center text-[10px] font-semibold text-[#111] flex-shrink-0"
                                                style="background: linear-gradient(135deg,#B8942A,#C9A84C);">
                                                {{ strtoupper(substr($booking->user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <span
                                                class="text-[13px] text-[#ddd] font-medium block leading-tight">{{ $booking->user->name }}</span>
                                            <span
                                                class="text-[10px] text-gray-500 block mt-0.5">{{ $booking->user->nohp ?: 'No WA -' }}</span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Layanan -->
                                <td class="px-3 py-3.5">
                                    <span class="text-xs text-gray-200 block font-medium">
                                        {{ $booking->layanan ? $booking->layanan->nama : 'Pangkas Rambut' }}
                                    </span>
                                    <span class="text-[10px] text-gray-500 block mt-0.5">
                                        {{ $booking->layanan ? $booking->layanan->durasi : 30 }} Menit</span>
                                </td>

                                <!-- Barber -->
                                <td class="px-3 py-3.5 text-xs text-gray-300">
                                    {{ $booking->barber ? $booking->barber->nama : 'Sembarang Barber' }}
                                </td>

                                <!-- Jadwal -->
                                <td class="px-3 py-3.5">
                                    <span class="text-xs text-gray-200 block">
                                        {{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d M Y') }}
                                    </span>
                                    <span class="text-[10px] font-mono text-gray-500 block mt-0.5">
                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $booking->jam)->format('H:i') }} WIB
                                    </span>
                                </td>

                                <!-- Harga -->
                                <td class="px-3 py-3.5">

                                    <span class="text-xs font-semibold text-[#C9A84C]">
                                        Rp {{ number_format($booking->harga, 0, ',', '.') }}
                                    </span>
                                </td>

                                <!-- Status -->
                                <td class="px-3 py-3.5">
                                    @if ($booking->status === 'waiting_payment')
                                        <span
                                            class="inline-flex px-2.5 py-0.5 rounded-full text-[9px] tracking-wider uppercase bg-amber-500/10 border border-amber-500/20 text-amber-400 font-bold">
                                            Pending
                                        </span>
                                    @elseif ($booking->status === 'paid')
                                        <span
                                            class="inline-flex px-2.5 py-0.5 rounded-full text-[9px] tracking-wider uppercase bg-blue-500/10 border border-blue-500/20 text-blue-400 font-bold">
                                            Paid (Aktif)
                                        </span>
                                    @elseif ($booking->status === 'done')
                                        <span
                                            class="inline-flex px-2.5 py-0.5 rounded-full text-[9px] tracking-wider uppercase bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-bold">
                                            Selesai
                                        </span>
                                    @elseif ($booking->status === 'cancel')
                                        <span
                                            class="inline-flex px-2.5 py-0.5 rounded-full text-[9px] tracking-wider uppercase bg-red-500/10 border border-red-500/20 text-red-400 font-bold">
                                            Batal
                                        </span>
                                    @endif
                                </td>

                                <!-- Action -->
                                <td class="px-3 py-3.5 text-right">
                                    <button type="button"
                                        onclick="openDetailModal({{ json_encode($booking) }}, {{ json_encode($booking->user) }}, {{ json_encode($booking->layanan) }}, {{ json_encode($booking->barber) }}, {{ json_encode($booking->promo) }})"
                                        class="inline-flex px-3 py-1.5 rounded-lg text-[10px] font-semibold text-white border border-[#2E2E2E] hover:border-[#C9A84C]/50 hover:text-[#C9A84C] hover:bg-[#C9A84C]/5 transition-all duration-150 cursor-pointer">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="py-20 text-center">
                    <svg class="mx-auto text-gray-600 mb-3" width="36" height="36" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M8 12h8" />
                    </svg>
                    <p class="text-[11px] text-gray-500 tracking-widest uppercase">
                        Tidak ada riwayat pemesanan yang cocok dengan kriteria filter.
                    </p>
                </div>
            @endif
        </div>
    </div>

    <div id="detail-modal"
        class="fixed inset-0 z-[999] flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-200">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/80 backdrop-blur-md" onclick="closeDetailModal()"></div>

        <!-- Modal Container -->
        <div
            class="bg-[#1C1C1C] border border-[#2E2E2E] rounded-3xl w-full max-w-lg p-6 md:p-8 relative z-10 scale-90 transition-transform duration-200 shadow-2xl">
            <!-- Close button -->
            <button type="button" onclick="closeDetailModal()"
                class="absolute top-4 right-4 text-gray-500 hover:text-white transition cursor-pointer p-1">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>

            <!-- Modal Title -->
            <div class="mb-5 border-b border-[#2E2E2E] pb-3.5">
                <span class="text-[9px] tracking-[2px] uppercase text-[#C9A84C] font-semibold block">Detail Booking
                    Digital</span>
                <h3 id="modalBookingId" class="text-base font-semibold text-white mt-0.5">BK-0000</h3>
            </div>

            <div class="space-y-4 text-xs">
                <!-- Customer info -->
                <div>
                    <span class="text-[9px] tracking-[1.5px] uppercase text-gray-500 block mb-1">Pelanggan</span>
                    <div class="flex items-center gap-3 bg-[#242424] p-3 rounded-xl border border-[#2e2e2e]/50">
                        <div id="modalCustomerAvatar"
                            class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-[#111] bg-gradient-to-r from-[#B8942A] to-[#C9A84C]">
                            A</div>
                        <div>
                            <span id="modalCustomerName" class="font-semibold text-white block">Nama Pelanggan</span>
                            <span id="modalCustomerEmail"
                                class="text-[10px] text-gray-400 block mt-0.5">email@domain.com</span>
                        </div>
                    </div>
                </div>

                <!-- Grid Details -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Layanan -->
                    <div class="bg-[#242424]/40 p-3 rounded-xl border border-[#2e2e2e]/50">
                        <span class="text-[9px] tracking-[1.5px] uppercase text-gray-500 block mb-0.5">Layanan</span>
                        <span id="modalLayananName" class="font-semibold text-gray-200 block text-xs">Haircut</span>
                        <span id="modalLayananDuration" class="text-[10px] text-[#C9A84C] block mt-0.5"> 30 Menit</span>
                    </div>

                    <!-- Barber -->
                    <div class="bg-[#242424]/40 p-3 rounded-xl border border-[#2e2e2e]/50">
                        <span class="text-[9px] tracking-[1.5px] uppercase text-gray-500 block mb-0.5">Barber</span>
                        <span id="modalBarberName" class="font-semibold text-gray-200 block text-xs">Sembarang
                            Barber</span>
                        <span class="text-[10px] text-emerald-400 block mt-0.5">Professional</span>
                    </div>

                    <!-- Tanggal -->
                    <div class="bg-[#242424]/40 p-3 rounded-xl border border-[#2e2e2e]/50">
                        <span class="text-[9px] tracking-[1.5px] uppercase text-gray-500 block mb-0.5">Tanggal
                            Booking</span>
                        <span id="modalBookingDate" class="font-semibold text-gray-200 block text-xs">Senin, 01 Mei</span>
                    </div>

                    <!-- Jam -->
                    <div class="bg-[#242424]/40 p-3 rounded-xl border border-[#2e2e2e]/50">
                        <span class="text-[9px] tracking-[1.5px] uppercase text-gray-500 block mb-0.5">Jam Booking</span>
                        <span id="modalBookingTime" class="font-semibold text-gray-200 block text-xs">09:00 WIB</span>
                    </div>
                </div>

                <!-- Promo & Payment details -->
                <div class="border-t border-[#2e2e2e]/40 pt-4 space-y-2">
                    <div class="flex justify-between items-center text-[11px]">
                        <span class="text-gray-500">Harga Layanan</span>
                        <span id="modalSubtotal" class="text-white">Rp 0</span>
                    </div>
                    <div id="modalPromoRow" class="flex justify-between items-center text-[11px] text-emerald-400 hidden">
                        <span id="modalPromoCode">Diskon Promo</span>
                        <span id="modalDiscount">-Rp 0</span>
                    </div>
                    <div class="flex justify-between items-end border-t border-[#2e2e2e]/50 pt-2.5">
                        <span class="font-semibold text-white">Biaya Netto</span>
                        <span id="modalFinalPrice" class="font-serif text-base font-bold text-[#C9A84C]">Rp 0</span>
                    </div>
                </div>

                <!-- Transaction status banner -->
                <div id="modalStatusBanner"
                    class="p-3.5 rounded-xl border text-center text-xs font-semibold tracking-wide uppercase mt-4">
                    STATUS PEMBAYARAN: SUCCESS
                </div>
            </div>
        </div>
    </div>

    <!-- JS untuk Modal Detail -->
    <script>
        const modal = document.getElementById('detail-modal');
        const modalBookingId = document.getElementById('modalBookingId');
        const modalCustomerName = document.getElementById('modalCustomerName');
        const modalCustomerEmail = document.getElementById('modalCustomerEmail');
        const modalCustomerAvatar = document.getElementById('modalCustomerAvatar');
        const modalLayananName = document.getElementById('modalLayananName');
        const modalLayananDuration = document.getElementById('modalLayananDuration');
        const modalBarberName = document.getElementById('modalBarberName');
        const modalBookingDate = document.getElementById('modalBookingDate');
        const modalBookingTime = document.getElementById('modalBookingTime');
        const modalSubtotal = document.getElementById('modalSubtotal');
        const modalDiscount = document.getElementById('modalDiscount');
        const modalPromoRow = document.getElementById('modalPromoRow');
        const modalPromoCode = document.getElementById('modalPromoCode');
        const modalFinalPrice = document.getElementById('modalFinalPrice');
        const modalStatusBanner = document.getElementById('modalStatusBanner');

        function openDetailModal(booking, user, layanan, barber, promo) {
            // ID
            modalBookingId.textContent = `#BK-${String(booking.id).padStart(4, '0')}`;

            // User
            modalCustomerName.textContent = user.name;
            modalCustomerEmail.textContent = user.email + ' · ' + (user.nohp ? user.nohp : 'WA -');
            modalCustomerAvatar.textContent = user.name.substring(0, 1).toUpperCase();

            // Layanan
            modalLayananName.textContent = layanan ? layanan.nama : 'Pangkas Rambut';
            modalLayananDuration.textContent = ' ' + (layanan ? layanan.durasi : 30) + ' Menit';

            // Barber
            modalBarberName.textContent = barber ? barber.nama : 'Sembarang Barber';

            // Jadwal
            const rawDate = new Date(booking.tanggal);
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            modalBookingDate.textContent = rawDate.toLocaleDateString('id-ID', options);
            modalBookingTime.textContent = booking.jam.substring(0, 5) + ' WIB';

            // Price details
            const rawPrice = parseInt(booking.harga);
            const rawDiscount = parseInt(booking.diskon);
            const rawSubtotal = rawPrice + rawDiscount;

            modalSubtotal.textContent = 'Rp ' + rawSubtotal.toLocaleString('id-ID');

            if (rawDiscount > 0) {
                modalPromoRow.classList.remove('hidden');
                modalPromoCode.textContent = 'Diskon Promo (' + (promo ? promo.kode : 'PROMO') + ')';
                modalDiscount.textContent = '-Rp ' + rawDiscount.toLocaleString('id-ID');
            } else {
                modalPromoRow.classList.add('hidden');
            }

            modalFinalPrice.textContent = 'Rp ' + rawPrice.toLocaleString('id-ID');

            // Status Banner Styling
            let bannerClass = '';
            let bannerText = '';

            if (booking.status === 'waiting_payment') {
                bannerClass = 'bg-amber-500/10 border-amber-500/25 text-amber-400';
                bannerText = 'Status Pembayaran: Pending';
            } else if (booking.status === 'paid') {
                bannerClass = 'bg-blue-500/10 border-blue-500/25 text-blue-400 animate-pulse';
                bannerText = 'Status Pembayaran: Paid (Lunas)';
            } else if (booking.status === 'done') {
                bannerClass = 'bg-emerald-500/10 border-emerald-500/25 text-emerald-400';
                bannerText = 'Status Pelayanan: Selesai';
            } else if (booking.status === 'cancel') {
                bannerClass = 'bg-red-500/10 border-red-500/25 text-red-400';
                bannerText = 'Status Pemesanan: Dibatalkan';
            }

            modalStatusBanner.className =
                'p-3.5 rounded-xl border text-center text-xs font-semibold tracking-wide uppercase mt-4 ' + bannerClass;
            modalStatusBanner.textContent = bannerText;

            // Show Modal with zoom & fade effect
            modal.classList.remove('pointer-events-none', 'opacity-0');
            modal.querySelector('.bg-[#1C1C1C]').classList.remove('scale-90');
            modal.querySelector('.bg-[#1C1C1C]').classList.add('scale-100');
        }

        function closeDetailModal() {
            modal.classList.add('pointer-events-none', 'opacity-0');
            modal.querySelector('.bg-[#1C1C1C]').classList.remove('scale-100');
            modal.querySelector('.bg-[#1C1C1C]').classList.add('scale-90');
        }

        // Handle ESC key close
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDetailModal();
            }
        });
    </script>
@endsection
