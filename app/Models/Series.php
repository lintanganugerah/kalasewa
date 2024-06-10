<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'series'; // Nama tabel di database
    protected $fillable = ['series']; // Kolom yang dapat diisi
}
