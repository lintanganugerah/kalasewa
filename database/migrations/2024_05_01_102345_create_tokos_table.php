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
        Schema::create('tokos', function (Blueprint $table) {
            $table->id()->index();
            $table->string('nama_toko')->unique();
            $table->string('rating_toko')->nullable();
            $table->string('no_rek')->nullable();
            $table->string('bank')->nullable();
            $table->json('metode_kirim')->default(json_encode([]));
            $table->unsignedInteger('saldo_penghasilan')->nullable()->default(0);
            $table->bigInteger('id_user')->unsigned();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tokos');
    }
};
