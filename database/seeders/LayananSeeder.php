<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Haircut',
                'deskripsi' => 'Potong rambut stylish dan rapi',
                'harga' => 50000,
                'durasi' => 30,
            ],
            [
                'nama' => 'Hair Coloring',
                'deskripsi' => 'Pewarnaan rambut premium',
                'harga' => 150000,
                'durasi' => 90,
            ],
            [
                'nama' => 'Shaving',
                'deskripsi' => 'Cukur jenggot dan kumis',
                'harga' => 30000,
                'durasi' => 20,
            ],
            [
                'nama' => 'Creambath',
                'deskripsi' => 'Perawatan rambut dan relaksasi',
                'harga' => 80000,
                'durasi' => 60,
            ],
        ];

        foreach ($data as $item) {
            Layanan::create($item);
        }
    }
}
