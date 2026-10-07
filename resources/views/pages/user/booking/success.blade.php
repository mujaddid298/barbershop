<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Sukses · Men's Hair Studio</title>
    <link rel="icon" type="image/png" href="{{ asset('icons/mens.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
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
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .receipt-card {
            background: rgba(46, 46, 46, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border);
            position: relative;
        }



        .btn-gold {
            background: var(--gold);
            color: var(--dark);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-gold:hover {
            background: var(--gold-light);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(201, 168, 76, 0.2);
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

        /* Success Animation */
        .success-checkmark {
            width: 80px;
            height: 80px;
            margin: 0 auto;
        }

        .success-checkmark .check-icon {
            width: 80px;
            height: 80px;
            position: relative;
            border-radius: 50%;
            box-sizing: content-box;
            border: 4px solid var(--gold);
        }

        .success-checkmark .check-icon::before {
            top: 3px;
            left: -2px;
            width: 30px;
            transform-origin: 100% 50%;
            border-radius: 100px 0 0 100px;
        }

        .success-checkmark .check-icon::after {
            top: 0;
            left: 30px;
            width: 60px;
            transform-origin: 0 50%;
            border-radius: 0 100px 100px 0;
        }





        .dashed-divider {
            border-top: 2px dashed var(--border);
        }
    </style>
</head>

<body>
    <div class="max-w-md w-full">

        <div class="receipt-card rounded-3xl p-8 shadow-2xl relative overflow-hidden text-center">

            @if ($booking->status === 'paid' && $antrian)
                <h1 class=" text-3xl font-bold text-[#F0EDE8] mb-1">Pemesanan Selesai!</h1>
            @else
                <h1 class=" text-3xl font-bold text-[#F0EDE8] mb-1">Menunggu Pembayaran!</h1>
            @endif
            <p class="text-sm text-[#C9A84C] font-semibold tracking-wider uppercase mb-6">Men's Hair Studio Barbershop
            </p>

            @if ($booking->status === 'paid' && $antrian)
                <div
                    class="my-6 p-6 rounded-2xl bg-gradient-to-br from-[#C9A84C]/10 to-[#C9A84C]/5 border border-[#C9A84C]/30 text-center relative overflow-hidden">
                    <div class="absolute -top-10 -left-10 w-20 h-20 rounded-full bg-[#C9A84C]/5 blur-lg"></div>
                    <div class="absolute -bottom-10 -right-10 w-20 h-20 rounded-full bg-[#C9A84C]/5 blur-lg"></div>

                    <span class="text-[10px] uppercase text-gray-400 tracking-widest font-semibold block">Nomor Antrean
                        Anda</span>
                    <div class=" text-6xl font-extrabold text-[#C9A84C] mt-2 mb-2 tracking-tight">
                        #{{ sprintf('%02d', $antrian->nomor_antrian) }}
                    </div>
                    <div
                        class="text-[10px]   font-semibold tracking-wider uppercase flex items-center justify-center gap-1.5 mt-1">

                        Terdaftar di Antrean
                    </div>
                </div>
            @else
                <div class="my-6 p-5 rounded-2xl bg-[#2E2E2E]/40 border border-[#3D3D3D] text-center">
                    <span class="text-xs text-gray-400 block leading-relaxed">
                        Selesaikan pembayaran Anda untuk mendapatkan nomor antrean pangkas rambut Anda.
                    </span>
                </div>
            @endif

            <div class="bg-[#1C1C1C] rounded-2xl p-5 border border-[#3D3D3D] text-left flex flex-col gap-4 mb-8">
                <div class="flex justify-between items-center pb-3 border-b border-[#2E2E2E]">
                    <span class="text-xs text-gray-400">Kode Booking</span>
                    <span
                        class="text-sm font-mono font-bold text-white tracking-wider">#KC-{{ sprintf('%05d', $booking->id) }}</span>
                </div>

                <div class="flex justify-between items-start">
                    <span class="text-xs text-gray-400">Layanan</span>
                    <div class="text-right">
                        <div class="text-sm font-bold text-white">{{ $booking->layanan->name }}</div>
                        <div class="text-[10px] text-gray-400">{{ $booking->layanan->durasi }} Menit</div>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-xs text-gray-400">Barber</span>
                    <span class="text-sm font-bold text-white">{{ $booking->barber->nama }}</span>
                </div>

                <div class="flex justify-between items-start">
                    <span class="text-xs text-gray-400">Jadwal (Estimasi)</span>
                    <div class="text-right">
                        <div class="text-sm font-bold text-white">
                            {{ \Carbon\Carbon::parse($booking->tanggal)->locale('id')->isoFormat('D MMMM YYYY') }}</div>
                        <div class="text-xs text-[#C9A84C] font-medium mt-0.5">Pukul {{ $booking->jam }} WIB</div>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-xs text-gray-400">Status Pembayaran</span>
                    @if ($booking->status === 'paid')
                        <span
                            class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-500/10 border border-emerald-500/30 text-emerald-400">
                            LUNAS / PAID
                        </span>
                    @else
                        <span
                            class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-500/10 border border-amber-500/30 text-amber-500 animate-pulse">
                            Waiting Payment
                        </span>
                    @endif
                </div>

                <div class="dashed-divider my-2"></div>

                @if ($booking->diskon > 0)
                    <div class="flex justify-between items-center text-xs text-gray-400">
                        <span>Harga Layanan</span>
                        <span>Rp {{ number_format($booking->harga + $booking->diskon, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center text-xs text-emerald-400">
                        <span>Diskon ({{ $booking->promo->kode ?? 'Promo' }})</span>
                        <span>-Rp {{ number_format($booking->diskon, 0, ',', '.') }}</span>
                    </div>
                    <div class="dashed-divider my-2"></div>
                @endif

                <div class="flex justify-between items-end">
                    <span class="text-xs text-gray-400">Total Pembayaran</span>
                    <span class=" text-xl font-bold text-[#C9A84C]">Rp
                        {{ number_format($booking->harga, 0, ',', '.') }}</span>
                </div>
            </div>



            <!-- ACTION BUTTONS -->
            <div class="flex flex-col gap-3">
                @if ($booking->status === 'waiting_payment')
                    <button type="button" id="pay-button" onclick="payNow()"
                        class="btn-gold w-full py-4 rounded-xl text-sm flex items-center justify-center gap-2">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="5" width="20" height="14" rx="2" ry="2" />
                            <line x1="2" y1="10" x2="22" y2="10" />
                        </svg>
                        Bayar Sekarang
                    </button>
                @endif


                <a href="{{ route('user.dashboard') }}"
                    class="text-xs text-gray-400 hover:text-[#C9A84C] mt-2 transition duration-300">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <!-- Load Midtrans -->
    @if ($booking->status === 'waiting_payment')
        @if (config('services.midtrans.is_production'))
            <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}">
            </script>
        @else
            <script src="https://app.sandbox.midtrans.com/snap/snap.js"
                data-client-key="{{ config('services.midtrans.client_key') }}"></script>
        @endif
    @endif

    <script>
        const snapToken = "{{ $transaksi->snap_token ?? '' }}";
        const bookingId = "{{ $booking->id }}";
        const csrfToken = "{{ csrf_token() }}";

        function payNow() {
            if (!snapToken) {
                alert("Token pembayaran tidak ditemukan.");
                return;
            }

            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    console.log('Payment success:', result);
                    confirmPaymentOnServer();
                },
                onPending: function(result) {
                    console.log('Payment pending:', result);
                    alert("Pembayaran Anda sedang diproses. Mohon selesaikan pembayaran.");
                },
                onError: function(result) {
                    console.error('Payment error:', result);
                    alert("Terjadi kesalahan saat memproses pembayaran.");
                },
                onClose: function() {
                    console.log('Snap popup closed');
                }
            });
        }

        function confirmPaymentOnServer() {
            const payBtn = document.getElementById('pay-button');
            if (payBtn) {
                payBtn.disabled = true;
                payBtn.innerHTML = `
                    <div class="w-5 h-5 rounded-full border-2 border-t-white border-r-transparent border-b-transparent border-l-transparent animate-spin"></div>
                    Memproses pembayaran...
                `;
            }

            fetch("{{ route('user.booking.payment-complete') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify({
                        booking_id: bookingId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert(data.message || "Gagal mengonfirmasi pembayaran di server.");
                        if (payBtn) {
                            payBtn.disabled = false;
                            payBtn.innerHTML = `
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="5" width="20" height="14" rx="2" ry="2"/>
                                <line x1="2" y1="10" x2="22" y2="10"/>
                            </svg>
                            Bayar Sekarang
                        `;
                        }
                    }
                })
                .catch(error => {
                    console.error("Error confirming payment:", error);
                    alert("Koneksi gagal saat mengonfirmasi pembayaran.");
                    if (payBtn) {
                        payBtn.disabled = false;
                        payBtn.innerHTML = `
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="5" width="20" height="14" rx="2" ry="2"/>
                            <line x1="2" y1="10" x2="22" y2="10"/>
                        </svg>
                        Bayar Sekarang
                    `;
                    }
                });
        }
    </script>
</body>

</html>
