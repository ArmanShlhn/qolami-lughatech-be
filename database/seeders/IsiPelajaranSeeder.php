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
            'Ra','Zay','Sin','Syin','Shod','Dhod','To','Dzo','Ain',
            'Ghain','Fa','Qaf','Kaf','Lam','Mim','Nun','Waw','Ha',
            'LamAlif','Hamzah','Ya'
        ];

        $warnaHarakat = [
            'fathah'      => 'biru terang',
            'kasrah'      => 'hijau terang',
            'dhammah'     => 'orange',
            'fathahtain'  => 'biru gelap',
            'kasrahtain'  => 'hijau gelap',
            'dhammahtain' => 'coklat',
        ];

        #Seeder Pelajaran Huruf 1: tanpa harakat
        $id1 = DB::table('pelajaran')
            ->where('nama','Pelajaran Huruf 1')->value('id');
        foreach ($hurufHijaiyah as $huruf) {
            DB::table('isi_pelajaran')->insert([
                'pelajaran_id'         => $id1,
                'huruf_kata_rangkaian' => $huruf,
                'keterangan'           => "Gambar tersebut merupakan huruf hijaiyah {$huruf}.",
                'video'                => "video_{$huruf}.mp4",
                'gambar'               => "gambar_{$huruf}.png",
            ]);
        }

        #Seeder Pelajaran Huruf 2: fathah, kasrah, dhammah
        $id2 = DB::table('pelajaran')
            ->where('nama','Pelajaran Huruf 2')->value('id');
        foreach ($hurufHijaiyah as $huruf) {
            foreach (['fathah','kasrah','dhammah'] as $h) {
                DB::table('isi_pelajaran')->insert([
                    'pelajaran_id'         => $id2,
                    'huruf_kata_rangkaian' => $huruf,
                    'keterangan'           => "Warna hitam huruf {$huruf}, warna {$warnaHarakat[$h]} adalah harakat {$h}.",
                    'video'                => "video_{$huruf}_{$h}.mp4",
                    'gambar'               => "gambar_{$huruf}_{$h}.png",
                ]);
            }
        }

        #Seeder Pelajaran Huruf 3: fathahtain, kasrahtain, dhammahtain
        $id3 = DB::table('pelajaran')
            ->where('nama','Pelajaran Huruf 3')->value('id');
        foreach ($hurufHijaiyah as $huruf) {
            foreach (['fathahtain','kasrahtain','dhammahtain'] as $h) {
                DB::table('isi_pelajaran')->insert([
                    'pelajaran_id'         => $id3,
                    'huruf_kata_rangkaian' => $huruf,
                    'keterangan'           => "Warna hitam huruf {$huruf}, warna {$warnaHarakat[$h]} adalah harakat {$h}.",
                    'video'                => "video_{$huruf}_{$h}.mp4",
                    'gambar'               => "gambar_{$huruf}_{$h}.png",
                ]);
            }
        }

        #Seeder Pelajaran Kata 1: per kata dengan harakat spesifik
        $kata = [
            ['kata'=>'Fataha','harakat'=>'fathah'],
            ['kata'=>'Khoriqo','harakat'=>'kasrah'],
            ['kata'=>'Kasyuro','harakat'=>'dhammah'],
        ];
        $idKata1 = DB::table('pelajaran')
            ->where('nama','Pelajaran Kata 1')->value('id');
        foreach ($kata as $item) {
            $k = $item['kata'];
            $h = $item['harakat'];
            DB::table('isi_pelajaran')->insert([
                'pelajaran_id'         => $idKata1,
                'huruf_kata_rangkaian' => $k,
                'keterangan'           => "Berikut ini adalah kata {$k} yang berharakat {$h}. Warna {$warnaHarakat[$h]}.",
                'video'                => "video_{$k}.mp4",
                'gambar'               => "gambar_{$k}.png",
            ]);
        }
    }
}
