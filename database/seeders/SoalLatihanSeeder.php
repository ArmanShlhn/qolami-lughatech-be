<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Latihan;
use App\Models\SoalVideo;
use App\Models\SoalAudio;

class SoalLatihanSeeder extends Seeder
{
    public function run()
    {
        SoalVideo::truncate();
        SoalAudio::truncate();

        $hurufHijaiyah = [
        'Alif','Ba','Ta','Tsa','Jim','Ha','Kho','Dal','Dzal',
        'Ro','Zay','Sin','Syin','Shod','Dhod','Tho','Dzho','Ain',
        'Ghain','Fa','Qof','Kaf','Lam','Mim','Nun','Wawu','Ha besar','Ya'
        ];

        #Helper untuk membentuk path
        $url = function ($kategori, $harakat, $tipe, $filename) {
            $harakatFolder = $harakat ? strtolower($harakat) : 'default';
            return url("storage/app/public/pelajaran/{$kategori}/{$harakatFolder}/{$tipe}/{$filename}");
        };

        $harakatHuruf = [
            'Latihan Huruf 2' => 'fathah',
            'Latihan Huruf 3' => 'kasroh',
            'Latihan Huruf 4' => 'dhommah',
            'Latihan Huruf 5' => 'fathahtain',
            'Latihan Huruf 6' => 'kasrotain',
            'Latihan Huruf 7' => 'dhommahtain',
        ];

        foreach ($harakatHuruf as $latihanNama => $harakat) {
            $latihan = Latihan::where('nama', $latihanNama)->first();
            if (!$latihan) continue;

            for ($i = 1; $i <= 28; $i++) {
                $huruf = $hurufHijaiyah[$i - 1];
                $filenameBase = "{$i}.{$harakat}_{$huruf}";

                $videoUrl = $url('huruf', $harakat, 'video', "{$filenameBase}.mp4");
                $audioUrl = $url('huruf', $harakat, 'audio', "{$filenameBase}.mp3");

                $opsi = collect($hurufHijaiyah)->shuffle()->take(4)->values();
                $opsiPath = $opsi->map(fn($h) => $url('huruf', $harakat, 'gambar', "{$h}.png"));
                $jawaban = $opsiPath->random();

                SoalVideo::create([
                    'latihan_id' => $latihan->id,
                    'video_url' => $videoUrl,
                    'opsi_a' => $opsiPath[0],
                    'opsi_b' => $opsiPath[1],
                    'opsi_c' => $opsiPath[2],
                    'opsi_d' => $opsiPath[3],
                    'jawaban' => $jawaban,
                ]);

                SoalAudio::create([
                    'latihan_id' => $latihan->id,
                    'audio_url' => $audioUrl,
                    'opsi_a' => $opsiPath[0],
                    'opsi_b' => $opsiPath[1],
                    'opsi_c' => $opsiPath[2],
                    'opsi_d' => $opsiPath[3],
                    'jawaban' => $jawaban,
                ]);
            }
        }

        #Latihan Kata
        $opsikata = [
            'Akhoza', 'Bahasya', 'Syabata', 'JaAla', 'HaSaDa', 'Khotoba', 'Dabaro', 'RoHaqo',
            'SaKana', 'Syakaro', 'Shodaqo', 'Salato', 'Akasa', 'Dzoharo', 'Habato', 'Amina',
            'Bariqa', 'Hamida', 'JadziA', 'TaIba', 'Habito', 'Khorisa', 'Rohima', 'safiha',
            'syaniba', 'nadija', 'dzolima', 'laiba', 'roghiba', 'sahiro', 'uqila', 'butila',
            'turiku', 'jabuna', 'hasuna', 'khosyuna', 'sahula', 'yakilu', 'sholuha', 'dhoufa',
            'turiha', 'dufina', 'taqou', 'adzuma', 'suriqo'
        ];

        $harakatKata = [
            'Latihan Kata 1' => 'fathah',
            'Latihan Kata 2' => 'kasroh',
            'Latihan Kata 3' => 'dhommah',
        ];

        foreach ($harakatKata as $latihanNama => $harakat) {
            $latihan = Latihan::where('nama', $latihanNama)->first();
            if (!$latihan) continue;

            for ($i = 1; $i <= 35; $i++) {
                $filenameBase = "{$i}.{$harakat}";

                $videoUrl = $url('kata', $harakat, 'video', "{$filenameBase}.mp4");
                $audioUrl = $url('kata', $harakat, 'audio', "{$filenameBase}.mp3");

                $opsi = collect($opsikata)->shuffle()->take(4)->values();
                $opsiPath = $opsi->map(fn($k) => $url('kata', $harakat, 'gambar', "{$k}.png"));
                $jawaban = $opsiPath->random();

                SoalVideo::create([
                    'latihan_id' => $latihan->id,
                    'video_url' => $videoUrl,
                    'opsi_a' => $opsiPath[0],
                    'opsi_b' => $opsiPath[1],
                    'opsi_c' => $opsiPath[2],
                    'opsi_d' => $opsiPath[3],
                    'jawaban' => $jawaban,
                ]);

                SoalAudio::create([
                    'latihan_id' => $latihan->id,
                    'audio_url' => $audioUrl,
                    'opsi_a' => $opsiPath[0],
                    'opsi_b' => $opsiPath[1],
                    'opsi_c' => $opsiPath[2],
                    'opsi_d' => $opsiPath[3],
                    'jawaban' => $jawaban,
                ]);
            }
        }
    }
}
