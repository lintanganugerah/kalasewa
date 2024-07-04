<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeraturanSewa extends Model
{
    use HasFactory;

    protected $table = 'peraturan_sewa_toko';

    protected $fillable = [
        'nama',
        'deskripsi',
        'id_toko',
        'terdapat_denda',
        'denda_pasti',
        'denda_kondisional',
    ];

    protected $casts = [
        'terdapat_denda' => 'boolean',
    ];

    public function peraturanSewaToko()
    {
        return $this->belongsTo(Toko::class, 'id');
    }
}