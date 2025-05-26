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

        // Base URL raw GitHub
        $rawGitBaseUrl = 'https://raw.githubusercontent.com/ArmanShlhn/qolami-lughatech-be/refs/heads/main/public/images/fotolistpelajaran';
        $url = fn($filename) => "{$rawGitBaseUrl}/{$filename}";

        // Pelajaran Huruf
        $pelajaranHuruf = [
            'Pelajaran Huruf 1' => 'pelajaranhuruf1.png',
            'Pelajaran Huruf 2' => 'pelajaranhuruf2.png',
            'Pelajaran Huruf 3' => 'pelajaranhuruf3.png',
            'Pelajaran Huruf 4' => 'pelajaranhuruf4.png',
            'Pelajaran Huruf 5' => 'pelajaranhuruf5.png',
            'Pelajaran Huruf 6' => 'pelajaranhuruf6.png',
            'Pelajaran Huruf 7' => 'pelajaranhuruf7.png',
        ];

        foreach ($pelajaranHuruf as $nama => $fileGambar) {
            DB::table('pelajaran')->insert([
                'kategori_id' => $kategoriHuruf,
                'nama' => $nama,
                'gambar' => $url($fileGambar),
            ]);
        }

        // Pelajaran Kata
        $pelajaranKata = [
            'Pelajaran Kata 1' => 'pelajaranhuruf7.png',
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
