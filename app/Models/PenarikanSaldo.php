<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenarikanSaldo extends Model
{
    use HasFactory;
    protected $table = 'penarikan_saldo';

    protected $fillable = ['id_user', 'nominal', 'bank', 'nomor_rekening', 'nama_rekening', 'status', 'bukti_transfer'];
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}