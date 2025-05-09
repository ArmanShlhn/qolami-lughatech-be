<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelajaranSeeder extends Seeder
{
    public function run()
    {
        $kategoriHuruf = DB::table('kategori')->where('nama', 'Huruf')->value('id');
        $kategoriKata = DB::table('kategori')->where('nama', 'Kata')->value('id');

        #Pelajaran Huruf Gabungan
        $pelajaranHuruf = [
            'Pelajaran Huruf 1',
            'Pelajaran Huruf 2',
            'Pelajaran Huruf 3',
        ];

        foreach ($pelajaranHuruf as $nama) {
            DB::table('pelajaran')->insert([
                'kategori_id' => $kategoriHuruf,
                'nama' => $nama,
            ]);
        }

        #Pelajaran Kata Gabungan
        $pelajaranKata = [
            'Pelajaran Kata 1',
        ];

        foreach ($pelajaranKata as $nama) {
            DB::table('pelajaran')->insert([
                'kategori_id' => $kategoriKata,
                'nama' => $nama,
            ]);
        }
    }
}
