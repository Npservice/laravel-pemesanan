<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =  [
            [
                'name' => 'admin',
                'username' => 'admin',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'status' => 'admin',

            ],
            [
                'name' => 'manager',
                'username' => 'manager',
                'password' => Hash::make('12345678'),
                'role' => 'atasan',
                'status' => 'manager',
            ],
            [
                'name' => 'human',
                'username' => 'human',
                'password' => Hash::make('12345678'),
                'role' => 'atasan',
                'status' => 'human',
            ]
        ];
        DB::table('users')->insert($data);
    }
}
