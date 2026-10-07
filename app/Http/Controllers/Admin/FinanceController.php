<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        $selectedPeriod = $request->input('period');
        
        if ($selectedPeriod && strpos($selectedPeriod, '-') !== false) {
            [$year, $month] = explode('-', $selectedPeriod);
        } else {
            $year = date('Y');
            $month = date('m');
            $selectedPeriod = "{$year}-{$month}";
        }

        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth()->toDateString();
        $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth()->toDateString();

        // Fetch unified financial data
        $records = $this->getFinancialData($startDate, $endDate);

        // Calculate Stats
        $totalIncome = $records->sum('net_amount');
        $onlineIncome = $records->where('type', 'Online')->sum('net_amount');
        $offlineIncome = $records->where('type', 'Offline')->sum('net_amount');
        $totalDiscount = $records->sum('discount');
        $totalTransactions = $records->count();

        // Get filter options (last 12 months)
        $availableMonths = [];
        $bulanIndo = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];
        
        for ($i = 0; $i < 12; $i++) {
            $date = Carbon::now('Asia/Jakarta')->subMonths($i);
            $yearStr = $date->format('Y');
            $monthStr = $date->format('m');
            $value = "{$yearStr}-{$monthStr}";
            $availableMonths[] = [
                'value' => $value,
                'label' => ($bulanIndo[$monthStr] ?? $date->format('F')) . ' ' . $yearStr
            ];
        }

        return view('pages.admin.finance.index', compact(
            'records',
            'totalIncome',
            'onlineIncome',
            'offlineIncome',
            'totalDiscount',
            'totalTransactions',
            'availableMonths',
            'selectedPeriod'
        ));
    }

    public function export(Request $request)
    {
        $selectedPeriod = $request->input('period');
        
        if ($selectedPeriod && strpos($selectedPeriod, '-') !== false) {
            [$year, $month] = explode('-', $selectedPeriod);
        } else {
            $year = date('Y');
            $month = date('m');
        }

        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth()->toDateString();
        $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth()->toDateString();

        $records = $this->getFinancialData($startDate, $endDate);

        $bulanIndo = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];
        $monthName = $bulanIndo[$month] ?? $month;
        $fileName = "Laporan_Keuangan_{$monthName}_{$year}.csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename={$fileName}",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['No', 'Tanggal', 'Tipe', 'Nama Pelanggan', 'Barber', 'Layanan', 'Harga Asli', 'Diskon', 'Pendapatan Bersih'];

        $callback = function() use($records, $columns) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Microsoft Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, $columns);

            $no = 1;
            $totalGross = 0;
            $totalDiscount = 0;
            $totalNet = 0;

            foreach ($records as $row) {
                fputcsv($file, [
                    $no++,
                    Carbon::parse($row->date)->format('d-m-Y'),
                    $row->type,
                    $row->customer_name,
                    $row->barber_name,
                    $row->service_name,
                    $row->amount,
                    $row->discount,
                    $row->net_amount
                ]);
                $totalGross += $row->amount;
                $totalDiscount += $row->discount;
                $totalNet += $row->net_amount;
            }

            // Add an empty separator row
            fputcsv($file, []);

            // Add summary row
            fputcsv($file, [
                '',
                '',
                '',
                '',
                '',
                'TOTAL',
                $totalGross,
                $totalDiscount,
                $totalNet
            ]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function getFinancialData($startDate, $endDate)
    {
        // 1. Fetch Online Bookings (paid or done)
        $bookings = Booking::whereIn('status', ['paid', 'done'])
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->with(['user', 'barber', 'layanan', 'promo'])
            ->get();

        // 2. Fetch Offline Queues (offline & selesai)
        $queues = Antrian::where('tipe', 'offline')
            ->where('status', 'selesai')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->with(['barber', 'layanan'])
            ->get();

        $records = collect();

        foreach ($bookings as $b) {
            $originalPrice = $b->layanan?->harga ?? $b->harga;
            $records->push((object)[
                'date' => $b->tanggal,
                'type' => 'Online',
                'customer_name' => $b->user?->name ?? 'Pelanggan Online',
                'barber_name' => $b->barber?->nama ?? '-',
                'service_name' => $b->layanan?->nama ?? 'Pangkas Rambut',
                'amount' => (int) $originalPrice,
                'discount' => (int) $b->diskon,
                'net_amount' => (int) $b->harga, // Saved as net price (layanan->harga - discount)
                'reference_id' => 'BK-' . $b->id
            ]);
        }

        foreach ($queues as $q) {
            $price = $q->layanan?->harga ?? 0;
            $records->push((object)[
                'date' => $q->tanggal,
                'type' => 'Offline',
                'customer_name' => $q->nama_customer,
                'barber_name' => $q->barber?->nama ?? '-',
                'service_name' => $q->layanan?->nama ?? 'Pangkas Rambut',
                'amount' => (int) $price,
                'discount' => 0,
                'net_amount' => (int) $price,
                'reference_id' => 'AQ-' . $q->id
            ]);
        }

        return $records->sortByDesc('date');
    }
}
