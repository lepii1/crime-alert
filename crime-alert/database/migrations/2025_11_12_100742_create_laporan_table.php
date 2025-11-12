<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
//        Schema::create('laporan', function (Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger('user_id'); // pelapor
//            $table->unsignedBigInteger('admin_id')->nullable(); // admin penerima laporan
//
//            $table->string('judul_laporan');
//            $table->text('deskripsi')->nullable();
//            $table->date('tgl_lapor');
//            $table->string('status')->default('pending');
//
//            // kolom lokasi otomatis via API geolokasi
//            $table->string('ip_terlapor')->nullable();
//            $table->string('kota')->nullable();
//            $table->string('negara')->nullable();
//            $table->decimal('latitude', 10, 7)->nullable();
//            $table->decimal('longitude', 10, 7)->nullable();
//
//            $table->boolean('completed')->default(false);
//            $table->timestamps();
//
//            // relasi
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null');
//        });

        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('judul_laporan');
            $table->text('deskripsi');
            $table->date('tgl_lapor');
            $table->string('ip_terlapor')->nullable();
            $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan');
    }
};
