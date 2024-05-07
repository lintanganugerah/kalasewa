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
}
