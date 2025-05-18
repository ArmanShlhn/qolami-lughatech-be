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
            'Ghoin','Fa','Qaf','Kaf','Lam','Mim','Nun','Wawu','Hamzah','Ya'
        ];

        $warnaHarakat = [
            'fathah'      => 'biru terang',
            'kasrah'      => 'hijau terang',
            'dhammah'     => 'orange',
            'fathahtain'  => 'biru gelap',
            'kasrahtain'  => 'hijau gelap',
            'dhammahtain' => 'coklat',
        ];

        $url = fn($kategori, $harakat, $tipe, $file) =>
            "pelajaran/{$kategori}/{$harakat}/{$tipe}/{$file}";

        #Pelajaran Huruf 1
        $id1 = DB::table('pelajaran')->where('nama','Pelajaran Huruf 1')->value('id');
        $i = 1;
        foreach ($hurufHijaiyah as $huruf) {
            DB::table('isi_pelajaran')->insert([
                'pelajaran_id'         => $id1,
                'huruf_kata_rangkaian' => $huruf,
                'keterangan'           => "Gambar tersebut merupakan huruf hijaiyah {$huruf}.",
                'video'                => $url('huruf', 'tanpa_harakat', 'video', "{$i}_{$huruf}.mp4"),
                'gambar'               => $url('huruf', 'tanpa_harakat', 'foto', "{$i}_{$huruf}.png"),
            ]);
            $i++;
        }

        #Pelajaran Huruf 2 (fathah, kasrah, dhammah)
        $id2 = DB::table('pelajaran')->where('nama','Pelajaran Huruf 2')->value('id');
        $i = 1;
        foreach ($hurufHijaiyah as $huruf) {
            foreach (['fathah','kasrah','dhammah'] as $h) {
                DB::table('isi_pelajaran')->insert([
                    'pelajaran_id'         => $id2,
                    'huruf_kata_rangkaian' => $huruf,
                    'keterangan'           => "Warna hitam huruf {$huruf}, warna {$warnaHarakat[$h]} adalah harakat {$h}.",
                    'video'                => $url('huruf', $h, 'video', "{$i}.{$h}_{$huruf}.mp4"),
                    'gambar'               => $url('huruf', $h, 'foto', "{$i}.{$h}_{$huruf}.png"),
                ]);
                $i++;
            }
        }

        #Pelajaran Huruf 3 (fathahtain, kasrahtain, dhammahtain)
        $id3 = DB::table('pelajaran')->where('nama','Pelajaran Huruf 3')->value('id');
        $i = 1;
        foreach ($hurufHijaiyah as $huruf) {
            foreach (['fathahtain','kasrahtain','dhammahtain'] as $h) {
                DB::table('isi_pelajaran')->insert([
                    'pelajaran_id'         => $id3,
                    'huruf_kata_rangkaian' => $huruf,
                    'keterangan'           => "Warna hitam huruf {$huruf}, warna {$warnaHarakat[$h]} adalah harakat {$h}.",
                    'video'                => $url('huruf', $h, 'video', "{$i}.{$h}_{$huruf}.mp4"),
                    'gambar'               => $url('huruf', $h, 'foto', "{$i}.{$h}_{$huruf}.png"),
                ]);
                $i++;
            }
        }

        // Pelajaran Kata 1
        $kata = [
            ['kata'=>'Fataha','harakat'=>'fathah'],
            ['kata'=>'Khoriqo','harakat'=>'kasrah'],
            ['kata'=>'Kasyuro','harakat'=>'dhammah'],
        ];
        $idKata1 = DB::table('pelajaran')->where('nama','Pelajaran Kata 1')->value('id');
        $i = 1;
        foreach ($kata as $item) {
            $k = $item['kata'];
            $h = $item['harakat'];
            DB::table('isi_pelajaran')->insert([
                'pelajaran_id'         => $idKata1,
                'huruf_kata_rangkaian' => $k,
                'keterangan'           => "Berikut ini adalah kata {$k} yang berharakat {$h}. Warna {$warnaHarakat[$h]}.",
                'video'                => $url('kata', 'fathah_kasrah_dhammah', 'video', "{$i}.{$h}_{$k}.mp4"),
                'gambar'               => $url('kata', 'fathah_kasrah_dhammah', 'foto', "{$i}.{$h}_{$k}.png"),
            ]);
            $i++;
        }
    }
}
