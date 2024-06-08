<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_toko', 'rating_toko', 'no_rek', 'bank', 'saldo_penghasilan', 'id_user',
    ];

    public function toko()
    {
        return $this->belongsTo(User::class, 'id')->withDefault();
    }
    
}
