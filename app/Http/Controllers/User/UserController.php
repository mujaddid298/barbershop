<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use App\Models\Layanan;
use App\Models\Promo;
use App\Models\HasilKarya;

class UserController extends Controller
{
    public function index()
    {
        $layanans = Layanan::all();
        $barbers = Barber::withAvg('bookings', 'rating')->get();

        // Ambil promo yang aktif hari ini
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

        $hasilKaryas = HasilKarya::with('barber')->latest()->get();

        $reviews = \App\Models\Booking::with(['user', 'barber'])
            ->whereNotNull('rating')
            ->whereNotNull('komentar')
            ->latest('updated_at')
            ->take(6)
            ->get();

        return view('pages.user.dashboard', compact('barbers', 'layanans', 'promos', 'hasilKaryas', 'reviews'));
    }
}
