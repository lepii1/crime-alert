<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laporan;
use App\Models\User;

class LaporanSeeder extends Seeder
{
    /**
     * Jalankan database seeder untuk mengisi data dummy pada tabel laporans.
     * Menggunakan format string tanggal standar untuk menghindari error Carbon.
     */
    public function run(): void
    {
        $userIlham = User::where('email', 'ilham@gmail.com')->first();
        $userMijan = User::where('email', 'mijan@gmail.com')->first();

        // Cek jika user tidak ditemukan untuk menghindari error
        if (!$userIlham || !$userMijan) {
            $this->command->error('User Ilham atau Mijan tidak ditemukan! Pastikan DatabaseSeeder sudah dijalankan.');
            return;
        }

        $data = [
            [
                'user_id' => $userIlham->id,
                'judul_laporan' => 'Pencurian Motor di Parkiran Minimarket',
                'deskripsi' => 'Telah terjadi pencurian sepeda motor Honda Vario warna hitam dengan plat nomor B 1234 ABC pada pukul 19:30 WIB.',
                'kategori' => 'Pencurian',
                'tgl_lapor' => '2024-12-20', // Format Biasa: YYYY-MM-DD
                'ip_terlapor' => '192.168.1.10',
                'latitude' => -6.2088,
                'longitude' => 106.8456,
                'status' => 'pending',
                'bukti_kejadian' => 'laporan/bukti/dummy_curanmor.jpg',
                'foto_identitas' => 'laporan/identitas/dummy_ktp.jpg',
            ],
            [
                'user_id' => $userIlham->id,
                'judul_laporan' => 'Tawuran Pelajar di Jalan Raya',
                'deskripsi' => 'Sekelompok pelajar berkumpul dan membawa senjata tajam di sekitar lampu merah. Sangat meresahkan warga.',
                'kategori' => 'Tawuran',
                'tgl_lapor' => '2024-12-18',
                'ip_terlapor' => '110.12.33.45',
                'latitude' => -6.1751,
                'longitude' => 106.8272,
                'status' => 'proses',
                'bukti_kejadian' => 'laporan/bukti/dummy_tawuran.jpg',
                'foto_identitas' => 'laporan/identitas/dummy_ktp.jpg',
            ],
            [
                'user_id' => $userMijan->id,
                'judul_laporan' => 'Penipuan Modus Menang Undian',
                'deskripsi' => 'Menerima pesan WhatsApp yang menyatakan menang undian 50 juta dan diminta mengirimkan sejumlah uang.',
                'kategori' => 'Penipuan',
                'tgl_lapor' => '2024-11-25',
                'ip_terlapor' => '103.44.12.99',
                'latitude' => -7.2575,
                'longitude' => 112.7521,
                'status' => 'selesai',
                'bukti_kejadian' => 'laporan/bukti/dummy_penipuan.jpg',
                'foto_identitas' => 'laporan/identitas/dummy_ktp.jpg',
            ],
            [
                'user_id' => $userMijan->id,
                'judul_laporan' => 'Kehilangan Dompet di Pasar Malam',
                'deskripsi' => 'Dompet berisi dokumen penting hilang saat sedang berbelanja. Diduga dicopet.',
                'kategori' => 'Lain-lain',
                'tgl_lapor' => '2024-12-21',
                'ip_terlapor' => '125.160.10.5',
                'latitude' => -6.9175,
                'longitude' => 107.6191,
                'status' => 'pending',
                'bukti_kejadian' => 'laporan/bukti/dummy_kehilangan.jpg',
                'foto_identitas' => 'laporan/identitas/dummy_ktp.jpg',
            ],
            [
                'user_id' => $userIlham->id,
                'judul_laporan' => 'Pelecehan Verbal di Transportasi Umum',
                'deskripsi' => 'Seorang pria melakukan tindakan tidak menyenangkan berupa ucapan tidak pantas di dalam bus.',
                'kategori' => 'Pelecehan',
                'tgl_lapor' => '2024-12-19',
                'ip_terlapor' => '182.253.55.12',
                'latitude' => -3.6547,
                'longitude' => 128.1906,
                'status' => 'proses',
                'bukti_kejadian' => 'laporan/bukti/dummy_pelecehan.jpg',
                'foto_identitas' => 'laporan/identitas/dummy_ktp.jpg',
            ],
            [
                'user_id' => $userMijan->id,
                'judul_laporan' => 'Kekerasan Dalam Lingkungan Warga',
                'deskripsi' => 'Terjadi perkelahian antar tetangga yang berujung pada kerusakan properti.',
                'kategori' => 'Kekerasan',
                'tgl_lapor' => '2024-12-10',
                'ip_terlapor' => '202.152.1.200',
                'latitude' => -5.1476,
                'longitude' => 119.4327,
                'status' => 'selesai',
                'bukti_kejadian' => 'laporan/bukti/dummy_kekerasan.jpg',
                'foto_identitas' => 'laporan/identitas/dummy_ktp.jpg',
            ],
            [
                'user_id' => $userIlham->id,
                'judul_laporan' => 'Aksi Vandalisme Fasilitas Publik',
                'deskripsi' => 'Dinding taman kota dicoret-coret oleh sekelompok remaja menggunakan pilox.',
                'kategori' => 'Lain-lain',
                'tgl_lapor' => '2024-12-22',
                'ip_terlapor' => '114.124.200.5',
                'latitude' => -0.9471,
                'longitude' => 100.4172,
                'status' => 'pending',
                'bukti_kejadian' => 'laporan/bukti/dummy_vandalisme.jpg',
                'foto_identitas' => 'laporan/identitas/dummy_ktp.jpg',
            ],
        ];

        foreach ($data as $item) {
            Laporan::create($item);
        }

        $this->command->info('Laporan dummy dengan format tanggal standar berhasil ditambahkan!');
    }
}
