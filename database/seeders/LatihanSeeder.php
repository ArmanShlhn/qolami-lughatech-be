<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Latihan;
use App\Models\Kategori;

class LatihanSeeder extends Seeder
{
    public function run()
    {
        $kategoriHuruf = Kategori::where('nama', 'Huruf')->first();
        $kategoriKata = Kategori::where('nama', 'Kata')->first();
        $kategoriRangkaian = Kategori::where('nama', 'Rangkaian')->first();

        if (!$kategoriHuruf || !$kategoriKata || !$kategoriRangkaian) {
            throw new \Exception("Kategori belum tersedia! Jalankan KategoriSeeder terlebih dahulu.");
        }

        $latihanList = [
            ['nama' => 'Latihan 1', 'kategori_id' => $kategoriHuruf->id],
            ['nama' => 'Latihan 2', 'kategori_id' => $kategoriHuruf->id],
            ['nama' => 'Latihan 3', 'kategori_id' => $kategoriHuruf->id],
            ['nama' => 'Latihan 4', 'kategori_id' => $kategoriHuruf->id],
            ['nama' => 'Latihan 5', 'kategori_id' => $kategoriHuruf->id],
            ['nama' => 'Latihan 6', 'kategori_id' => $kategoriHuruf->id],
            ['nama' => 'Latihan 7', 'kategori_id' => $kategoriHuruf->id],
            ['nama' => 'Latihan 8', 'kategori_id' => $kategoriHuruf->id],
            ['nama' => 'Latihan 9', 'kategori_id' => $kategoriHuruf->id],

            ['nama' => 'Latihan 1', 'kategori_id' => $kategoriKata->id],
            ['nama' => 'Latihan 2', 'kategori_id' => $kategoriKata->id],
            ['nama' => 'Latihan 3', 'kategori_id' => $kategoriKata->id],

            ['nama' => 'Latihan 1', 'kategori_id' => $kategoriRangkaian->id],
            ['nama' => 'Latihan 2', 'kategori_id' => $kategoriRangkaian->id],
            ['nama' => 'Latihan 3', 'kategori_id' => $kategoriRangkaian->id],
        ];

        foreach ($latihanList as $data) {
            Latihan::firstOrCreate([
                'nama' => $data['nama'],
                'kategori_id' => $data['kategori_id'],
            ]);
        }
    }
}
