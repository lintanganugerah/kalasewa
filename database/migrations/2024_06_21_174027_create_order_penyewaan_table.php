<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_penyewaan', function (Blueprint $table) {
            $table->string('nomor_order')->primary();
            $table->unsignedBigInteger('id_penyewa');
            $table->unsignedBigInteger('id_produk');
            $table->string('ukuran');
            $table->string('tujuan_pengiriman');
            $table->string('metode_kirim');
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai');
            $table->string('pembayaran_via');
            $table->string('nomor_resi')->nullable();
            $table->unsignedBigInteger('biaya_cuci')->nullable(); // Kalo ada produk dengan biaya cuci
            $table->unsignedBigInteger('fee_admin'); // (Harga + additional) x 5%
            $table->unsignedBigInteger('total_harga'); // Harga + additional + biaya cuci jika ada, tanpa fee admin
            $table->BigInteger('jaminan'); // Bakal dikurangi denda_keterlambatan dan denda_lainnya, jika hasil minus maka akan diminta ke user
            $table->unsignedBigInteger('denda_keterlambatan')->nullable();
            $table->unsignedBigInteger('total_penghasilan'); // total_harga - fee_admin + (denda_keterlambatan + denda_lainnya), Ini adalah nominal yang akan dilepaskan ke pemilik sewa
            $table->json('bukti_penerimaan')->nullable(); //Path foto bukti penerimaan, ga bisa di edit
            $table->json('denda_lainnya')->nullable(); // 'Nama Peraturan' => 'Nominal_denda'
            $table->json('additional')->nullable(); // 'Nama Additional' => 'Harga'
            $table->dateTime('tanggal_diterima')->nullable();
            $table->dateTime('tanggal_pengembalian')->nullable();
            $table->enum('status', ['Menunggu di Proses', 'Dalam Pengiriman', 'Sedang Berlangsung', 'Retur', 'Retur Dikonfirmasi', 'Retur dalam Pengiriman', 'Retur Selesai', 'Telah Kembali', 'Penyewaan Selesai', 'Dibatalkan Pemilik Sewa', 'Dibatalkan Penyewa']);
            $table->timestamps();

            $table->foreign('id_penyewa')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_produk')->references('id')->on('produks')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_penyewaan');
    }
};