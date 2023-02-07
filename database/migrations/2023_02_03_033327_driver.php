<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('driver', function (Blueprint $table) {
            $table->increments('id_driver', 10);
            $table->string('nama_driver', 20);
            $table->string('kode_driver')->unique();
            $table->enum('status_driver', ['dipesan', 'booking', 'siap']);
            $table->string('keterangan_driver', 100);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('driver');
    }
};
