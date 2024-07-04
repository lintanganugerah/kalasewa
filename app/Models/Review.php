<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'review';

    protected $fillable = [
        'id_penyewa',
        'id_toko',
        'id_produk',
        'komentar',
        'nilai',
        'foto',
        'tipe',
    ];

    protected $casts = [
        'nilai' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_penyewa');
    }

    public function id_review_penyewa()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function id_review_toko()
    {
        return $this->belongsTo(Toko::class, 'id');
    }

    public function id_review_produk()
    {
        return $this->belongsTo(Produk::class, 'id');
    }

    public function getFotoAttribute($value)
    {
        return json_decode($value, true);
    }
}