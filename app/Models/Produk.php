<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_prouk',
        'id_toko',
        'id_series',
        'ukuran_produk',
        'status_produk',
        'deskripsi_produk',
        'brand',
        'additional',
        'harga',
        'gender',
        'metode_kirim'
    ];

    public function FotoProduk()
    {
        return $this->hasOne(FotoProduk::class, 'id_produk')->withDefault();
    }

    public function series()
    {
        return $this->belongsTo(Series::class, 'id')->withDefault();
    }

    public function seriesDetail()
    {
        return $this->belongsTo(Series::class, 'id_series')->withDefault();
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'produk_id');
    }

    public function isInWishlist()
    {
        // Ambil user yang sedang login
        $user = auth()->user();

        // Periksa apakah produk ada dalam wishlist user
        return $user->wishlist()->where('produk_id', $this->id)->exists();
    }

    public function toko()
    {
        return $this->belongsTo(Toko::class, 'id_toko');
    }
}