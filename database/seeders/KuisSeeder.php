<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KuisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        DB::table('kuis')->insert([
            [
                'kategori_id' => 2, 
                'nama_kuis' => 'Kuis 1',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
