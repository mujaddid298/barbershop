<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Barber;
use App\Models\Booking;
use App\Models\Layanan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $today = Carbon::now('Asia/Jakarta')->toDateString();

        $queues = Antrian::where('tanggal', $today)
            ->with(['barber', 'booking.layanan', 'booking.user', 'layanan'])
            ->orderBy('nomor_antrian', 'asc')
            ->get();

        $waitingCount = Antrian::where('tanggal', $today)->where('status', 'waiting')->count();
        $activeCount = Antrian::where('tanggal', $today)->where('status', 'dipanggil')->count();
        $completedCount = Antrian::where('tanggal', $today)->where('status', 'selesai')->count();
        $canceledCount = Antrian::where('tanggal', $today)->where('status', 'batal')->count();

        $barbers = Barber::where('status', true)->get();
        $layanans = Layanan::all();

        $startDate = Carbon::now('Asia/Jakarta')->subDays(29)->toDateString();
        $endDate = Carbon::now('Asia/Jakarta')->toDateString();

        $bookings30Days = Booking::whereIn('status', ['paid', 'done'])
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->get();

        $queues30Days = Antrian::where('tipe', 'offline')
            ->where('status', 'selesai')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->with('layanan')
            ->get();

        $dailyIncome = [];
        $period = new \DatePeriod(
            new \DateTime($startDate),
            new \DateInterval('P1D'),
            (new \DateTime($endDate))->modify('+1 day')
        );

        foreach ($period as $date) {
            $dailyIncome[$date->format('Y-m-d')] = 0;
        }

        foreach ($bookings30Days as $b) {
            $date = $b->tanggal;
            if (isset($dailyIncome[$date])) {
                $dailyIncome[$date] += (int) $b->harga;
            }
        }

        foreach ($queues30Days as $q) {
            $date = $q->tanggal;
            if (isset($dailyIncome[$date])) {
                $dailyIncome[$date] += (int) ($q->layanan?->harga ?? 0);
            }
        }

        $chartLabels = [];
        $chartData = [];
        foreach ($dailyIncome as $date => $amount) {
            $chartLabels[] = Carbon::parse($date)->format('d M');
            $chartData[] = $amount;
        }

        $recentBookings = Booking::whereIn('status', ['paid', 'done'])
            ->with(['user', 'layanan'])
            ->latest('updated_at')
            ->take(5)
            ->get();

        $recentQueues = Antrian::where('tipe', 'offline')
            ->where('status', 'selesai')
            ->with(['layanan'])
            ->latest('updated_at')
            ->take(5)
            ->get();

        $recentTransactions = collect();

        foreach ($recentBookings as $b) {
            $recentTransactions->push((object)[
                'date' => Carbon::parse($b->tanggal)->format('d M Y'),
                'type' => 'Online',
                'customer_name' => $b->user?->name ?? 'Pelanggan Online',
                'service_name' => $b->layanan?->nama ?? 'Pangkas Rambut',
                'net_amount' => (int) $b->harga,
                'time' => $b->updated_at
            ]);
        }

        foreach ($recentQueues as $q) {
            $price = $q->layanan?->harga ?? 0;
            $recentTransactions->push((object)[
                'date' => Carbon::parse($q->tanggal)->format('d M Y'),
                'type' => 'Offline',
                'customer_name' => $q->nama_customer,
                'service_name' => $q->layanan?->nama ?? 'Pangkas Rambut',
                'net_amount' => (int) $price,
                'time' => $q->updated_at
            ]);
        }

        $recentTransactions = $recentTransactions->sortByDesc('time')->take(5);

        return view('pages.admin.dashboard', compact(
            'queues',
            'waitingCount',
            'activeCount',
            'completedCount',
            'canceledCount',
            'barbers',
            'layanans',
            'chartLabels',
            'chartData',
            'recentTransactions'
        ));
    }

    public function storeOffline(Request $request)
    {
        $request->validate([
            'nama_customer' => 'required|string|max:255',
            'barber_id' => 'required|exists:barbers,id',
            'layanan_id' => 'required|exists:layanans,id',
        ], [
            'nama_customer.required' => 'Nama pelanggan wajib diisi.',
            'barber_id.required' => 'Pilih barber terlebih dahulu.',
            'barber_id.exists' => 'Barber tidak valid.',
            'layanan_id.required' => 'Pilih layanan terlebih dahulu.',
            'layanan_id.exists' => 'Layanan tidak valid.',
        ]);

        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $layanan = Layanan::findOrFail($request->layanan_id);

        // Hitung nomor antrean tertinggi hari ini untuk barber pilihan
        $maxQueue = Antrian::where('barber_id', $request->barber_id)
            ->where('tanggal', $today)
            ->max('nomor_antrian');

        $nextQueue = $maxQueue ? $maxQueue + 1 : 1;

        // Buat record antrean baru
        $antrian = Antrian::create([
            'barber_id' => $request->barber_id,
            'booking_id' => null,
            'layanan_id' => $request->layanan_id,
            'nomor_antrian' => $nextQueue,
            'nama_customer' => $request->nama_customer,
            'tipe' => 'offline',
            'durasi' => $layanan->durasi,
            'tanggal' => $today,
            'status' => 'waiting',
        ]);

        return redirect()->route('admin.dashboard')->with('success',
            "Antrean offline #{$nextQueue} ({$antrian->nama_customer}) berhasil ditambahkan."
        );
    }

    public function updateQueueStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:waiting,dipanggil,selesai,batal',
        ]);

        $antrian = Antrian::findOrFail($id);
        $oldStatus = $antrian->status;
        $newStatus = $request->status;

        // Update status antrian
        $antrian->status = $newStatus;
        $antrian->save();

        // Sinkronisasi status booking jika memiliki kaitan dengan booking online
        if ($antrian->booking_id) {
            $booking = $antrian->booking;
            if ($booking) {
                if ($newStatus === 'selesai') {
                    $booking->status = 'done';
                } elseif ($newStatus === 'batal') {
                    $booking->status = 'cancel';
                } else {
                    $booking->status = 'paid';
                }
                $booking->save();
            }
        }

        // Teks respons ramah
        $statusLabels = [
            'waiting' => 'Menunggu',
            'dipanggil' => 'Sedang Dipangkas',
            'selesai' => 'Selesai',
            'batal' => 'Dibatalkan',
        ];

        return redirect()->route('admin.dashboard')->with('success',
            "Antrean #{$antrian->nomor_antrian} ({$antrian->nama_customer}) berhasil diubah menjadi '{$statusLabels[$newStatus]}'."
        );
    }

    public function bookingHistory(Request $request)
    {
        $query = Booking::with(['user', 'barber', 'layanan', 'promo']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($uq) use ($search) {
                    $uq->where('name', 'like', '%'.$search.'%')
                        ->orWhere('email', 'like', '%'.$search.'%');
                })->orWhereHas('promo', function ($pq) use ($search) {
                    $pq->where('kode', 'like', '%'.$search.'%');
                });
            });
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter Barber
        if ($request->filled('barber_id')) {
            $query->where('barber_id', $request->barber_id);
        }

        // Filter Tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $bookings = $query->latest('tanggal')
            ->latest('jam')
            ->get();

        $totalBookings = Booking::count();
        $totalRevenue = Booking::whereIn('status', ['paid', 'done'])->sum('harga');
        $completedCount = Booking::where('status', 'done')->count();
        $activePaidCount = Booking::where('status', 'paid')->count();
        $canceledCount = Booking::where('status', 'cancel')->count();
        $pendingCount = Booking::where('status', 'waiting_payment')->count();

        $barbers = Barber::all();

        return view('pages.admin.booking.history', compact(
            'bookings',
            'barbers',
            'totalBookings',
            'totalRevenue',
            'completedCount',
            'activePaidCount',
            'canceledCount',
            'pendingCount'
        ));
    }
}
