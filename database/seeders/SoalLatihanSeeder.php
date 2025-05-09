<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Latihan;
use App\Models\SoalVideo;
use App\Models\SoalAudio;
use Illuminate\Support\Facades\DB;

class SoalLatihanSeeder extends Seeder
{
    public function run()
    {
        #mengosongkan tabel sebelum di inputkan data baru
        SoalVideo::truncate();
        SoalAudio::truncate();

        $hurufHijaiyah = ['Alif', 'Ba', 'Ta', 'Tsa', 'Jim', 'Ha', 'Kho', 'Dal', 'Dzal', 'Ra', 'Zay', 'Sin', 'Syin', 'Shod', 'Dhod', 'To', 'Dzo', 'Ain', 'Ghain', 'Fa', 'Qaf', 'Kaf', 'Lam', 'Mim', 'Nun', 'Waw', 'Ha','LamAlif', 'Hamzah','Ya'];

        $kataOptions = ['Akhoza', 'Bahasya', 'Syabata', 'JaAla', 'HaSaDa', 'Khotoba', 'Dabaro', 'RoHaqo', 'SaKana', 'Syakaro', 'Shodaqo', 'Salato', 'Akasa', 'Dzoharo', 'Habato', 'Amina', 'Bariqa', 'Hamida', 'JadziA', 'TaIba', 'Habito', 'Khorisa', 'Rohima', 'safiha', 'syaniba', 'nadija', 'dzolima', 'laiba','roghiba' ,'sahiro' ,'uqila' ,'butila' ,'turiku' ,'jabuna' ,'hasuna' ,'khosyuna' ,'sahula' ,'yakilu' ,'sholuha' ,'dhoufa' ,'turiha' ,'dufina' ,'taqou' ,'adzuma' ,'suriqo'];

        #array data seeder nama latihan Huruf (sesuai dengan LatihanSeeder)
        $latihanHurufNames = [
            'Latihan 1 - Huruf Hijaiyah',
            'Latihan 2 - Huruf Berharakat Fathah', 
            'Latihan 3 - Huruf Berharakat Kasrah', 
            'Latihan 4 - Huruf Berharakat Dhammah', 
            'Latihan 5 - Huruf Berharakat Fathahtain',
            'Latihan 6 - Huruf Berharakat Kasrahtain', 
            'Latihan 7 - Huruf Berharakat Dhammahtain',
        ];

        foreach ($latihanHurufNames as $index => $latihanNama) {
            $latihan = Latihan::where('nama', $latihanNama)->first();
            if (!$latihan) continue;

            for ($i = 1; $i <= 35; $i++) {
                $opsi = collect($hurufHijaiyah)->shuffle()->take(4)->map(fn($item) => "$item.png")->values();
                $jawaban = $opsi->random();

                SoalVideo::create([
                    'latihan_id' => $latihan->id,
                    'soal' => "Soal video ke-$i untuk {$latihan->nama}",
                    'video_url' => "http://example.com/video/{$latihan->id}_video_soal{$i}.mp4",
                    'opsi_a' => $opsi[0], 'opsi_b' => $opsi[1], 'opsi_c' => $opsi[2], 'opsi_d' => $opsi[3],
                    'jawaban' => $jawaban,
                ]);

                SoalAudio::create([
                    'latihan_id' => $latihan->id,
                    'soal' => "Soal audio ke-$i untuk {$latihan->nama}",
                    'audio_url' => "http://example.com/audio/{$latihan->id}_audio_soal{$i}.mp3",
                    'opsi_a' => $opsi[0], 'opsi_b' => $opsi[1], 'opsi_c' => $opsi[2], 'opsi_d' => $opsi[3],
                    'jawaban' => $jawaban,
                ]);
            }
        }

        #array data seeder nama latihan Kata (sesuai LatihanSeeder)
        $latihanKataNames = [
            'Latihan 1 - Kata Berakhiran Fathah', 
            'Latihan 2 - Kata Berakhiran Kasrah', 
            'Latihan 3 - Kata Berakhiran Dhammah'
        ];

        foreach ($latihanKataNames as $latihanNama) {
            $latihan = Latihan::where('nama', $latihanNama)->first();
            if (!$latihan) continue;

            for ($i = 1; $i <= 35; $i++) {
                $opsi = collect($kataOptions)->shuffle()->take(4)->map(fn($item) => "$item.png")->values();
                $jawaban = $opsi->random();

                SoalVideo::create([
                    'latihan_id' => $latihan->id,
                    'soal' => "Soal video ke-$i untuk {$latihan->nama}",
                    'video_url' => "http://example.com/video/{$latihan->id}_video_soal{$i}.mp4",
                    'opsi_a' => $opsi[0], 'opsi_b' => $opsi[1], 'opsi_c' => $opsi[2], 'opsi_d' => $opsi[3],
                    'jawaban' => $jawaban,
                ]);

                SoalAudio::create([
                    'latihan_id' => $latihan->id,
                    'soal' => "Soal audio ke-$i untuk {$latihan->nama}",
                    'audio_url' => "http://example.com/audio/{$latihan->id}_audio_soal{$i}.mp3",
                    'opsi_a' => $opsi[0], 'opsi_b' => $opsi[1], 'opsi_c' => $opsi[2], 'opsi_d' => $opsi[3],
                    'jawaban' => $jawaban,
                ]);
            }
        }
    }
}
