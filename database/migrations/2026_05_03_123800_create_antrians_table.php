<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('antrians', function (Blueprint $table) {
            $table->id();

            $table->foreignId('barber_id')->constrained()->cascadeOnDelete();
            $table->foreignId('booking_id')->nullable()->constrained()->cascadeOnDelete();
            $table->integer('nomor_antrian');

            $table->string('nama_customer');
            $table->enum('tipe', ['online', 'offline']);

            $table->integer('durasi');

            $table->date('tanggal');

            $table->enum('status', [
                'waiting',
                'dipanggil',
                'selesai',
                'batal',
            ])->default('waiting');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrians');
    }
};
