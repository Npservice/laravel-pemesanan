<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class driver extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('driver')->insert([
            [
                'nama_driver' => 'suyatno',
                'kode_driver' => 'DRIV0001',
                'keterangan_driver' => 'baru',
                'status_driver' => 'siap'


            ],
            [
                'nama_driver' => 'sutrisno',
                'kode_driver' => 'DRIV0002',
                'keterangan_driver' => 'baru',
                'status_driver' => 'siap'

            ],
            [
                'nama_driver' => 'juliano',
                'kode_driver' => 'DRIV0003',
                'keterangan_driver' => 'baru',
                'status_driver' => 'siap'

            ],
            [
                'nama_driver' => 'yulianto',
                'kode_driver' => 'DRIV0004',
                'keterangan_driver' => 'baru',
                'status_driver' => 'siap'

            ],
            [
                'nama_driver' => 'andi',
                'kode_driver' => 'DRIV0005',
                'keterangan_driver' => 'lama',
                'status_driver' => 'siap'

            ],
        ]);
    }
}
