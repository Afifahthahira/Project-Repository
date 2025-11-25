<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CompanySeeder::class,
            DivisiSeeder::class,
            KategoriSeeder::class,
            RakSeeder::class,
            DokumenSeeder::class,
            UserSeeder::class,
        ]);
    }
}
