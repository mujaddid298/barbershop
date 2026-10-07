<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Barber;
use App\Models\Booking;
use App\Models\Layanan;
use App\Models\Promo;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function create()
    {
        $layanans = Layanan::all();
        $barbers = Barber::where('status', true)->withAvg('bookings', 'rating')->get();

        $today = now()->startOfDay();
        $promos = Promo::where('status', true)
            ->where(function ($q) use ($today) {
                $q->whereNull('mulai_berlaku')
                    ->orWhere('mulai_berlaku', '<=', $today);
            })
            ->where(function ($q) use ($today) {
                $q->whereNull('akhir_berlaku')
                    ->orWhere('akhir_berlaku', '>=', $today);
            })
            ->where(function ($q) {
                $q->where('kuota', 0)
                    ->orWhereRaw('terpakai < kuota');
            })
            ->get();

        return view('pages.user.booking.create', compact('layanans', 'barbers', 'promos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'layanan_id' => 'required|exists:layanans,id',
            'barber_id' => 'required|exists:barbers,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'nohp' => 'required|string|min:10',
            'promo_code' => 'nullable|string',
        ], [
            'layanan_id.required' => 'Pilih layanan terlebih dahulu.',
            'layanan_id.exists' => 'Layanan yang dipilih tidak valid.',
            'barber_id.required' => 'Pilih barber terlebih dahulu.',
            'barber_id.exists' => 'Barber yang dipilih tidak valid.',
            'tanggal.required' => 'Tentukan tanggal booking.',
            'tanggal.after_or_equal' => 'Tanggal booking tidak boleh di masa lalu.',
            'nohp.required' => 'Nomor WhatsApp wajib diisi.',
            'nohp.min' => 'Nomor WhatsApp tidak valid (minimal 10 digit).',
        ]);

        $layanan = Layanan::findOrFail($request->layanan_id);

        $discount = 0;
        $promoId = null;
        if ($request->filled('promo_code')) {
            $promo = Promo::where('kode', strtoupper(trim($request->promo_code)))->first();
            if ($promo) {
                [$isValid, $msg] = $promo->isValidFor($layanan->harga);
                if ($isValid) {
                    $discount = $promo->calculateDiscount($layanan->harga);
                    $promoId = $promo->id;
                }
            }
        }

        $finalHarga = $layanan->harga - $discount;

        $user = Auth::user();
        if ($user->nohp !== $request->nohp) {
            $user->update(['nohp' => $request->nohp]);
        }

        $estimatedStart = $this->calculateEstimatedTime($request->barber_id, $request->tanggal);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'barber_id' => $request->barber_id,
            'layanan_id' => $request->layanan_id,
            'harga' => $finalHarga,
            'tanggal' => $request->tanggal,
            'jam' => $estimatedStart,
            'status' => 'waiting_payment',
            'promo_id' => $promoId,
            'diskon' => $discount,
        ]);

        $serverKey = config('services.midtrans.server_key');
        $isProduction = config('services.midtrans.is_production');
        $orderId = 'ORDER-'.$booking->id.'-'.time();

        if (empty($serverKey)) {
            $booking->delete();

            return redirect()->back()
                ->withInput()
                ->withErrors(['midtrans' => 'Server Key Midtrans belum dikonfigurasi di file .env. Silakan isi MIDTRANS_SERVER_KEY.']);
        }

        $itemDetails = [
            [
                'id' => 'LYN-'.$layanan->id,
                'price' => (int) $layanan->harga,
                'quantity' => 1,
                'name' => $layanan->nama,
            ],
        ];

        if ($booking->promo_id && $booking->diskon > 0) {
            $itemDetails[] = [
                'id' => 'PRM-'.$booking->promo_id,
                'price' => -(int) $booking->diskon,
                'quantity' => 1,
                'name' => 'Promo: '.$booking->promo->kode,
            ];
        }

        $snapUrl = $isProduction
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        $snapToken = null;
        $redirectUrl = null;

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
                ->withBasicAuth($serverKey, '')
                ->post($snapUrl, [
                    'transaction_details' => [
                        'order_id' => $orderId,
                        'gross_amount' => (int) $booking->harga,
                    ],
                    'customer_details' => [
                        'first_name' => $user->name,
                        'email' => $user->email,
                        'phone' => $request->nohp,
                    ],
                    'item_details' => $itemDetails,
                ]);

            if ($response->successful()) {
                $result = $response->json();
                $snapToken = $result['token'] ?? null;
                $redirectUrl = $result['redirect_url'] ?? null;
            } else {
                Log::error('Midtrans Snap Generation Failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                $booking->delete();
                $errorBody = $response->json();
                $errorMsg = $errorBody['error_messages'][0] ?? 'Gagal menghubungi Midtrans (HTTP '.$response->status().')';

                return redirect()->back()
                    ->withInput()
                    ->withErrors(['midtrans' => 'Midtrans Error: '.$errorMsg]);
            }
        } catch (\Exception $e) {
            Log::error('Midtrans Snap API Request Exception: '.$e->getMessage());
            $booking->delete();

            return redirect()->back()
                ->withInput()
                ->withErrors(['midtrans' => 'Gagal terhubung ke Midtrans: '.$e->getMessage()]);
        }

        if (! $snapToken) {
            $booking->delete();

            return redirect()->back()
                ->withInput()
                ->withErrors(['midtrans' => 'Midtrans tidak mengembalikan snap token. Periksa konfigurasi API key Anda.']);
        }

        Transaksi::create([
            'booking_id' => $booking->id,
            'order_id' => $orderId,
            'gross_amount' => (int) $booking->harga,
            'snap_token' => $snapToken,
            'redirect_url' => $redirectUrl,
            'transaction_status' => 'pending',
        ]);

        return redirect()->route('user.booking.success', $booking->id)
            ->with('success', 'Booking berhasil dibuat!');
    }

    public function success($id)
    {
        $booking = Booking::with([
            'barber',
            'layanan',
            'user',
            'transaksi',
            'antrian',
        ])->findOrFail($id);

        if ((int) $booking->user_id !== (int) Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $transaksi = Transaksi::where('booking_id', $booking->id)->first();
        $antrian = Antrian::where('booking_id', $booking->id)->first();

        return view('pages.user.booking.success', compact('booking', 'transaksi', 'antrian'));
    }

    public function estimateTime(Request $request)
    {
        $barberId = $request->input('barber_id');
        $tanggal = $request->input('tanggal', date('Y-m-d'));
        $layananId = $request->input('layanan_id');

        if (! $barberId || ! $layananId) {
            return response()->json([
                'success' => false,
                'message' => 'Barber dan layanan wajib dipilih.',
            ], 400);
        }

        $layanan = Layanan::find($layananId);

        if (! $layanan) {
            return response()->json([
                'success' => false,
                'message' => 'Layanan tidak ditemukan.',
            ], 400);
        }

        $estimatedStart = $this->calculateEstimatedTime($barberId, $tanggal);

        // Pastikan durasi integer
        $duration = is_numeric($layanan->durasi)
            ? (int) $layanan->durasi
            : (int) preg_replace('/[^0-9]/', '', (string) $layanan->durasi);

        $startCarbon = Carbon::createFromFormat(
            'H:i',
            $estimatedStart,
            'Asia/Jakarta'
        );

        $endCarbon = $startCarbon->copy()->addMinutes($duration);

        $estimatedEnd = $endCarbon->format('H:i');

        $queueCount = Antrian::where('barber_id', $barberId)
            ->where('tanggal', $tanggal)
            ->whereIn('status', ['waiting', 'dipanggil'])
            ->count();

        return response()->json([
            'success' => true,
            'estimated_start_time' => $estimatedStart,
            'estimated_end_time' => $estimatedEnd,
            'queue_count' => (int) $queueCount,
            'duration' => $duration,
        ]);
    }

    public function calculateEstimatedTime($barberId, $tanggal)
    {
        $now = Carbon::now('Asia/Jakarta');
        $isToday = ($tanggal === $now->format('Y-m-d'));

        $openingTime = Carbon::createFromFormat(
            'H:i',
            '09:00',
            'Asia/Jakarta'
        );

        if ($isToday) {

            if ($now->gt($openingTime)) {

                $baseTime = $now->copy();

                $minutes = (int) $baseTime->minute;
                $remainder = $minutes % 5;

                if ($remainder > 0) {
                    $baseTime->addMinutes(5 - $remainder);
                }

                $baseTime->second(0);

            } else {

                $baseTime = $openingTime->copy();

            }

        } else {

            $baseTime = $openingTime->copy();

        }

        $activeQueues = Antrian::where('barber_id', $barberId)
            ->where('tanggal', $tanggal)
            ->whereIn('status', ['waiting', 'dipanggil'])
            ->orderBy('nomor_antrian', 'asc')
            ->get();

        $accumulatedTime = $baseTime->copy();

        foreach ($activeQueues as $q) {

            // Amankan durasi dari database
            $durasi = is_numeric($q->durasi)
                ? (int) $q->durasi
                : (int) preg_replace('/[^0-9]/', '', (string) $q->durasi);

            if ($durasi > 0) {
                $accumulatedTime->addMinutes($durasi);
            }

            // Debug sementara
            \Log::info('Durasi antrian', [
                'antrian_id' => $q->id,
                'durasi_asli' => $q->durasi,
                'durasi_final' => $durasi,
                'tipe' => gettype($q->durasi),
            ]);
        }

        return $accumulatedTime->format('H:i');
    }

    public function paymentComplete(Request $request)
    {
        $bookingId = $request->input('booking_id');
        $booking = Booking::findOrFail($bookingId);

        if ($booking->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak.',
            ], 403);
        }

        if ($booking->status === 'waiting_payment') {
            $booking->update(['status' => 'paid']);

            // Increment usage of promo
            if ($booking->promo_id) {
                $booking->promo()->increment('terpakai');
            }

            $transaksi = Transaksi::where('booking_id', $booking->id)->first();
            if ($transaksi) {
                $transaksi->update([
                    'transaction_status' => 'settlement',
                    'settlement_time' => now(),
                ]);
            } else {
                Transaksi::create([
                    'booking_id' => $booking->id,
                    'order_id' => 'KC-'.$booking->id.'-'.time(),
                    'gross_amount' => (int) $booking->harga,
                    'transaction_status' => 'settlement',
                    'payment_type' => 'simulation',
                    'transaction_id' => 'SIM-'.uniqid(),
                    'settlement_time' => now(),
                ]);
            }

            // Tentukan nomor antrean
            $this->assignQueueNumber($booking);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran sukses diverifikasi.',
        ]);
    }

    public function paymentCallback(Request $request)
    {
        $json = $request->all();
        Log::info('Midtrans Webhook Callback Received', $json);

        $orderId = $json['order_id'] ?? null;
        $statusCode = $json['status_code'] ?? null;
        $grossAmount = $json['gross_amount'] ?? null;
        $transactionStatus = $json['transaction_status'] ?? null;
        $paymentType = $json['payment_type'] ?? null;
        $transactionId = $json['transaction_id'] ?? null;
        $fraudStatus = $json['fraud_status'] ?? null;
        $signatureKey = $json['signature_key'] ?? null;

        if (! $orderId) {
            return response()->json(['success' => false, 'message' => 'Data tidak valid.'], 400);
        }

        // Verifikasi tanda tangan
        $serverKey = config('services.midtrans.server_key');
        $localSignature = hash('sha512', $orderId.$statusCode.$grossAmount.$serverKey);

        // Verifikasi signature dari Midtrans
        if (empty($signatureKey) || $signatureKey !== $localSignature) {
            Log::warning('Midtrans Webhook: Signature mismatch', [
                'order_id' => $orderId,
                'received_signature' => $signatureKey,
                'expected_signature' => $localSignature,
            ]);

            return response()->json(['success' => false, 'message' => 'Tanda tangan transaksi tidak cocok.'], 403);
        }

        $parts = explode('-', $orderId);
        $bookingId = $parts[1] ?? null;

        if (! $bookingId) {
            return response()->json(['success' => false, 'message' => 'Format order_id tidak valid.'], 400);
        }

        $booking = Booking::find($bookingId);
        if (! $booking) {
            return response()->json(['success' => false, 'message' => 'Booking tidak ditemukan.'], 404);
        }

        // Ambil atau buat transaksi baru
        $transaksi = Transaksi::where('booking_id', $booking->id)->first();
        if (! $transaksi) {
            $transaksi = new Transaksi;
            $transaksi->booking_id = $booking->id;
            $transaksi->order_id = $orderId;
            $transaksi->gross_amount = (int) $grossAmount;
        }

        $transaksi->payment_type = $paymentType;
        $transaksi->transaction_id = $transactionId;
        $transaksi->fraud_status = $fraudStatus;
        $transaksi->transaction_status = $transactionStatus;
        $transaksi->transaction_time = $json['transaction_time'] ?? now();

        if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
            $transaksi->settlement_time = now();

            // Avoid double increment if status is already paid
            if ($booking->status !== 'paid') {
                $booking->status = 'paid';
                $booking->save();

                if ($booking->promo_id) {
                    $booking->promo()->increment('terpakai');
                }
            }

            // Terbitkan nomor antrean
            $this->assignQueueNumber($booking);
        } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
            $booking->status = 'cancel';
            $booking->save();

            // Batalkan antrean jika pernah diterbitkan
            $antrian = Antrian::where('booking_id', $booking->id)->first();
            if ($antrian) {
                $antrian->status = 'batal';
                $antrian->save();
            }
        }

        $transaksi->save();

        return response()->json(['success' => true, 'message' => 'Callback webhook berhasil diproses.']);
    }

    private function assignQueueNumber(Booking $booking)
    {
        // Hindari pembuatan antrean ganda (jika webhook dikirim berulang)
        $existing = Antrian::where('booking_id', $booking->id)->first();
        if ($existing) {
            return $existing;
        }

        // Hitung nomor antrean tertinggi hari ini untuk barber pilihan
        $maxQueue = Antrian::where('barber_id', $booking->barber_id)
            ->where('tanggal', $booking->tanggal)
            ->max('nomor_antrian');

        $nextQueue = $maxQueue ? $maxQueue + 1 : 1;

        // Buat record antrean baru
        return Antrian::create([
            'barber_id' => $booking->barber_id,
            'booking_id' => $booking->id,
            'nomor_antrian' => $nextQueue,
            'nama_customer' => $booking->user->name,
            'tipe' => 'online',
            'durasi' => $booking->layanan->durasi,
            'tanggal' => $booking->tanggal,
            'status' => 'waiting',
        ]);
    }

    public function checkPromo(Request $request)
    {
        $kode = strtoupper(trim($request->input('kode')));
        $layananId = $request->input('layanan_id');

        if (! $kode) {
            return response()->json([
                'success' => false,
                'message' => 'Kode promo wajib diisi.',
            ]);
        }

        $layanan = Layanan::find($layananId);
        if (! $layanan) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan pilih layanan terlebih dahulu.',
            ]);
        }

        $promo = Promo::where('kode', $kode)->first();
        if (! $promo) {
            return response()->json([
                'success' => false,
                'message' => 'Kode promo tidak ditemukan.',
            ]);
        }

        [$isValid, $msg] = $promo->isValidFor($layanan->harga);
        if (! $isValid) {
            return response()->json([
                'success' => false,
                'message' => $msg,
            ]);
        }

        $discount = $promo->calculateDiscount($layanan->harga);
        $finalPrice = $layanan->harga - $discount;

        return response()->json([
            'success' => true,
            'message' => 'Kode promo berhasil digunakan!',
            'kode' => $promo->kode,
            'nama' => $promo->nama,
            'tipe' => $promo->tipe,
            'nominal' => $promo->nominal,
            'diskon' => $discount,
            'final_price' => $finalPrice,
        ]);
    }

    public function history()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with(['barber', 'layanan', 'promo', 'transaksi'])
            ->latest('tanggal')
            ->latest('jam')
            ->get();

        return view('pages.user.booking.history', compact('bookings'));
    }

    public function rate(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        if ($booking->status !== 'done') {
            return back()->with('error', 'Hanya booking yang sudah selesai yang dapat diberi rating.');
        }

        if ($booking->rating) {
            return back()->with('error', 'Booking ini sudah diberi rating.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
        ]);

        $booking->update([
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return back()->with('success', 'Terima kasih atas penilaian Anda!');
    }
}
