<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Latihan;
use App\Models\SoalGambar;
use App\Models\SoalVideo;
use App\Models\SoalAudio;
use App\Models\Kategori;

class SoalLatihanSeeder extends Seeder
{
    public function run()
    {
        #Relasi kategori dengan soal latihan
        $kategoriHuruf = Kategori::firstOrCreate(['id' => 1], ['nama' => 'Huruf']);
        $kategoriKata = Kategori::firstOrCreate(['id' => 2], ['nama' => 'Kata']);
        $kategoriRangkaian = Kategori::firstOrCreate(['id' => 3], ['nama' => 'Rangkaian']);

        $hurufHijaiyah = [
            'Alif', 'Ba', 'Ta', 'Tsa', 'Jim', 'Ha', 'Kho', 'Dal', 'Dzal',
            'Ra', 'Zai', 'Sin', 'Syin', 'Shad', 'Dhad', 'Tha', 'Zha', 'Ain',
            'Ghain', 'Fa', 'Qaf', 'Kaf', 'Lam', 'Mim', 'Nun', 'Wau', 'Ha', 'Ya'
        ];

        $kataOptions = ['Buku', 'Kita', 'Nur', 'Huda', 'Quran', 'Salam', 'Waktu', 'Iman'];
        $rangkaianOptions = ['AlifBa', 'BaTa', 'JimHa', 'DalRa', 'LamMim', 'NunYa'];

        #Latihan Huruf (1 - 9)
        for ($latihanId = 1; $latihanId <= 9; $latihanId++) {
            $kategori = $kategoriHuruf;
            $sumber = $hurufHijaiyah;

            $latihan = Latihan::firstOrCreate([
                'nama' => "Latihan $latihanId",
                'kategori_id' => $kategori->id,
            ]);

            for ($i = 1; $i <= 10; $i++) {
                $opsi = collect($sumber)->shuffle()->take(4)->map(fn($item) => "$item.png")->values();
                $jawaban = $opsi->random();

                #data seeder (dummy) soal gambar
                SoalGambar::create([
                    'latihan_id' => $latihan->id,
                    'soal' => "Soal gambar ke-$i untuk Latihan $latihanId",
                    'gambar_url' => "http://example.com/gambar/latihan{$latihanId}_gambar_soal{$i}.jpg",
                    'opsi_a' => $opsi[0], 'opsi_b' => $opsi[1], 'opsi_c' => $opsi[2], 'opsi_d' => $opsi[3],
                    'jawaban' => $jawaban,
                ]);

                #data seeder (dummy) soal vidao
                SoalVideo::create([
                    'latihan_id' => $latihan->id,
                    'soal' => "Soal video ke-$i untuk Latihan $latihanId",
                    'video_url' => "http://example.com/video/latihan{$latihanId}_video_soal{$i}.mp4",
                    'opsi_a' => $opsi[0], 'opsi_b' => $opsi[1], 'opsi_c' => $opsi[2], 'opsi_d' => $opsi[3],
                    'jawaban' => $jawaban,
                ]);

                #data seeder (dummy) soal audio
                SoalAudio::create([
                    'latihan_id' => $latihan->id,
                    'soal' => "Soal audio ke-$i untuk Latihan $latihanId",
                    'audio_url' => "http://example.com/audio/latihan{$latihanId}_audio_soal{$i}.mp3",
                    'opsi_a' => $opsi[0], 'opsi_b' => $opsi[1], 'opsi_c' => $opsi[2], 'opsi_d' => $opsi[3],
                    'jawaban' => $jawaban,
                ]);
            }
        }

        #Latihan Kata dan Rangkaian (1 - 3)
        foreach ([
            ['kategori' => $kategoriKata, 'sumber' => $kataOptions],
            ['kategori' => $kategoriRangkaian, 'sumber' => $rangkaianOptions],
        ] as $item) {
            for ($latihanId = 1; $latihanId <= 3; $latihanId++) {
                $kategori = $item['kategori'];
                $sumber = $item['sumber'];

                $latihan = Latihan::firstOrCreate([
                    'nama' => "Latihan $latihanId",
                    'kategori_id' => $kategori->id,
                ]);

                for ($i = 1; $i <= 10; $i++) {
                    $opsi = collect($sumber)->shuffle()->take(4)->map(fn($item) => "$item.png")->values();
                    $jawaban = $opsi->random();

                    #data seeder (dummy) soal gambar
                    SoalGambar::create([
                        'latihan_id' => $latihan->id,
                        'soal' => "Soal gambar ke-$i untuk Latihan $latihanId",
                        'gambar_url' => "http://example.com/gambar/latihan{$latihanId}_gambar_soal{$i}.jpg",
                        'opsi_a' => $opsi[0], 'opsi_b' => $opsi[1], 'opsi_c' => $opsi[2], 'opsi_d' => $opsi[3],
                        'jawaban' => $jawaban,
                    ]);

                    #data seeder (dummy) soal video
                    SoalVideo::create([
                        'latihan_id' => $latihan->id,
                        'soal' => "Soal video ke-$i untuk Latihan $latihanId",
                        'video_url' => "http://example.com/video/latihan{$latihanId}_video_soal{$i}.mp4",
                        'opsi_a' => $opsi[0], 'opsi_b' => $opsi[1], 'opsi_c' => $opsi[2], 'opsi_d' => $opsi[3],
                        'jawaban' => $jawaban,
                    ]);

                    #data seeder (dummy) soal audio
                    SoalAudio::create([
                        'latihan_id' => $latihan->id,
                        'soal' => "Soal audio ke-$i untuk Latihan $latihanId",
                        'audio_url' => "http://example.com/audio/latihan{$latihanId}_audio_soal{$i}.mp3",
                        'opsi_a' => $opsi[0], 'opsi_b' => $opsi[1], 'opsi_c' => $opsi[2], 'opsi_d' => $opsi[3],
                        'jawaban' => $jawaban,
                    ]);
                }
            }
        }
    }
}
