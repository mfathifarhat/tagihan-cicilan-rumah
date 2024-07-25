<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'tagihan_id',
        'customer_id',
        'nominal',
        'bukti',
        'ket',
        'denda',
        'status',
        'user_id',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function tagihan(){
        return $this->belongsTo(Tagihan::class);
    }
}
