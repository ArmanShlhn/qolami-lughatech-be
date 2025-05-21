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
        'Kasrotain'  => 'hijau gelap',
        'Dhommahtain' => 'coklat',
    ];

    $url = fn($kategori, $harakat, $tipe, $file) =>
        "Pelajaran/{$kategori}/{$harakat}/{$tipe}/{$file}";


    $harakatMap = [
        'Pelajaran Huruf 2' => 'Fathah',
        'Pelajaran Huruf 3' => 'Kasroh',
        'Pelajaran Huruf 4' => 'Dhommah',
        'Pelajaran Huruf 5' => 'Fathahtain',
        'Pelajaran Huruf 6' => 'Kasrotain',
        'Pelajaran Huruf 7' => 'Dhommahtain',
    ];

    #Insert isi pelajaran huruf per jenis harakat (Pelajaran Huruf 2-7)
    foreach ($harakatMap as $pelajaranNama => $harakat) {
        $pelajaranId = DB::table('pelajaran')->where('nama', $pelajaranNama)->value('id');
        $i = 1;
        foreach ($hurufHijaiyah as $huruf) {
            DB::table('isi_pelajaran')->insert([
                'pelajaran_id'         => $pelajaranId,
                'huruf_kata_rangkaian' => $huruf,
                'keterangan'           => "Warna hitam huruf {$huruf}, warna {$warnaHarakat[$harakat]} adalah harakat {$harakat}.",
                'video'                => $url('Huruf', $harakat, 'video', "{$i}.{$harakat}_{$huruf}.mp4"),
                'gambar'               => $url('Huruf', $harakat, 'foto', "{$i}.{$harakat}_{$huruf}.png"),
            ]);
            $i++;
        }
    }

    #Pelajaran Kata 1 (fathah, kasrah, dhammah)
    $kata = [
        ['kata'=>'Fataha','harakat'=>'Fathah'],
        ['kata'=>'Khoriqo','harakat'=>'Kasroh'],
        ['kata'=>'Kasyuro','harakat'=>'Dhommah'],
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
            'video'                => $url('Kata', 'fathah_kasrah_dhammah', 'video', "{$i}.{$h}_{$k}.mp4"),
            'gambar'               => $url('Kata', 'fathah_kasrah_dhammah', 'foto', "{$i}.{$h}_{$k}.png"),
        ]);
        $i++;
    }
}

}
