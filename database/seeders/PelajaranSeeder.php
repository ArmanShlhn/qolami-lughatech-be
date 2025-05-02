<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelajaranSeeder extends Seeder
{
    public function run()
    {
        #mengambil ID kategori Huruf & Kata
        $kategoriHuruf = DB::table('kategori')->where('nama', 'Huruf')->value('id');
        $kategoriKata = DB::table('kategori')->where('nama', 'Kata')->value('id');

        #array data seeder pelajaran untuk kategori Huruf
        $pelajaranHuruf = [
            'Mengenal Huruf Hijaiyah',
            'Huruf Berharakat Fathah',
            'Huruf Berharakat Kasrah',
            'Huruf Berharakat Dhammah',
            'Huruf Berharakat Fathahtain',
            'Huruf Berharakat Kasrahtain',
            'Huruf Berharakat Dhammahtain',
        ];

        foreach ($pelajaranHuruf as $nama) {
            DB::table('pelajaran')->insert([
                'kategori_id' => $kategoriHuruf,
                'nama' => $nama,
            ]);
        }

        #array data seeder pelajaran untuk kategori Kata
        $pelajaranKata = [
            'Kata Berakhiran Fathah',
            'Kata Berakhiran Kasrah',
            'Kata Berakhiran Dammah',
        ];

        foreach ($pelajaranKata as $nama) {
            DB::table('pelajaran')->insert([
                'kategori_id' => $kategoriKata,
                'nama' => $nama,
            ]);
        }
    }
}
