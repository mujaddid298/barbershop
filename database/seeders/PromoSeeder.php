<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promos = [
            [
                'kode' => 'HEMAT10',
                'nama' => 'Diskon Pembuka Harian',
                'deskripsi' => 'Diskon langsung Rp 10.000 tanpa minimal transaksi.',
                'tipe' => 'nominal',
                'nominal' => 10000,
                'minimal_transaksi' => 0,
                'kuota' => 100,
                'terpakai' => 0,
                'mulai_berlaku' => now()->startOfDay(),
                'akhir_berlaku' => now()->addDays(30)->endOfDay(),
                'status' => true,
            ],
            [
                'kode' => 'SUPERFADE',
                'nama' => 'Diskon Akhir Pekan',
                'deskripsi' => 'Diskon 20% khusus transaksi di atas Rp 50.000.',
                'tipe' => 'persentase',
                'nominal' => 20,
                'minimal_transaksi' => 50000,
                'kuota' => 50,
                'terpakai' => 0,
                'mulai_berlaku' => now()->startOfDay(),
                'akhir_berlaku' => now()->addDays(15)->endOfDay(),
                'status' => true,
            ],
            [
                'kode' => 'KINGSNEW',
                'nama' => 'Promo Pelanggan Baru',
                'deskripsi' => 'Diskon Rp 15.000 untuk minimal transaksi Rp 40.000.',
                'tipe' => 'nominal',
                'nominal' => 15000,
                'minimal_transaksi' => 40000,
                'kuota' => 20,
                'terpakai' => 0,
                'mulai_berlaku' => now()->startOfDay(),
                'akhir_berlaku' => now()->addDays(60)->endOfDay(),
                'status' => true,
            ],
        ];

        foreach ($promos as $promo) {
            Promo::updateOrCreate(['kode' => $promo['kode']], $promo);
        }
    }
}
