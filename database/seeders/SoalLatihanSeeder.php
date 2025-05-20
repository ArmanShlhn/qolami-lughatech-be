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
            'Alif', 'Ba', 'Ta', 'Tsa', 'Jim', 'Ha', 'Kho', 'Dal', 'Dzal', 'Ra', 'Zay', 'Sin', 'Syin',
            'Shod', 'Dhod', 'To', 'Dzo', 'Ain', 'Ghain', 'Fa', 'Qaf', 'Kaf', 'Lam', 'Mim', 'Nun',
            'Waw', 'Ha', 'LamAlif', 'Hamzah', 'Ya'
        ];

        // Helper untuk membentuk path
        $url = function ($kategori, $harakat, $tipe, $filename) {
            $harakatFolder = $harakat ? strtolower($harakat) : 'default';
            return "pelajaran/{$kategori}/{$harakatFolder}/{$tipe}/{$filename}";
        };

        $harakatHuruf = [
            'Latihan Huruf 1' => null,
            'Latihan Huruf 2' => 'fathah',
            'Latihan Huruf 3' => 'kasrah',
            'Latihan Huruf 4' => 'dhammah',
            'Latihan Huruf 5' => 'fathahtain',
            'Latihan Huruf 6' => 'kasrahtain',
            'Latihan Huruf 7' => 'dhammahtain',
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

        // Latihan Kata
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
            'Latihan Kata 2' => 'kasrah',
            'Latihan Kata 3' => 'dhammah',
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
