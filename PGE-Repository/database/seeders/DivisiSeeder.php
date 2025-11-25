<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('divisis')->insert([
            ['id_divisi' => 1, 'nama_divisi' => 'Geothermal Operation'],
            ['id_divisi' => 2, 'nama_divisi' => 'Engineering'],
            ['id_divisi' => 3, 'nama_divisi' => 'HSE'],
        ]);
    }
}
