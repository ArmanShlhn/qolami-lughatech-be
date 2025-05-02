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
                'kategori_id' => 1,
                'nama_kuis' => 'Kuis Huruf Hijaiyah',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kategori_id' => 1,
                'nama_kuis' => 'Kuis Huruf Fathah',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kategori_id' => 1,
                'nama_kuis' => 'Kuis Huruf Kasrah',
                'created_at' => $now,
                'updated_at' => $now,
            ],            [
                'kategori_id' => 1, 
                'nama_kuis' => 'Kuis Huruf Dhammah',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kategori_id' => 1,
                'nama_kuis' => 'Kuis Huruf Fathahtain',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kategori_id' => 1,
                'nama_kuis' => 'Kuis Huruf Kasrahtain',
                'created_at' => $now,
                'updated_at' => $now,
            ],            [
                'kategori_id' => 1,
                'nama_kuis' => 'Kuis Huruf Dhammahtain',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kategori_id' => 2, 
                'nama_kuis' => 'Kuis Kata Fathah',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kategori_id' => 2,
                'nama_kuis' => 'Kuis Kata Kasrah',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kategori_id' => 2,
                'nama_kuis' => 'Kuis Kata Dhammah',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
