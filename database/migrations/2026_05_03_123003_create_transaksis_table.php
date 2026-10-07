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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();

            $table->string('order_id')->unique();

            $table->integer('gross_amount');

            $table->string('snap_token')->nullable();
            $table->string('redirect_url')->nullable();

            $table->string('payment_type')->nullable(); // gopay, bank_transfer, dll
            $table->string('transaction_id')->nullable(); // dari Midtrans
            $table->string('fraud_status')->nullable(); // challenge / accept

            $table->enum('transaction_status', [
                'pending',
                'settlement',
                'capture',
                'deny',
                'expire',
                'cancel',
            ])->default('pending');

            $table->timestamp('transaction_time')->nullable();
            $table->timestamp('settlement_time')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
