<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_toko',
        'isAlamatTambahan',
        'bio_toko',
        'id_user',
    ];

    protected $casts = [
        'isAlamatTambahan' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function peraturanSewaToko()
    {
        return $this->hasMany(PeraturanSewa::class, 'id_toko');
    }

    public function id_review_toko()
    {
        return $this->hasMany(Review::class, 'id_toko');
    }

    public function produks()
    {
        return $this->hasMany(Produk::class, 'id_toko');
    }

    public function produkReview()
    {
        return $this->hasMany(Review::class, 'id_toko');
    }

    public function alamatTambahan()
    {
        return $this->hasMany(AlamatTambahan::class, 'id_toko');
    }
}