<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Latihan;
use App\Models\SoalVideo;
use App\Models\SoalAudio;

class SoalLatihanSeeder extends Seeder
{
    public function run(){

    SoalVideo::truncate();
    SoalAudio::truncate();

    $hurufHijaiyah = ['Alif', 'Ba', 'Ta', 'Tsa', 'Jim', 'Ha', 'Kho', 'Dal', 'Dzal', 'Ra', 'Zay', 'Sin', 'Syin', 'Shod', 'Dhod', 'To', 'Dzo', 'Ain', 'Ghain', 'Fa', 'Qaf', 'Kaf', 'Lam', 'Mim', 'Nun', 'Waw', 'Ha', 'LamAlif', 'Hamzah', 'Ya'];

    $opsikata = ['Akhoza', 'Bahasya', 'Syabata', 'JaAla', 'HaSaDa', 'Khotoba', 'Dabaro', 'RoHaqo', 'SaKana', 'Syakaro', 'Shodaqo', 'Salato', 'Akasa', 'Dzoharo', 'Habato', 'Amina', 'Bariqa', 'Hamida', 'JadziA', 'TaIba', 'Habito', 'Khorisa', 'Rohima', 'safiha', 'syaniba', 'nadija', 'dzolima', 'laiba','roghiba' ,'sahiro' ,'uqila' ,'butila' ,'turiku' ,'jabuna' ,'hasuna' ,'khosyuna' ,'sahula' ,'yakilu' ,'sholuha' ,'dhoufa' ,'turiha' ,'dufina' ,'taqou' ,'adzuma' ,'suriqo'];

    #harakat untuk Latihan Huruf
    $harakatHuruf = [
        'Latihan Huruf 1' => null,
        'Latihan Huruf 2' => ' berkharakat fathah',
        'Latihan Huruf 3' => ' berkharakat kasrah',
        'Latihan Huruf 4' => ' berkharakat dhammah',
        'Latihan Huruf 5' => ' berkharakat fathahtain',
        'Latihan Huruf 6' => ' berkharakat kasrahtain',
        'Latihan Huruf 7' => ' berkharakat dhammahtain',
        'Latihan Huruf 8' => ' berkharakat sukun',
        'Latihan Huruf 9' => ' berkharakat tanwin',
    ];

    foreach ($harakatHuruf as $latihanNama => $harakat) {
        $latihan = Latihan::where('nama', $latihanNama)->first();
        if (!$latihan) continue;
    
        for ($i = 1; $i <= 28; $i++) {
            $opsi = collect($hurufHijaiyah)->shuffle()->take(4)->map(fn($item) => "$item.png")->values();
            $jawaban = $opsi->random();
    
            SoalVideo::create([
                'latihan_id' => $latihan->id,
                'video_url' => "http://example.com/video/{$latihan->id}_video_soal{$i}.mp4",
                'opsi_a' => $opsi[0], 'opsi_b' => $opsi[1], 'opsi_c' => $opsi[2], 'opsi_d' => $opsi[3],
                'jawaban' => $jawaban,
            ]);
    
            SoalAudio::create([
                'latihan_id' => $latihan->id,
                'audio_url' => "http://example.com/audio/{$latihan->id}_audio_soal{$i}.mp3",
                'opsi_a' => $opsi[0], 'opsi_b' => $opsi[1], 'opsi_c' => $opsi[2], 'opsi_d' => $opsi[3],
                'jawaban' => $jawaban,
            ]);
        }
    }

    #Latihan Kata
        $harakatKata = [
            'Latihan Kata 1' => 'fathah',
            'Latihan Kata 2' => 'kasrah',
            'Latihan Kata 3' => 'dhammah',
        ];

        foreach ($harakatKata as $latihanNama => $harakat) {
            $latihan = Latihan::where('nama', $latihanNama)->first();
            if (!$latihan) continue;

            for ($i = 1; $i <= 35; $i++) {
                $opsi = collect($opsikata)->shuffle()->take(4)->map(fn($item) => "$item.png")->values();
                $jawaban = $opsi->random();

                SoalVideo::create([
                    'latihan_id' => $latihan->id,
                    'video_url' => "http://example.com/video/{$latihan->id}_video_soal{$i}.mp4",
                    'opsi_a' => $opsi[0], 'opsi_b' => $opsi[1], 'opsi_c' => $opsi[2], 'opsi_d' => $opsi[3],
                    'jawaban' => $jawaban,
                ]);

                SoalAudio::create([
                    'latihan_id' => $latihan->id,
                    'audio_url' => "http://example.com/audio/{$latihan->id}_audio_soal{$i}.mp3",
                    'opsi_a' => $opsi[0], 'opsi_b' => $opsi[1], 'opsi_c' => $opsi[2], 'opsi_d' => $opsi[3],
                    'jawaban' => $jawaban,
                ]);
            }
        }
    }
}
