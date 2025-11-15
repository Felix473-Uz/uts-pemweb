<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';

    protected $fillable = [
        'nama_kamar',
        'tipe_kamar',
        'harga',
        'fasilitas',
        'status',
    ];

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'id_kamar');
    }
}
