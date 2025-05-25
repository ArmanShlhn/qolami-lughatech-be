<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelajaranSeeder extends Seeder
{
    public function run()
    {
        $kategoriHuruf = DB::table('kategori')->where('nama', 'Huruf')->value('id');
        $kategoriKata  = DB::table('kategori')->where('nama', 'Kata')->value('id');

        #Fungsi untuk generate URL gambar dari raw.githubusercontent
        $rawGitBaseUrl = 'https://raw.githubusercontent.com/ArmanShlhn/qolami-lughatech-be/main/public/images/fotolistpelajaran';
        $url = fn($filename) => "{$rawGitBaseUrl}/{$filename}";

        #Pelajaran Huruf
        $pelajaranHuruf = [
            'Pelajaran Huruf 1' => 'pelajaranhuruf1.jpg',
            'Pelajaran Huruf 2' => 'pelajaranhuruf2.jpg',
            'Pelajaran Huruf 3' => 'pelajaranhuruf3.jpg',
            'Pelajaran Huruf 4' => 'pelajaranhuruf4.jpg',
            'Pelajaran Huruf 5' => 'pelajaranhuruf5.jpg',
            'Pelajaran Huruf 6' => 'pelajaranhuruf6.jpg',
            'Pelajaran Huruf 7' => 'pelajaranhuruf7.jpg',
        ];

        foreach ($pelajaranHuruf as $nama => $fileGambar) {
            DB::table('pelajaran')->insert([
                'kategori_id' => $kategoriHuruf,
                'nama' => $nama,
                'gambar' => $url($fileGambar),
            ]);
        }

        #Pelajaran Kata
        $pelajaranKata = [
            'Pelajaran Kata 1' => 'pelajarankata1.jpg',
        ];

        foreach ($pelajaranKata as $nama => $fileGambar) {
            DB::table('pelajaran')->insert([
                'kategori_id' => $kategoriKata,
                'nama' => $nama,
                'gambar' => $url($fileGambar),
            ]);
        }
    }
}
