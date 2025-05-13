<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LatihanSeeder extends Seeder
{
    public function run(){
        DB::table('latihan')->delete();

        $kategoriHuruf = DB::table('kategori')->where('nama', 'Huruf')->value('id');
        $kategoriKata = DB::table('kategori')->where('nama', 'Kata')->value('id');

        $latihanHuruf = [
            'Latihan Huruf 1',
            'Latihan Huruf 2',
            'Latihan Huruf 3',
            'Latihan Huruf 4',
            'Latihan Huruf 5',
            'Latihan Huruf 6',
            'Latihan Huruf 7',
            'Latihan Huruf 8',
            'Latihan Huruf 9',
        ];

        foreach ($latihanHuruf as $nama) {
            DB::table('latihan')->insert([
                'kategori_id' => $kategoriHuruf,
                'nama' => $nama,
            ]);
        }

        $latihanKata = [
            'Latihan Kata 1',
            'Latihan Kata 2',
            'Latihan Kata 3',
        ];

        foreach ($latihanKata as $nama) {
            DB::table('latihan')->insert([
                'kategori_id' => $kategoriKata,
                'nama' => $nama,
            ]);
        }
    }

}