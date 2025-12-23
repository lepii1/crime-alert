<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul_laporan',
        'deskripsi',
        'kategori',
        'tgl_lapor',
        'ip_terlapor',
        'status',
        'polisi_id',
        'bukti_kejadian',
        'foto_identitas',
        'lokasi_kejadian'

    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function polisi()
    {
        return $this->belongsTo(Polisi::class, 'polisi_id');
    }
}
