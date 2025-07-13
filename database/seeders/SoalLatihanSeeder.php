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
            'Ghain','Fa','Qof','Kaf','Lam','Mim','Nun','Wawu','Ha_besar','Ya'
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
        #Base URL rawGitHub audio
        $githubRawAudio = 'https://raw.githubusercontent.com/ArmanShlhn/qolami-lughatech-be/refs/heads/main/public/audio';

        #Base URL rawGitHub gambar
        $githubRawBase = 'https://raw.githubusercontent.com/ArmanShlhn/qolami-lughatech-be/refs/heads/main/public/images';

        foreach ($harakatHuruf as $latihanNama => $harakat) {
            $latihan = Latihan::where('nama', $latihanNama)->first();
            if (!$latihan) continue;

            for ($i = 1; $i <= 28; $i++) {
                $hurufBenar = $hurufHijaiyah[$i - 1];
                $videoCode = $kodeYoutube[$harakat][$i - 1] ?? null;
                if (!$videoCode) continue;

                $videoUrl = "https://www.youtube.com/watch?v={$videoCode}";
                $audioUrl = "{$githubRawAudio}/huruf-{$harakat}/{$i}.{$harakat}_{$hurufBenar}.mp3";

                $opsiHuruf = collect($hurufHijaiyah)
                    ->filter(fn($h) => $h !== $hurufBenar)
                    ->shuffle()
                    ->take(3)
                    ->values();

                $opsiHuruf->push($hurufBenar);
                $opsiHuruf = $opsiHuruf->shuffle()->values();

                $opsiGambar = $opsiHuruf->map(function($hurufOpsi) use ($harakat, $hurufHijaiyah, $githubRawBase) {
                    $indexHuruf = array_search($hurufOpsi, $hurufHijaiyah) + 1; 
                    return "{$githubRawBase}/huruf-{$harakat}/{$indexHuruf}.{$harakat}_{$hurufOpsi}.png";
                });

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

$kataList = [
    'Fathah' => [
        ['kata' => "Akhodza", 'video' => "MELQimvxmkU"],
        ['kata' => "Bahatsa", 'video' => "vkX5v-6AVtE"],
        ['kata' => "Tsabata", 'video' => "Mlqm8_BIh4w"],
        ['kata' => "Jaala", 'video' => "jb2qK48obDA"],
        ['kata' => "Hasada", 'video' => "9iRV3nmW3b0"],
        ['kata' => "Khothoba", 'video' => "GV9VSMaJ6UM"],
        ['kata' => "Dabaro", 'video' => "GdVD31y5M24"],
        ['kata' => "Rohaqo", 'video' => "8kqwjcbB9kM"],
        ['kata' => "Sakana", 'video' => "SF2D69o040E"],
        ['kata' => "Syakaro", 'video' => "hlqMLl4goEA"],
        ['kata' => "Shodaqo", 'video' => "DZlcuteP-5c"],
        ['kata' => "Salatho", 'video' => "Z8zKZ0co9GI"],
        ['kata' => "Akasa", 'video' => "k18yrC-PdFc"],
        ['kata' => "Dzoharo", 'video' => "RO8jhk3oD70"],
        ['kata' => "Habatho", 'video' => "dP0qZt66ki4"],
        ['kata' => "Bashoro", 'video' => "RrFlTqIPTpA"],
        ['kata' => "Tsaqoba", 'video' => "7ymIr9tnvqo"],
        ['kata' => "Jahada", 'video' => "NWFlFcr4gWg"],
        ['kata' => "Rosala", 'video' => "yCAB01Fj_yg"],
        ['kata' => "Dzabaha", 'video' => "VNmT5PHbGxU"],
        ['kata' => "Sabaqo", 'video' => "6Qi5gCAZTfU"],
        ['kata' => "Rosyada", 'video' => "Jp_vPXm_I_c"],
        ['kata' => "Qoshoda", 'video' => "ADX-t56t8f8"],
        ['kata' => "Hadhoro", 'video' => "IO5uR8bwvO0"],
        ['kata' => "Dzhofaro", 'video' => "CKqeodgMjzk"],
        ['kata' => "Akafa", 'video' => "hsPB-06nyx8"],
        ['kata' => "Fashola", 'video' => "0K_2dtfeDZ8"],
        ['kata' => "Qoada", 'video' => "zOU8vo6P3pA"],
        ['kata' => "Kasyafa", 'video' => "8Muw1Kuh_IM"],
        ['kata' => "Hadama", 'video' => "_g9DaCLezwI"],
        ['kata' => "Badaa", 'video' => "ZLJ8uukc1Rc"],
        ['kata' => "Bathola", 'video' => "JrO4iImUhWM"],
        ['kata' => "Tsakhona", 'video' => "hENniU_oJ8s"],
        ['kata' => "Janaha", 'video' => "aj41n4IUNaU"],
        ['kata' => "Dakhola", 'video' => "v2JSoPbdUSQ"]
    ],
    'Kasroh' => [
        ['kata' => "Amina", 'video' => "iR4Io2LCa8w"],
        ['kata' => "Bariqo", 'video' => "rXi_UTGhYFc"],
        ['kata' => "Hamida", 'video' => "8xOfskN2fIc"],
        ['kata' => "Jazia", 'video' => "cn75-0NT6v0"],
        ['kata' => "Taiba", 'video' => "Ujxh9_rdf5g"],
        ['kata' => "Habitho", 'video' => "lksT09SxqfI"],
        ['kata' => "Khorisa", 'video' => "UPNvTVr0rvA"],
        ['kata' => "Rohima", 'video' => "1kcoFsW2yO0"],
        ['kata' => "Safiha", 'video' => "G4MvC1k0K7U"],
        ['kata' => "Syaniba", 'video' => "jpmbhGrcDJ0"],
        ['kata' => "Nadhija", 'video' => "gnaHcJpDv_U"],
        ['kata' => "Dzholima", 'video' => "nQd_luvqq7U"],
        ['kata' => "Laiba", 'video' => "uzPp5DWkUHE"],
        ['kata' => "Roghiba", 'video' => "sDrjvD-Pekw"],
        ['kata' => "Sahiro", 'video' => "PK74iLmYA5c"],
        ['kata' => "Atsima", 'video' => "3q6F28tUdbg"],
        ['kata' => "Tabia", 'video' => "8PuSCQ6HPk0"],
        ['kata' => "Bakhila", 'video' => "0fz5W9Ran4E"],
        ['kata' => "Hafidzho", 'video' => "K2w9P3TnilQ"],
        ['kata' => "Khojila", 'video' => "ceyfuAnKZi8"],
        ['kata' => "Robiha", 'video' => "34BbU62FcuY"],
        ['kata' => "Ajiza", 'video' => "0Xm-V9snvzk"],
        ['kata' => "Ghodhiba", 'video' => "m7frJLUMJD8"],
        ['kata' => "Alima", 'video' => "mrAUgLTjob0"],
        ['kata' => "Fariha", 'video' => "1hWqxzLXg7s"],
        ['kata' => "Nadima", 'video' => "FHnClbrifYw"],
        ['kata' => "Fasyila", 'video' => "QqjRleI3GVg"],
        ['kata' => "Haniqo", 'video' => "Rqaf6qEZdJQ"],
        ['kata' => "Waritsa", 'video' => "5IQMzN5EFcg"],
        ['kata' => "Syahiba", 'video' => "RCD6Kpojm9k"],
        ['kata' => "Watsiqo", 'video' => "TvgbkuK154U"],
        ['kata' => "Kariha", 'video' => "oXDU1kq4EUM"],
        ['kata' => "Lahiqo", 'video' => "PWxHut8nLHk"],
        ['kata' => "Ayina", 'video' => "nmeA1153hV4"],
        ['kata' => "Ahida", 'video' => "8h4j3yC4WG8"]
    ],
    'Dhommah' => [
        ['kata' => "Ukila", 'video' => "u6wEKllscqs"],
        ['kata' => "Buthila", 'video' => "2Bkrfsbi8YQ"],
        ['kata' => "Turika", 'video' => "ONDyjVT40Jw"],
        ['kata' => "Jabuna", 'video' => "HIFNUlAD8TI"],
        ['kata' => "Hasuna", 'video' => "6khAU4jc4aQ"],
        ['kata' => "Khosuna", 'video' => "ndmeodYQhMM"],
        ['kata' => "Sahula", 'video' => "OEqG_6mZyV0"],
        ['kata' => "Yakilu", 'video' => "ogZqCgZfiAc"],
        ['kata' => "Sholuha", 'video' => "tj2fE2Xdu9Y"],
        ['kata' => "Dhoufa", 'video' => "Z75pndsrMxY"],
        ['kata' => "Thuriha", 'video' => "3f3eKVnJUj0"],
        ['kata' => "Dufina", 'video' => "PV2TnRoQ1Nw"],
        ['kata' => "Taqou", 'video' => "s0g43uh6TaY"],
        ['kata' => "Adzhuma", 'video' => "7HoQyR9HfVU"],
        ['kata' => "Suriqo", 'video' => "0nFNINtDc9M"],
        ['kata' => "Bakhula", 'video' => "v6EChTF3uF4"],
        ['kata' => "Tsaqula", 'video' => "ntVl17rlFC8"],
        ['kata' => "Khuliqo", 'video' => "sibk4fjNWK4"],
        ['kata' => "Husyiro", 'video' => "GH1H04fvpQA"],
        ['kata' => "Dukhila", 'video' => "kZZIa5FauIc"],
        ['kata' => "Ruziqo", 'video' => "xWqGNNczdTU"],
        ['kata' => "Syarufa", 'video' => "g6HvDl4_6sQ"],
        ['kata' => "Adzuba", 'video' => "SR-v-R5_GwE"],
        ['kata' => "Kutiba", 'video' => "tyaALOZW1T0"],
        ['kata' => "Fakhuma", 'video' => "8hrf03cwKL4"],
        ['kata' => "Syauro", 'video' => "rrJ7s0EJKmI"],
        ['kata' => "Qubidho", 'video' => "IH2PhwyhR40"],
        ['kata' => "Wudhia", 'video' => "SbKQkd8RLWY"],
        ['kata' => "Gholudzo", 'video' => "8G068FeEXwQ"],
        ['kata' => "Huzima", 'video' => "TPXaV-gRusw"],
        ['kata' => "Thubikho", 'video' => "4IPX1mFyzsg"],
        ['kata' => "Khobutsa", 'video' => "lZB5cTAgC6E"],
        ['kata' => "Karuma", 'video' => "yG022-eLU6c"],
        ['kata' => "Yaidu", 'video' => "2Havir6VX6A"],
        ['kata' => "Qutila", 'video' => "P2VhD5Ckdnk"]
    ],        
];

        $latihanKataHarakat = [
            'Latihan Kata 1' => 'Fathah',
            'Latihan Kata 2' => 'Kasroh',
            'Latihan Kata 3' => 'Dhommah',
        ];

        $baseAudioUrl = 'https://raw.githubusercontent.com/ArmanShlhn/qolami-lughatech-be/refs/heads/main/public/audio';
        $baseImageUrl = 'https://raw.githubusercontent.com/ArmanShlhn/qolami-lughatech-be/refs/heads/main/public/images';

        foreach ($latihanKataHarakat as $latihanNama => $harakat) {
            $latihan = Latihan::where('nama', $latihanNama)->first();
            if (!$latihan || !isset($kataList[$harakat])) continue;

            foreach ($kataList[$harakat] as $index => $item) {
                $kataBenar = $item['kata'];
                $videoCode = $item['video'];

                $videoUrl = "https://www.youtube.com/watch?v={$videoCode}";
                $audioUrl = "$baseAudioUrl/kata-{$harakat}/" . ($index + 1) . ".{$harakat}_{$kataBenar}.mp3";

                $opsiKata = collect($kataList[$harakat])
                    ->pluck('kata')
                    ->filter(fn($k) => $k !== $kataBenar)
                    ->shuffle()
                    ->take(3)
                    ->push($kataBenar)
                    ->shuffle()
                    ->values();

                $opsiGambar = $opsiKata->map(function ($kataOpsi) use ($kataList, $harakat, $baseImageUrl) {
                    $indexOpsi = collect($kataList[$harakat])->pluck('kata')->search($kataOpsi) + 1;
                    return "$baseImageUrl/kata-{$harakat}/{$indexOpsi}.{$harakat}_{$kataOpsi}.png";
                });

                $jawabanIndex = $opsiKata->search($kataBenar);

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

    }
}

