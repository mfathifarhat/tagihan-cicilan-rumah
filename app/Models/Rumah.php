<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    use HasFactory;

    protected $primaryKey = 'blok';
    protected $keyType = 'string';

    protected $fillable = [
        'blok',
        'gambar',
        'jumlah_kamar',
        'luas_tanah',
        'luas_bangunan',
        'harga',
    ];
}
