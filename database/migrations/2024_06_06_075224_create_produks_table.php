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
        Schema::create('produks', function (Blueprint $table) {
            $table->id()->index();
            $table->bigInteger('id_toko')->unsigned();
            $table->string('nama_produk');
            $table->text('deskripsi_produk');
            $table->string('brand');
            $table->unsignedInteger('harga');
            $table->enum('gender', ['Pria', 'Wanita']);
            $table->unsignedInteger('berat_produk');
            $table->string('ukuran_produk');
            $table->json('additional')->nullable();
            $table->bigInteger('id_series')->unsigned();
            $table->json('metode_kirim')->default(json_encode([]));
            $table->enum('status_produk', ['aktif', 'arsip',])->default('aktif');
            $table->timestamps();

            $table->foreign('id_series')->references('id')->on('series')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_toko')->references('id')->on('tokos')->onUpdate('cascade')->onDelete('cascade');
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