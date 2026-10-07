<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';

    protected $fillable = [
        'booking_id',
        'order_id',
        'gross_amount',
        'snap_token',
        'redirect_url',
        'payment_type',
        'transaction_id',
        'fraud_status',
        'transaction_status',
        'transaction_time',
        'settlement_time',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
