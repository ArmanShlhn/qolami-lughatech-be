<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PelajaranSeeder extends Seeder
{
    public function run()
    {
        #Ambil ID kategori Huruf & Kata
        $kategoriHuruf = DB::table('kategori')->where('nama', 'Huruf')->value('id');
        $kategoriKata = DB::table('kategori')->where('nama', 'Kata')->value('id');
        $kategoriRangkaian = DB::table('kategori')->where('nama', 'Rangkaian')->value('id');

        #Pelajaran untuk kategori Huruf
        $pelajaranHuruf = [
            'Mengenal Huruf Hijaiyah',
            'Huruf Berharakat Fathah',
            'Huruf Berharakat Kasrah',
            'Huruf Berharakat Dhammah',
            'Huruf Berharakat Fathahtain',
            'Huruf Berharakat Kasrahtain',
            'Huruf Berharakat Dhammahtain',
            'Huruf Berharakat Tanwin',
            'Huruf Berharakat Sukun',
            'Huruf Berharakat Tasydid',
        ];

        foreach ($pelajaranHuruf as $nama) {
            DB::table('pelajaran')->insert([
                'kategori_id' => $kategoriHuruf,
                'nama' => $nama,
            ]);
        }

        #Pelajaran untuk kategori Kata
        $pelajaranKata = [
            'Kata Berharakat Fathah',
            'Kata Berharakat Kasrah',
            'Kata Berharakat Dammah',
        ];

        foreach ($pelajaranKata as $nama) {
            DB::table('pelajaran')->insert([
                'kategori_id' => $kategoriKata,
                'nama' => $nama,
            ]);
        }

        $pelajaranRangkaian = [
            'Rangkaian Berharakat Fathah',
            'Rangkaian Berharakat Kasrah',
            'Rangkaian Berharakat Dammah',
        ];

        foreach ($pelajaranRangkaian as $nama) {
            DB::table('pelajaran')->insert([
                'kategori_id' => $kategoriRangkaian,
                'nama' => $nama,
            ]);
        }
    }
}
