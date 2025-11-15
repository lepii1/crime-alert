<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Polisi extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'jabatan',
        'no_hp',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'polisi_id');
    }
}
