<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'series'
    ];

    public function series()
    {
        return $this->hasOne(Produk::class, 'id_series')->withDefault();
    }
}