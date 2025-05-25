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
        $kategoriKata  = DB::table('kategori')->where('nama', 'Kata')->value('id');

        #Base URL GitHub raw
        $rawGitBaseUrl = 'https://raw.githubusercontent.com/ArmanShlhn/qolami-lughatech-be/main/public/images/fotolistlatihan';
        $url = fn($filename) => "{$rawGitBaseUrl}/{$filename}";

        $latihanHuruf = [
            'Latihan Huruf 1' => 'latihanhuruf1.jpg',
            'Latihan Huruf 2' => 'latihanhuruf2.jpg',
            'Latihan Huruf 3' => 'latihanhuruf3.jpg',
            'Latihan Huruf 4' => 'latihanhuruf4.jpg',
            'Latihan Huruf 5' => 'latihanhuruf5.jpg',
            'Latihan Huruf 6' => 'latihanhuruf6.jpg',
        ];

        foreach ($latihanHuruf as $nama => $fileGambar) {
            DB::table('latihan')->insert([
                'kategori_id' => $kategoriHuruf,
                'nama'        => $nama,
                'gambar_url'  => $url($fileGambar),
            ]);
        }

        #Latihan Kata
        $latihanKata = [
            'Latihan Kata 1' => 'latihankata1.jpg',
        ];

        foreach ($latihanKata as $nama => $fileGambar) {
            DB::table('latihan')->insert([
                'kategori_id' => $kategoriKata,
                'nama'        => $nama,
                'gambar_url'  => $url($fileGambar),
            ]);
        }
    }
}
