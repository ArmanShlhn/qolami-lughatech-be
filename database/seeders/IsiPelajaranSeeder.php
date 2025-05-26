<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IsiPelajaranSeeder extends Seeder
{
    public function run()
    {
        $hurufHijaiyah = [
            'Alif','Ba','Ta','Tsa','Jim','Ha','Kho','Dal','Dzal',
            'Ro','Zay','Sin','Syin','Shod','Dhod','Tho','Dzho','Ain',
            'Ghain','Fa','Qof','Kaf','Lam','Mim','Nun','Wawu','Ha besar','Ya'
        ];

        $warnaHarakat = [
            'Fathah'      => 'biru terang',
            'Kasroh'      => 'hijau terang',
            'Dhommah'     => 'orange',
            'Fathahtain'  => 'biru gelap',
            'Kasrotain'   => 'hijau gelap',
            'Dhommahtain' => 'coklat',
        ];

        #Mapping kode YouTube
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

        $harakatMap = [
            'Pelajaran Huruf 1' => 'tanpa harakat',
            'Pelajaran Huruf 2' => 'Fathah',
            'Pelajaran Huruf 3' => 'Kasroh',
            'Pelajaran Huruf 4' => 'Dhommah',
            'Pelajaran Huruf 5' => 'Fathahtain',
            'Pelajaran Huruf 6' => 'Kasrotain',
            'Pelajaran Huruf 7' => 'Dhommahtain',
        ];
$githubRawBase = 'https://raw.githubusercontent.com/ArmanShlhn/qolami-lughatech-be/refs/heads/main/public/images';
        #Menggunakan link rawgithub untuk asset
        foreach ($harakatMap as $pelajaranNama => $harakat) {
            $pelajaranId = DB::table('pelajaran')->where('nama', $pelajaranNama)->value('id');
            foreach ($hurufHijaiyah as $i => $huruf) {
                DB::table('isi_pelajaran')->insert([
                    'pelajaran_id'         => $pelajaranId,
                    'huruf_kata_rangkaian' => $huruf,
                    'keterangan'           => "Warna hitam huruf {$huruf}, warna {$warnaHarakat[$harakat]} adalah harakat {$harakat}.",
                    'video'                => 'https://www.youtube.com/watch?v=' . $kodeYoutube[$harakat][$i],
                    'gambar'               => "{$githubRawBase}/huruf-{$harakat}/" . ($i+1) . ".{$harakat}_{$huruf}.png",
                ]);
            }
        }

        // Pelajaran Kata 1 - tetap ada dan memakai gambar dari raw GitHub juga
        $kata = [
            ['kata' => 'Fataha',  'harakat' => 'Fathah',  'kode' => 'OOfBE7MXFGw'],
            ['kata' => 'Khoriqo', 'harakat' => 'Kasroh',  'kode' => '9PLQoJa9Na4'],
            ['kata' => 'Kasyuro', 'harakat' => 'Dhommah', 'kode' => 'nCy0n19w6Pw'],
        ];
        $idKata1 = DB::table('pelajaran')->where('nama', 'Pelajaran Kata 1')->value('id');
        foreach ($kata as $i => $item) {
            $k = $item['kata'];
            $h = $item['harakat'];
            DB::table('isi_pelajaran')->insert([
                'pelajaran_id'         => $idKata1,
                'huruf_kata_rangkaian' => $k,
                'keterangan'           => "Berikut ini adalah kata {$k} yang berharakat {$h} berwarna {$warnaHarakat[$h]}.",
                'video'                => 'https://www.youtube.com/watch?v=' . $item['kode'],
                'gambar'               => "{$githubRawBase}/kata-{$h}/" . ($i+1) . ".{$h}_{$k}.png",
            ]);
        }
    }
}
