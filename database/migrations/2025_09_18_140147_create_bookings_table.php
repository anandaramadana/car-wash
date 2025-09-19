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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Booking Member
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('car_id')->nullable()->constrained()->onDelete('cascade');

            // Booking Guest
            $table->string('nama_customer')->nullable();
            $table->string('merk_mobil_customer')->nullable();
            $table->string('model_mobil_customer')->nullable();

            // Pemilihan Jenis Service
            $table->foreignId('service_id')->constrained()->onDelete('cascade');

            $table->date('tanggal_booking');
            $table->enum('status', ['Pending', 'Proses', 'Selesai', 'Batal'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
