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
        Schema::create('produks', function (Blueprint $table) {
            $table->id()->index();
            $table->bigInteger('ID_toko')->unsigned();
            $table->string('nama_produk');
            $table->string('kategori');
            $table->string('deskripsi_produk');
            $table->unsignedInteger('berat_produk');
            $table->json('ukuran_produk');
            $table->json('metode_kirim')->default(json_encode([]));
            $table->enum('status_produk',['aktif', 'arsip',])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
