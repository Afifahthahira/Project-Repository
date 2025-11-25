<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RakSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('raks')->insert([
            ['id_rak' => 1, 'nama_rak' => 'Rak A'],
            ['id_rak' => 2, 'nama_rak' => 'Rak B'],
            ['id_rak' => 3, 'nama_rak' => 'Rak C'],
        ]);
    }
}
