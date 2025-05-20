<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelajaran;
use App\Models\IsiPelajaran;

class PelajaranController extends Controller
{
    #Menampilkan semua pelajaran yang dipilih
    public function index()
    {
        $pelajaran = Pelajaran::with('kategori')
            ->whereIn('nama', [
                'Pelajaran Huruf 2',
                'Pelajaran Huruf 3',
                'Pelajaran Huruf 4',
                'Pelajaran Huruf 5',
                'Pelajaran Huruf 6',
                'Pelajaran Huruf 7',
                'Pelajaran Kata 1',
            ])
            ->get();

        return response()->json($pelajaran);
    }

    #Menampilkan isi pelajaran berdasarkan pelajaran_id dan id isi_pelajaran
    public function isiPelajaran($pelajaran_id, $id)
    {
        $pelajaran = Pelajaran::find($pelajaran_id);
        if (!$pelajaran) {
            return response()->json(['message' => 'Pelajaran tidak ditemukan'], 404);
        }

        #mencari isi pelajaran berdasarkan pelajaran_id dan id isi_pelajaran
        $isi = IsiPelajaran::where('pelajaran_id', $pelajaran_id)
            ->where('id', $id)
            ->first();

        if (!$isi) {
            return response()->json(['message' => 'Isi pelajaran tidak ditemukan'], 404);
        }

        #Ubah path video & gambar menjadi URL lengkap
        $isi->video = $isi->video ? asset('storage/' . $isi->video) : null;
        $isi->gambar = $isi->gambar ? asset('storage/' . $isi->gambar) : null;

        return response()->json($isi);
    }
}
