<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('judul_laporan');
            $table->text('deskripsi');
            $table->string('lokasi_kejadian'); // PASTIKAN KOLOM INI ADA
            $table->string('kategori')->default('lain-lain');
            $table->date('tgl_lapor');
            $table->string('ip_terlapor')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');
            $table->string('bukti_kejadian')->nullable();
            $table->string('foto_identitas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
