<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama', 'email', 'password', 'no_telp', 'kota', 'kode_pos', 'role', 'alamat', 'provinsi', 'badge'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isSeller()
    {
        return $this->role === 'pemilik sewa';
    }

    public function toko()
    {
        return $this->hasOne(Toko::class, 'ID_user');
    }
}
