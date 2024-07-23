<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cicilan extends Model
{
    use HasFactory;

    protected $fillable = [
        'harga_properti',
        'dp',
        'cicilan',
        'jangka_waktu',
        'status',
        'customer_id',
    ];

    public function lunas()
    {
        return $this->hasMany(Tagihan::class)->where('status', 'Lunas');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class, 'cicilan_id');
    }
}
