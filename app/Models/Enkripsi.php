<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enkripsi extends Model
{
    use HasFactory;

    protected $table = 'enkripsi';

    protected $fillable = [
        'id_penyewa',
        'kunci_enkripsi1',
        'kunci_enkripsi2',
        'kunci_enkripsi3',
        'kunci_enkripsi4',
    ];

    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class, 'id_penyewa');
    }
}
