<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoProduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID_produk', 'path',
    ];

    public function FotoProduk()
    {
        return $this->belongsTo(FotoProduk::class, 'id')->withDefault();
    }
}
