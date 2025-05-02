<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siswa')->insert([
            'nama' => 'Aji',
            'nomor_induk' => 1000,
            'alamat' => 'Bandung',
            'created_at' =>date('Y-m-d H:i:s'),
        ]);
        DB::table('siswa')->insert([
            'nama' => 'Aji',
            'nomor_induk' => 1001,
            'alamat' => 'Bandung',
            'created_at' =>date('Y-m-d H:i:s'),
        ]);
        DB::table('siswa')->insert([
            'nama' => 'Agus',
            'nomor_induk' => 1003,
            'alamat' => 'Bandung',
            'created_at' =>date('Y-m-d H:i:s'),
        ]);
    }
}
