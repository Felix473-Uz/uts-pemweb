<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';

    protected $fillable = [
        'id_penyewa',
        'id_kamar',
        'tanggal_pemesanan',
        'tanggal_masuk',
        'tanggal_keluar',
        'status_pembayaran',
    ];

    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class, 'id_penyewa');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar');
    }

    public function konfirmasiPembayaran()
    {
        return $this->hasOne(KonfirmasiPembayaran::class, 'id_pemesanan');
    }
}
