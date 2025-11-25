<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('dokumens')->insert([
            [
                'id_dokumen' => 1,
                'judul' => 'SOP Pengeboran',
                'id_kategori' => 1,
                'id_rak' => 1,
                'id_company' => 1,
                'id_divisi' => 1,
                'no_versi' => '1.0',
                'status' => 'aktif',
                'tahun_masuk' => 2023
            ],

            [
                'id_dokumen' => 2,
                'judul' => 'Instruksi Kerja Turbin',
                'id_kategori' => 2,
                'id_rak' => 2,
                'id_company' => 1,
                'id_divisi' => 2,
                'no_versi' => '2.1',
                'status' => 'aktif',
                'tahun_masuk' => 2024
            ],
        ]);
    }
}
