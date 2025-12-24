<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'polisi_id',
        'judul_laporan',
        'deskripsi',
        'lokasi_kejadian', // TAMBAHKAN INI
        'kategori',
        'tgl_lapor',
        'ip_terlapor',
        'latitude',
        'longitude',
        'status',
        'bukti_kejadian',
        'foto_identitas'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function polisi()
    {
        return $this->belongsTo(Polisi::class, 'polisi_id');
    }
}
