<?php

namespace Database\Seeders;

use App\Models\Barber;
use Illuminate\Database\Seeder;

class BarberSeeder extends Seeder
{
    public function run(): void
    {
        Barber::create([
            'nama' => 'Udin',
            'keahlian' => 'Classic Style',
            'status' => 1,
            'foto' => 'images/barber-1.jpg',
        ]);

        Barber::create([
            'nama' => 'budi',
            'keahlian' => 'Classic Style',
            'status' => 1,
            'foto' => 'images/barber-1.jpg',
        ]);

        Barber::create([
            'nama' => 'ucok',
            'keahlian' => 'Classic Style',
            'status' => 1,
            'foto' => 'images/barber-1.jpg',
        ]);

    }
}
