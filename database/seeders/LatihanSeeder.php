<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LatihanSeeder extends Seeder
{
    public function run()
    {
        DB::table('latihan')->delete();

        $kategoriHuruf = DB::table('kategori')->where('nama', 'Huruf')->value('id');
        $kategoriKata = DB::table('kategori')->where('nama', 'Kata')->value('id');

        $latihanHuruf = [
            'Latihan 1 - Huruf Hijaiyah',
            'Latihan 2 - Huruf Berharakat Fathah', 
            'Latihan 3 - Huruf Berharakat Kasrah', 
            'Latihan 4 - Huruf Berharakat Dhammah', 
            'Latihan 5 - Huruf Berharakat Fathahtain',
            'Latihan 6 - Huruf Berharakat Kasrahtain', 
            'Latihan 7 - Huruf Berharakat Dhammahtain'
        ];

        foreach ($latihanHuruf as $nama) {
            DB::table('latihan')->insert([
                'kategori_id' => $kategoriHuruf,
                'nama' => $nama,
            ]);
        }

        $latihanKata = [
            'Latihan 1 Kata - Berakhiran Fatha', 
            'Latihan 2 - Kata Berakhiran Kasrah', 
            'Latihan 3 - Kata Berakhiran Dhammah'
        ];

        foreach ($latihanKata as $nama) {
            DB::table('latihan')->insert([
                'kategori_id' => $kategoriKata,
                'nama' => $nama,
            ]);
        }
    }

}
