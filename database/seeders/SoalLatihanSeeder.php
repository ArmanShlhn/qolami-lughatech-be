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

        #Mapping kode YouTube per harakat
        $kodeYoutube = [
            'Fathah'      => ['ZWVKzD0Jqak','gj_Gq8-FVK8','fq7N2dYyyR0','leDOqAntr50',
                            '9NKNevVpDoc','9pUcEaAZYsQ','cj7sRM3eu-w','vaDFivGpbEg',
                            'z5LsF9yKJ68','j96jfnm40Mg','va9YaTSB36o','1_OUylBiZ7A',
                            'szd9W5iYBgA','oSwJ7oxJmlY','IiNLsVub7wk','9ph2NRlqQzw',
                            'OOfBE7MXFGw','YXcXcuPQ6mA','fKkIhqHdz8k','HByY4ofzAEI',
                            'B_GumZPWXHo','rJ4E17ZWHho','hB2kAS3DDG4','MOF5ly2_9Vw',
                            'byEs2u-Fhs0','6OkfRbmyvwk','C4JOtEeFxcE','a6gT5aHGTUw'],
                            
            'Kasroh'      => ['aFHTSWXb7Ao', 'YOUEqo50fpE', 'ym7dRYcLF3c', 'mwGSjIypTtU',
                            'FNhs68v2Fss', 'a0O0LUTpviU', 't6P1GiWPxZg', 'zH2Id40NYe0',
                            '9PLQoJa9Na4', 'ghJ2Q5kyx8o', 'jcBhpBQA3Ek', 'yA6-lxjnDqo',
                            'fbhAJlNuljk', 'FrbUZ6NWcFU', 'Lt6_c-2u74U', 'PD49yH504QY',
                            'cYzJzD-vgwc', 'CXjX0OW0LxU', 'kmCOGCbm4UI', 'aS89eTkjijc',
                            'lEUgoTqtbR0', '-dwP0SepzY4', 'VRRQ9aJ2EAM', 'FCzIBVixDqo',
                            'RVDnwN8795I', 'tP5e4wEQRvs', '-kB68BmGNyE', 'NDbsB0C5zyQ'],

            'Dhommah'     => ['pw7YIq4M6wI', 'U9-u1kfJ5zc', 'irglmdv_Bn4', 'tBpXpOKEZio',
                            'tK7jwJhhjtw', 'LhuR70AC_9M', 'CIM0yXbjbow', 'twFhtmXNk5o',
                            'm617coi4TuM', 'A1HKy1fMcU0', 'LRGOxiOyQbs', 'R04_o9EMrgg',
                            'nwISmAsu-RI', 'FSzlKhq46mI', '-CCux7USWxo', 'mzZtTYhCKk0',
                            'QVweJ6eV91w', 'sROVmD7HEhw', '4w8B3RR4h-s', 'vIhYL216k0I',
                            'tdNYNCyc6d8', 'J3vBKN7FJL8', 'KMB0V5mI2zQ', '4D1Yu2Vm2js',
                            'nCy0n19w6Pw', '8FfFzLwCtS0', 'brjWNBg6qw0', '0Y58zr9Cjxc'],
            
            'Fathahtain'  => ['m6jE4M6v514', 'CmjiAQ2bB00', 'a3Fd-DBC8V0', 'XTSkFoWHUlQ',
                            'HQDI6KN5C4I', 'oNJPzQ1475k', 'PqqN25lhbg8', '5WVZdEBb1a0',
                            'zHtrkRQvhtc', 'uvDX3LXW1XI', 'PnGN6ubNxZk', 'prGjjnXko3g',
                            'ySI5rCDun34', 'ixt3zlJq96s', 'SxICLpm_taY', 'X1mfud8Q2Bg',
                            'wnDQFU4CxRM', 'yRuwMNfoJB0', 'eEiC2taG-sw', '7oUTJ8wAxQk',
                            'NLdfMzW1LKk', 'JNRMdXYeJ44', 'irl-NfoCC9E', 'hToSD2nwMGc',
                            'ek5NxiUQi28', 'kNMV7aOBn1Q', 'm8cji03gmzc', 'Z8fnAbN0Vpk',],

            'Kasrotain'   => ['A0gJOFiXLgM', '2abng5qbUl0', 'GyIsCCJXsRI', 'rEYrisQKMXQ',
                            'Wo32Dvaqny4', 'Cj6FTpl-8Yk', 'CiLoiCLoNMw', 'rkOen3u3Z1I',
                            'VUSUjW_Wqks', 'dNdeBh6eb3E', 'zM5hhIwYKnE', 'AvwqggZKflc',
                            'vJ-6LpbADEI', 'wFfHg90IShQ', 'o3IJYbMpaYo', 'PCUDkb6Lk6k',
                            'jZ6XTr10vPU', 'TsJeuU11hN4', 'cClQ9M_pEps', 'PdVqCndjf5w',
                            'HRhfWMaJBac', 'EDILzRQTJak', 'y9BLkkSIa2o', 'RNIBpDz_rGc',
                            'NInrR6OiYHs', 'VB6yE9VsbVo', 'reFdrDc3NSk', '/jVDHTCM3JUw',],

            'Dhommahtain' => ['W_Zcwu1Tcso', '9lSHVApfHqI', 'Unavx5nUP-A', 'LFHOw4uUfcs',
                            'mHV2EK50h-E', 'XWksThX6loc', 'bHAL36gbKr4', 'ZTM622uwrFE',
                            'X0TWE7MUzSo', 'cJs41prvdpo', 'hffTX8ugO2s', '4Wf3dqf70sg',
                            '9xOTf1ZsncQ', 'jvV5CBMde7w', '171-yRZgDNc', 'fgbYWym97YM',
                            '-DfTk1aoWWc', 'rYjbUSddsyI', 'CmV8AUnuZsY', '1NckOm86jCI',
                            'LtyX7fUFpig', '37jblIJ82vU', 'rzHpMgVoxZ0', 'GJi_O0Hg7xI',
                            'FHoNYrAIUDg', 'gVLQ1BoG2_Y', 'g98wnOcCiS4', 'Ohvd0loE764',]];

        $harakatHuruf = [
            'Latihan Huruf 1' => 'Fathah',
            'Latihan Huruf 2' => 'Kasroh',
            'Latihan Huruf 3' => 'Dhommah',
            'Latihan Huruf 4' => 'Fathahtain',
            'Latihan Huruf 5' => 'Kasrotain',
            'Latihan Huruf 6' => 'Dhommahtain',
        ];
        #Base URL raw GitHub untuk file audio huruf (mp3)
        $githubRawAudio = 'https://raw.githubusercontent.com/ArmanShlhn/qolami-lughatech-be/main/public/audio';

        #Base URL raw GitHub untuk gambar huruf hijaiyah
        $githubRawBase = 'https://raw.githubusercontent.com/ArmanShlhn/qolami-lughatech-be/main/public/images';

        foreach ($harakatHuruf as $latihanNama => $harakat) {
            $latihan = Latihan::where('nama', $latihanNama)->first();
            if (!$latihan) continue;

            for ($i = 1; $i <= 28; $i++) {
                $hurufBenar = $hurufHijaiyah[$i - 1];
                $videoCode = $kodeYoutube[$harakat][$i - 1] ?? null;
                if (!$videoCode) continue;

                $videoUrl = "https://www.youtube.com/watch?v={$videoCode}";
                $audioUrl = "{$githubRawAudio}/huruf-{$harakat}/{$i}.{$harakat}_{$hurufBenar}.mp3";

                #Ambil 3 huruf lain secara acak, berbeda dengan huruf benar
                $opsiHuruf = collect($hurufHijaiyah)
                    ->filter(fn($h) => $h !== $hurufBenar)
                    ->shuffle()
                    ->take(3)
                    ->values();

                #Tambahkan huruf benar ke opsi, lalu acak posisi opsi
                $opsiHuruf->push($hurufBenar);
                $opsiHuruf = $opsiHuruf->shuffle()->values();

                #cari index huruf opsi di hurufHijaiyah agar bisa pasang nomor gambar benar
                $opsiGambar = $opsiHuruf->map(function($hurufOpsi) use ($harakat, $hurufHijaiyah, $githubRawBase) {
                    $indexHuruf = array_search($hurufOpsi, $hurufHijaiyah) + 1; #+1 karena indeks gambar mulai 1
                    return "{$githubRawBase}/huruf-{$harakat}/{$indexHuruf}.{$harakat}_{$hurufOpsi}.png";
                });

                #Cari posisi jawaban benar (hurufBenar)
                $jawabanIndex = $opsiHuruf->search($hurufBenar);

                SoalVideo::create([
                    'latihan_id' => $latihan->id,
                    'video_url' => $videoUrl,
                    'opsi_a' => $opsiGambar[0],
                    'opsi_b' => $opsiGambar[1],
                    'opsi_c' => $opsiGambar[2],
                    'opsi_d' => $opsiGambar[3],
                    'jawaban' => $opsiGambar[$jawabanIndex],
                ]);

                SoalAudio::create([
                    'latihan_id' => $latihan->id,
                    'audio_url' => $audioUrl,
                    'opsi_a' => $opsiGambar[0],
                    'opsi_b' => $opsiGambar[1],
                    'opsi_c' => $opsiGambar[2],
                    'opsi_d' => $opsiGambar[3],
                    'jawaban' => $opsiGambar[$jawabanIndex],
                ]);
            }
        }

