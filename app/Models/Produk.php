<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_prouk', 'id_toko', 'id_series', 'ukuran_produk', 'status_produk', 'deskripsi_produk', 'brand', 'harga', 'gender','metode_kirim'
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
        return $this->hasOne(FotoProduk::class, 'id_produk')->withDefault();
    }

    public function series()
    {
        return $this->belongsTo(Series::class, 'id')->withDefault();
    }
}
