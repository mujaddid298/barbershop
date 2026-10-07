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
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->enum('tipe', ['persentase', 'nominal']);
            $table->integer('nominal');
            $table->integer('minimal_transaksi')->default(0);
            $table->integer('kuota')->default(0); // 0 = unlimited
            $table->integer('terpakai')->default(0);
            $table->date('mulai_berlaku')->nullable();
            $table->date('akhir_berlaku')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
