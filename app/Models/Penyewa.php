<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penyewa extends Model
{
    use HasFactory;

    protected $table = 'penyewa';

    protected $fillable = [
        'id_user',
        'nama',
        'alamat',
        'nik',
        'foto_ktp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'id_penyewa');
    }

    public function enkripsi()
    {
        return $this->hasOne(Enkripsi::class, 'id_penyewa');
    }
}
