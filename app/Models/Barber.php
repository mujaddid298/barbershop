<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    protected $table = 'barbers';

    protected $fillable = [
        'nama',
        'foto',
        'status',
        'keahlian',
    ];

    /**
     * Get the works created by this barber.
     */
    public function hasilKaryas()
    {
        return $this->hasMany(HasilKarya::class, 'barber_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'barber_id');
    }
}
