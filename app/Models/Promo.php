<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'promos';

    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
        'tipe',
        'nominal',
        'minimal_transaksi',
        'kuota',
        'terpakai',
        'mulai_berlaku',
        'akhir_berlaku',
        'status',
    ];

    protected $casts = [
        'mulai_berlaku' => 'date',
        'akhir_berlaku' => 'date',
        'status' => 'boolean',
        'nominal' => 'integer',
        'minimal_transaksi' => 'integer',
        'kuota' => 'integer',
        'terpakai' => 'integer',
    ];

    /**
     * Relationship to Bookings.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Validate if the promo is valid for a given transaction amount.
     * Returns [bool isValid, string message]
     */
    public function isValidFor($totalAmount)
    {
        if (! $this->status) {
            return [false, 'Promo ini sudah tidak aktif.'];
        }

        if ($this->kuota > 0 && $this->terpakai >= $this->kuota) {
            return [false, 'Kuota promo ini sudah habis.'];
        }

        $today = now()->startOfDay();
        if ($this->mulai_berlaku && $this->mulai_berlaku->startOfDay()->gt($today)) {
            return [false, 'Promo ini belum mulai berlaku.'];
        }

        if ($this->akhir_berlaku && $this->akhir_berlaku->endOfDay()->lt($today)) {
            return [false, 'Promo ini sudah kedaluwarsa.'];
        }

        if ($totalAmount < $this->minimal_transaksi) {
            return [false, 'Minimal transaksi untuk menggunakan promo ini adalah Rp '.number_format($this->minimal_transaksi, 0, ',', '.')];
        }

        return [true, 'Promo valid.'];
    }

    /**
     * Calculate the discount amount.
     */
    public function calculateDiscount($totalAmount)
    {
        if ($this->tipe === 'persentase') {
            $discount = ($totalAmount * $this->nominal) / 100;

            return min($discount, $totalAmount);
        } else {
            return min($this->nominal, $totalAmount);
        }
    }
}
