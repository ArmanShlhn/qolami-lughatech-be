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

        #Base URL raw GitHub
        $rawGitBaseUrl = 'https://raw.githubusercontent.com/ArmanShlhn/qolami-lughatech-be/refs/heads/main/public/images/fotolistpelajaran';
        $url = fn($filename) => "{$rawGitBaseUrl}/{$filename}";

        $latihanHuruf = [
            'Latihan Huruf 1' => 'pelajaranhuruf2.png',
            'Latihan Huruf 2' => 'pelajaranhuruf3.png',
            'Latihan Huruf 3' => 'pelajaranhuruf4.png',
            'Latihan Huruf 4' => 'pelajaranhuruf5.png',
            'Latihan Huruf 5' => 'pelajaranhuruf6.png',
            'Latihan Huruf 6' => 'pelajaranhuruf7.png',
        ];

        foreach ($latihanHuruf as $nama => $fileGambar) {
            DB::table('latihan')->insert([
                'kategori_id' => $kategoriHuruf,
                'nama'        => $nama,
                'gambar_url'  => $url($fileGambar),
            ]);
        }

        $latihanKata = [
            'Latihan Kata 1' => 'pelajaranhuruf2.png',
            'Latihan Kata 2' => 'pelajaranhuruf3.png',
            'Latihan Kata 3' => 'pelajaranhuruf4.png',
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
