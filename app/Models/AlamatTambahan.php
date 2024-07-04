<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatTambahan extends Model
{
    use HasFactory;

    protected $table = 'alamat_tambahan';

    protected $fillable = [
        'id_toko',
        'nama',
        'alamat',
    ];

    public function toko()
    {
        return $this->belongsTo(Toko::class, 'id_toko');
    }
}