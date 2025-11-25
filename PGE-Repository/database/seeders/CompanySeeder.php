<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('companies')->insert([
            ['id_company' => 1, 'nama_company' => 'Pertamina Geothermal Energy'],
            ['id_company' => 2, 'nama_company' => 'Pertamina Hulu Energi'],
        ]);
    }
}
