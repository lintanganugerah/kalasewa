<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ID_toko')->unsigned();
            $table->string('nama_produk');
            $table->string('kategori');
            $table->string('deskripsi_produk');
            $table->json('ukuran_produk');
            $table->enum('status_produk',['proses','pengiriman', 'berlangsung', 'selesai', 'cancel'])->default('proses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
