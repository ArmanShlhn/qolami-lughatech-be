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
                    $indexHuruf = array_search($hurufOpsi, $hurufHijaiyah) + 1; #+1 karena indeks gambar mulai 1
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
                "Akhodza","Bahatsa","Tsabata","Jaala","Hasada","Khothoba","Dabaro",
                "Rohaqo","Sakana","Syakaro","Shodaqo","Salatho","Akasa","Dzoharo",
                "Habatho","Bashoro","Tsaqoba","Jahada","Rosala","Dzabaha","Sabaqo",
                "Rosyada","Qoshoda","Hadhoro","Dzhofaro","Akafa","Fashola","Qoada",
                "Kasyafa","Hadama","Badaa","Bathola","Tsakhona","Janaha","Dakhola"
            ],
            'Kasroh' => [
                "Amina","Bariqo","Hamida","Jazia","Taiba","Habitho","Khorisa",
                "Rohima","Safiha","Syaniba","Nadhija","Dzholima","Laiba","Roghiba",
                "Sahiro","Atsima","Tabia","Bakhila","Hafidzho","Khojila","Robiha",
                "Ajiza","Ghodhiba","Alima","Fariha","Nadima","Fasyila","Haniqo",
                "Waritsa","Syahiba","Watsiqo","Kariha","Lahiqo","Ayina","Ahida"
            ],
            'Dhommah' => [
                "Ukila","Buthila","Turika","Jabuna","Hasuna","Khosuna","Sahula",
                "Yakilu","Sholuha","Dhoufa","Thuriha","Dufina","Taqou","Adzhuma",
                "Suriqo","Bakhula","Tsaqula","Khuliqo","Husyiro","Dukhila","Ruziqo",
                "Syarufa","Adzuba","Kutiba","Fakhuma","Syauro","Qubidho","Wudhia",
                "Gholudzo","Huzima","Thubikho","Khobutsa","Karuma","Yaidu","Qutila"
            ]
        ];

        $kodeYoutubeKata = [
            'Fathah' => ["MELQimvxmkU", "vkX5v-6AVtE", "Mlqm8_BIh4w", "jb2qK48obDA", "9iRV3nmW3b0",
                        "GV9VSMaJ6UM", "GdVD31y5M24", "8kqwjcbB9kM", "SF2D69o040E", "hlqMLl4goEA",
                        "DZlcuteP-5c", "Z8zKZ0co9GI", "k18yrC-PdFc", "RO8jhk3oD70", "dP0qZt66ki4",
                        "RrFlTqIPTpA", "7ymIr9tnvqo", "NWFlFcr4gWg", "yCAB01Fj_yg", "VNmT5PHbGxU",
                        "6Qi5gCAZTfU", "Jp_vPXm_I_c", "ADX-t56t8f8", "IO5uR8bwvO0", "CKqeodgMjzk",
                        "hsPB-06nyx8", "0K_2dtfeDZ8", "zOU8vo6P3pA", "8Muw1Kuh_IM", "_g9DaCLezwI",
                        "ZLJ8uukc1Rc", "JrO4iImUhWM", "hENniU_oJ8s", "aj41n4IUNaU", "v2JSoPbdUSQ"
            ],
            'Kasroh' => ["3nDG3m3bQ0Y", "iR4Io2LCa8w", "rXi_UTGhYFc", "8xOfskN2fIc", "cn75-0NT6v0",
                        "Ujxh9_rdf5g", "lksT09SxqfI", "UPNvTVr0rvA", "1kcoFsW2yO0", "G4MvC1k0K7U",
                        "jpmbhGrcDJ0", "gnaHcJpDv_U", "nQd_luvqq7U", "uzPp5DWkUHE", "sDrjvD-Pekw",
                        "PK74iLmYA5c", "3q6F28tUdbg", "K2w9P3TnilQ", "ceyfuAnKZi8", "34BbU62FcuY",
                        "eezbfV7YYdY", "0Xm-V9snvzk", "m7frJLUMJD8", "mrAUgLTjob0", "1hWqxzLXg7s",
                        "FHnClbrifYw", "QqjRleI3GVg", "Rqaf6qEZdJQ", "5IQMzN5EFcg", "RCD6Kpojm9k",
                        "TvgbkuK154U", "oXDU1kq4EUM", "PWxHut8nLHk", "nmeA1153hV4", "8h4j3yC4WG8"
            ],
            'Dhommah' => ["u6wEKllscqs", "2Bkrfsbi8YQ", "ONDyjVT40Jw", "HIFNUlAD8TI", "6khAU4jc4aQ",
                        "ndmeodYQhMM", "OEqG_6mZyV0", "ogZqCgZfiAc", "tj2fE2Xdu9Y", "Z75pndsrMxY",
                        "3f3eKVnJUj0", "PV2TnRoQ1Nw", "s0g43uh6TaY", "7HoQyR9HfVU", "0nFNINtDc9M",
                        "v6EChTF3uF4", "ntVl17rlFC8", "sibk4fjNWK4", "GH1H04fvpQA", "kZZIa5FauIc",
                        "xWqGNNczdTU", "g6HvDl4_6sQ", "SR-v-R5_GwE", "tyaALOZW1T0", "8hrf03cwKL4",
                        "rrJ7s0EJKmI", "IH2PhwyhR40", "SbKQkd8RLWY", "8G068FeEXwQ", "TPXaV-gRusw",
                        "4IPX1mFyzsg", "lZB5cTAgC6E", "yG022-eLU6c", "2Havir6VX6A", "P2VhD5Ckdnk"
            ],
        ];

        $githubRawAudioKata = 'https://raw.githubusercontent.com/ArmanShlhn/qolami-lughatech-be/refs/heads/main/public/audio';
        $githubRawBaseKata = 'https://raw.githubusercontent.com/ArmanShlhn/qolami-lughatech-be/refs/heads/main/public/images';

        #Map latihan kata per harakat
        $latihanKataHarakat = [
            'Latihan Kata 1' => 'Fathah',
            'Latihan Kata 2' => 'Kasroh',
            'Latihan Kata 3' => 'Dhommah',
        ];

        foreach ($latihanKataHarakat as $latihanNama => $harakat) {
            $latihan = Latihan::where('nama', $latihanNama)->first();
            if (!$latihan) {
                $this->command->info("Latihan {$latihanNama} tidak ditemukan, skip.");
                continue;
            }

            if (!isset($kataList[$harakat]) || !isset($kodeYoutubeKata[$harakat])) {
                $this->command->info("Data kata atau kode video untuk {$harakat} tidak lengkap, skip.");
                continue;
            }

            foreach ($kataList[$harakat] as $index => $kataBenar) {
                $videoCode = $kodeYoutubeKata[$harakat][$index] ?? null;
                if (!$videoCode) {
                    $this->command->info("Kode video untuk kata {$kataBenar} pada {$harakat} index {$index} tidak ditemukan, skip.");
                    continue;
                }

                $videoUrl = "https://www.youtube.com/watch?v={$videoCode}";
                $audioUrl = "{$githubRawAudioKata}/kata-{$harakat}/" . ($index + 1) . ".{$harakat}_{$kataBenar}.mp3";

                $opsiKata = collect($kataList[$harakat])
                    ->filter(fn($k) => $k !== $kataBenar)
                    ->shuffle()
                    ->take(3)
                    ->values();

                $opsiKata->push($kataBenar);
                $opsiKata = $opsiKata->shuffle()->values();

                $opsiGambar = $opsiKata->map(function($kataOpsi) use ($harakat, $kataList, $githubRawBaseKata) {
                    $indexOpsi = array_search($kataOpsi, $kataList[$harakat]) + 1;
                    return "{$githubRawBaseKata}/kata-{$harakat}/{$indexOpsi}.{$harakat}_{$kataOpsi}.png";
                });

                $jawabanIndex = $opsiKata->search($kataBenar);

                #Buat soal video
                SoalVideo::create([
                    'latihan_id' => $latihan->id,
                    'video_url' => $videoUrl,
                    'opsi_a' => $opsiGambar[0],
                    'opsi_b' => $opsiGambar[1],
                    'opsi_c' => $opsiGambar[2],
                    'opsi_d' => $opsiGambar[3],
                    'jawaban' => $opsiGambar[$jawabanIndex],
                ]);

                #Buat soal audio
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

