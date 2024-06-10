<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
    'nama_prouk', 'ID_toko', 'kategori', 'ukuran_produk', 'status_produk', 'deskripsi_produk'
    ];

    public function setUkuranProdukAttribute($value)
    {
        $this->attributes['ukuran_produk'] = json_encode($value);
    }

    public function getUkuranProdukAttribute($value)
    {
        return json_decode($value, true);
    }

    public function FotoProduk()
    {
        return $this->hasOne(FotoProduk::class, 'ID_produk')->withDefault();
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
}
