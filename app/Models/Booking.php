<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'barber_id',
        'layanan_id',
        'harga',
        'tanggal',
        'jam',
        'status',
        'promo_id',
        'diskon',
        'rating',
        'komentar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
    public function antrian()
{
    return $this->hasOne(Antrian::class);
}
}