# Latihan Kata
$kataList = [
    'Akhoza', 'Bahasya', 'Syabata', 'JaAla', 'HaSaDa', 'Khotoba', 'Dabaro', 'RoHaqo',
    'SaKana', 'Syakaro', 'Shodaqo', 'Salato', 'Akasa', 'Dzoharo', 'Habato', 'Amina',
    'Bariqa', 'Hamida', 'JadziA', 'TaIba', 'Habito', 'Khorisa', 'Rohima', 'safiha',
    'syaniba', 'nadija', 'dzolima', 'laiba', 'roghiba', 'sahiro', 'uqila', 'butila',
    'turiku', 'jabuna', 'hasuna', 'khosyuna', 'sahula', 'yakilu', 'sholuha', 'dhoufa',
    'turiha', 'dufina', 'taqou', 'adzuma', 'suriqo'
];

$harakatKata = [
    'Latihan Kata 1' => 'Fathah',
    'Latihan Huruf 1' => 'Fathah',
    'Latihan Huruf 2' => 'Kasroh',
    'Latihan Huruf 3' => 'Dhommah',
];

foreach ($harakatKata as $latihanNama => $harakat) {
    $latihan = Latihan::where('nama', $latihanNama)->first();
    if (!$latihan) continue;

    for ($i = 0; $i < count($kataList); $i++) {
        $kata = $kataList[$i];

        $videoCode = $kodeYoutube[$harakat][$i] ?? null;
        if (!$videoCode) continue;

        $videoUrl = "https://www.youtube.com/watch?v={$videoCode}";
        $audioUrl = "{$githubRawAudio}/kata-{$harakat}/" . ($i + 1) . ".{$harakat}_{$kata}.mp3";

        #Acak opsi dan pastikan jawaban termasuk di antara mereka
        $opsiKata = collect($kataList)
            ->reject(fn($k) => $k === $kata)
            ->shuffle()
            ->take(3)
            ->push($kata)
            ->shuffle()
            ->values();

        #Bangun opsi gambar berdasarkan urutan opsi
        $opsiPath = $opsiKata->map(function ($k) use ($kataList, $harakat, $githubRawBase) {
            $index = array_search($k, $kataList);
            $nomor = $index + 1;
            return "{$githubRawBase}/kata-{$harakat}/{$nomor}.{$harakat}_{$k}.png";
        });


        #Tentukan jawaban dari kata asli
        $jawabanIndex = $opsiKata->search($kata);
        $jawaban = $opsiPath[$jawabanIndex];

        #Simpan ke soal video
        SoalVideo::create([
            'latihan_id' => $latihan->id,
            'video_url' => $videoUrl,
            'opsi_a' => $opsiPath[0],
            'opsi_b' => $opsiPath[1],
            'opsi_c' => $opsiPath[2],
            'opsi_d' => $opsiPath[3],
            'jawaban' => $jawaban,
        ]);

        #Simpan ke soal audio
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
