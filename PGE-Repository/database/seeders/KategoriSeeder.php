<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategoris')->insert([
            ['id_kategori' => 1, 'nama_kategori' => 'SOP'],
            ['id_kategori' => 2, 'nama_kategori' => 'IK'],
            ['id_kategori' => 3, 'nama_kategori' => 'WI'],
        ]);
    }
}
