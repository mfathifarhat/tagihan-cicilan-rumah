<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'rumah_id',
        'nama',
        'email',
        'password',
        'alamat',
        'no_hp',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cicilan(){
        return $this->hasOne(Cicilan::class, 'customer_id');
    }

    public function rumah(){
        return $this->belongsTo(Rumah::class, 'rumah_id');
    }

    public function pembayaran(){
        return $this->hasMany(Pembayaran::class, 'customer_id');
    }
}
