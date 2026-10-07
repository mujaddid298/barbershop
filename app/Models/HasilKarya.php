<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilKarya extends Model
{
    protected $table = 'hasil_karyas';

    protected $fillable = [
        'judul',
        'deskripsi',
        'foto',
        'barber_id',
    ];

    /**
     * Get the barber that created this work.
     */
    public function barber(): BelongsTo
    {
        return $this->belongsTo(Barber::class, 'barber_id');
    }
}
