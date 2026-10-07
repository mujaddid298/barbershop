<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $table = 'antrians';

    protected $fillable = [
        'barber_id',
        'booking_id',
        'layanan_id',
        'nomor_antrian',
        'nama_customer',
        'tipe',
        'durasi',
        'tanggal',
        'status',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }
}
