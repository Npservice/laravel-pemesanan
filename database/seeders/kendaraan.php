<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kendaraan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kendaraan')->insert([
            [
                'nama_kendaraan' => 'xenia',
                'no_pol' => 'AG 1 K',
                'status_kendaraan' => 'siap',
                'jenis_kendaraan' => 'mobil',
                'total_pakai' => 10,
                'keterangan_kendaraan' => 'baru'

            ],
            [
                'nama_kendaraan' => 'avansa',
                'no_pol' => 'AG 2 RBE',
                'status_kendaraan' => 'siap',
                'jenis_kendaraan' => 'mobil',
                'total_pakai' => 50,
                'keterangan_kendaraan' => 'lama'
            ],
            [
                'nama_kendaraan' => 'HINO 500',
                'no_pol' => 'AG 1 RBG',
                'status_kendaraan' => 'siap',
                'jenis_kendaraan' => 'mobil',
                'total_pakai' => 40,
                'keterangan_kendaraan' => 'baru'
            ],
            [
                'nama_kendaraan' => 'isuzu elf',
                'no_pol' => 'N 1111 BG',
                'status_kendaraan' => 'siap',
                'jenis_kendaraan' => 'minibus',
                'total_pakai' => 30,
                'keterangan_kendaraan' => 'lama'
            ],
            [
                'nama_kendaraan' => 'kijang inova',
                'no_pol' => 'N 1112 BG',
                'status_kendaraan' => 'siap',
                'jenis_kendaraan' => 'mobil',
                'total_pakai' => 20,
                'keterangan_kendaraan' => 'baru'
            ],
            [
                'nama_kendaraan' => 'FUSO 4x6',
                'no_pol' => 'N 1132 BG',
                'status_kendaraan' => 'siap',
                'jenis_kendaraan' => 'truck',
                'total_pakai' => 100,
                'keterangan_kendaraan' => 'lama'
            ]
        ]);
    }
}
