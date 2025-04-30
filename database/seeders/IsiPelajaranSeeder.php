<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IsiPelajaranSeeder extends Seeder
{
    public function run()
    {
        $pelajaranHuruf = DB::table('pelajaran')->where('kategori_id', function ($query) {
            $query->select('id')->from('kategori')->where('nama', 'Huruf');
        })->get();

        $pelajaranKata = DB::table('pelajaran')->where('kategori_id', function ($query) {
            $query->select('id')->from('kategori')->where('nama', 'Kata');
        })->get();

        $pelajaranRangkaian = DB::table('pelajaran')->where('kategori_id', function ($query) {
            $query->select('id')->from('kategori')->where('nama', 'Rangkaian');
        })->get();

        #Data huruf hijaiyah
        $hurufHijaiyah = ['Alif', 'Ba', 'Ta', 'Tsa', 'Jim', 'Ha', 'Kho', 'Dal', 'Dzal', 'Ra', 'Zay', 'Sin', 'Syin', 'Shod', 'Dhod', 'To', 'Dzo', 'Ain', 'Ghain', 'Fa', 'Qaf', 'Kaf', 'Lam', 'Mim', 'Nun', 'Waw', 'Ha', 'Ya'];
        
        #Data harakat
        $harakat = ['fathah', 'kasrah', 'dammah', 'fathahtain', 'kasrahtain', 'dammahtain', 'sukun', 'tasydid'];
        
        #Masukkan data huruf ke isi_pelajaran dengan harakat
        foreach ($pelajaranHuruf as $index => $pelajaran) {
            foreach ($hurufHijaiyah as $huruf) {
                $harakatIndex = $index % count($harakat);
                $harakatNama = $harakat[$harakatIndex];
                
                DB::table('isi_pelajaran')->insert([
                    'pelajaran_id' => $pelajaran->id,
                    'huruf_kata_rangkaian' => $huruf,
                    'keterangan' => "Ini adalah huruf {$huruf} dengan harakat {$harakatNama}",
                    'video' => "video_{$huruf}.mp4",
                    'gambar' => "gambar_{$huruf}.png",
                ]);
            }
        }

        #Data kata contoh
        $kataContoh = ['Bata', 'Tali', 'Jala', 'Nasi', 'Roti'];

        #Masukkan data kata ke isi_pelajaran
        foreach ($pelajaranKata as $pelajaran) {
            foreach ($kataContoh as $kata) {
                DB::table('isi_pelajaran')->insert([
                    'pelajaran_id' => $pelajaran->id,
                    'huruf_kata_rangkaian' => $kata,
                    'keterangan' => "Ini adalah kata dalam bahasa Arab: {$kata}",
                    'video' => "video_{$kata}.mp4",
                    'gambar' => "gambar_{$kata}.png",
                ]);
            }
        }

        #Data rangkaian contoh
        $rangkaianContoh = ['Bataha', 'Kalamu', 'Jasinu'];

        #Masukkan data rangkaian ke isi_pelajaran
        foreach ($pelajaranRangkaian as $pelajaran) {
            foreach ($rangkaianContoh as $rangkaian) {
                DB::table('isi_pelajaran')->insert([
                    'pelajaran_id' => $pelajaran->id,
                    'huruf_kata_rangkaian' => $rangkaian,
                    'keterangan' => "Ini adalah rangkaian huruf: {$rangkaian}",
                    'video' => "video_{$rangkaian}.mp4",
                    'gambar' => "gambar_{$rangkaian}.png",
                ]);
            }
        }
    }
}