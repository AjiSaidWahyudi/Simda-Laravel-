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
        Schema::create('inventarisasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kartu_ruang_id');
            $table->string('kode_barang');
            $table->string('kode_register');
            $table->string('jenis_barang');
            $table->string('merek_tipe');
            $table->string('no_seri');
            $table->string('bahan');
            $table->string('cara_perolehan');
            $table->string('tahun_beli');
            $table->string('ukuran');
            $table->string('satuan');
            $table->string('keadaan');
            $table->string('jumlah');
            $table->integer('harga');
            $table->text('keterangan');
            $table->string('qr_code')->nullable();
            $table->foreign('kartu_ruang_id')->references('id')->on('kartu_ruang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarisasi');
    }
};
