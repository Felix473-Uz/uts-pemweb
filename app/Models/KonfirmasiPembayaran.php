<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KonfirmasiPembayaran extends Model
{
    use HasFactory;

    protected $table = 'konfirmasi_pembayaran';

    protected $fillable = [
        'id_pemesanan',
        'bukti_pembayaran',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }
}
