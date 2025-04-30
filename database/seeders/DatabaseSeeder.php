<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            KategoriSeeder::class,
            PelajaranSeeder::class,
            IsiPelajaranSeeder::class,
            LatihanSeeder::class,
            SoalLatihanSeeder::class,
            KuisSeeder::class,
            ScoresSeeder::class,
        ]);
    }
}
