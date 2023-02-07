<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->increments('id_pemesanan');
            $table->integer('kendaraan_id')->unsigned();
            $table->integer('driver_id')->unsigned();
            $table->date('tanggal_pemesanan');
            $table->string('nama_pemesan', 20);
            $table->string('jabatan_pemesan', 20);
            $table->enum('setuju_1', ['setuju', 'tidak setuju'])->nullable();
            $table->enum('setuju_2', ['setuju', 'tidak setuju'])->nullable();
            $table->enum('keterangan_pemesanan', ['menungu', 'gagal', 'berhasil']);
            $table->foreign('kendaraan_id')->references('id_kendaraan')->on('kendaraan')->onDelete('cascade');
            $table->foreign('driver_id')->references('id_driver')->on('driver')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('pemesanan');
    }
};
