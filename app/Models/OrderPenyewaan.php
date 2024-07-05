<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPenyewaan extends Model
{
    use HasFactory;

    protected $table = 'order_penyewaan';

    protected $primaryKey = 'nomor_order'; //Karena kita di skema tidak memakai id() jadi kita tetapkan ini adalah primary

    public $incrementing = false; //nomor_order tidak auto increment karena menggunakan unix time sebagai Unique nya

    protected $keyType = 'string'; //Tipe primary kita adalah string, berbeda dengan default id() milik laravel, jadi kita tetapkan

    protected $fillable = [
        'nomor_order',
        'id_penyewa',
        'id_produk',
        'ukuran',
        'tujuan_pengiriman',
        'metode_kirim',
        'tanggal_mulai',
        'tanggal_selesai',
        'fee_admin',
        'bukti_penerimaan',
        'biaya_cuci',
        'pembayaran_via',
        'nomor_resi',
        'total_harga',
        'jaminan',
        'denda_keterlambatan',
        'total_penghasilan',
        'denda_lainnya',
        'additional',
        'tanggal_diterima',
        'tanggal_pengembalian',
        'status'
    ];

    protected $casts = [
        'additional' => 'array', //Dikonversi jadi array ketika kita ambil data nya
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'tanggal_diterima' => 'datetime',
        'tanggal_pengembalian' => 'datetime'
    ];

    public function id_penyewa_order()
    {
        return $this->belongsTo(User::class, 'id_penyewa', 'id');
    }

    public function id_produk_order()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }

    public function tanggalFormatted($tanggal)
    {
        $bulanTeks = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
        $hari = $tanggal->format('d');
        $bulan = (int) $tanggal->format('m');

        return $hari . ' ' . $bulanTeks[$bulan];
    }
}