<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->increments('id_kendaraan', 10);
            $table->string('nama_kendaraan', 100);
            $table->string('no_pol', 20)->unique();
            $table->enum('status_kendaraan', ['dipesan', 'booking', 'siap']);
            $table->string('jenis_kendaraan', 20);
            $table->integer('total_pakai');
            $table->string('keterangan_kendaraan', 100);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('kendaraan');
    }
};
