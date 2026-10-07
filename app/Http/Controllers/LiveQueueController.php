<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Barber;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LiveQueueController extends Controller
{

    public function index(Request $request)
    {
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $barbers = Barber::where('status', true)->get();

        // Ambil antrean yang sedang dipangkas hari ini
        $activeQueues = Antrian::where('tanggal', $today)
            ->where('status', 'dipanggil')
            ->with(['barber', 'booking.layanan', 'layanan'])
            ->get()
            ->keyBy('barber_id');

        // Ambil antrean yang akan datang (waiting) hari ini
        $upcomingQueues = Antrian::where('tanggal', $today)
            ->where('status', 'waiting')
            ->with(['barber', 'booking.layanan', 'layanan'])
            ->orderBy('nomor_antrian', 'asc')
            ->get();

        // Hitung total antrean hari ini
        $totalWaiting = Antrian::where('tanggal', $today)->where('status', 'waiting')->count();
        $totalActive = Antrian::where('tanggal', $today)->where('status', 'dipanggil')->count();
        $totalSelesai = Antrian::where('tanggal', $today)->where('status', 'selesai')->count();

        // Format data barber untuk display
        $barberStatusList = $barbers->map(function ($barber) use ($activeQueues) {
            $currentQueue = $activeQueues->get($barber->id);
            return [
                'id' => $barber->id,
                'nama' => $barber->nama,
                'keahlian' => $barber->keahlian,
                'foto' => asset('storage/' . $barber->foto),
                'is_busy' => !is_null($currentQueue),
                'current_queue' => $currentQueue ? [
                    'nomor_antrian' => sprintf('%02d', $currentQueue->nomor_antrian),
                    'nama_customer' => $currentQueue->nama_customer,
                    'layanan' => $currentQueue->booking && $currentQueue->booking->layanan ? $currentQueue->booking->layanan->nama : ($currentQueue->layanan ? $currentQueue->layanan->nama : 'Pangkas Rambut'),
                    'durasi' => $currentQueue->durasi,
                    'estimasi_jam' => $currentQueue->booking ? Carbon::createFromFormat('H:i:s', $currentQueue->booking->jam)->format('H:i') : '-',
                ] : null
            ];
        });

        // Format data antrean mendatang untuk display
        $upcomingQueuesList = $upcomingQueues->map(function ($queue) {
            return [
                'nomor_antrian' => sprintf('%02d', $queue->nomor_antrian),
                'nama_customer' => $queue->nama_customer,
                'barber_nama' => $queue->barber ? $queue->barber->nama : '-',
                'layanan_nama' => $queue->booking && $queue->booking->layanan ? $queue->booking->layanan->nama : ($queue->layanan ? $queue->layanan->nama : 'Pangkas Rambut'),
                'estimasi_jam' => $queue->booking ? Carbon::createFromFormat('H:i:s', $queue->booking->jam)->format('H:i') : '-',
                'tipe' => $queue->tipe,
                'status' => $queue->status,
            ];
        });

        // Jika request via AJAX / JSON
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'barbers' => $barberStatusList,
                'upcoming' => $upcomingQueuesList,
                'stats' => [
                    'waiting' => $totalWaiting,
                    'active' => $totalActive,
                    'done' => $totalSelesai,
                ]
            ]);
        }

        return view('pages.live-antrian', compact('barberStatusList', 'upcomingQueuesList', 'totalWaiting', 'totalActive', 'totalSelesai'));
    }
}
