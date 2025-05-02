<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelajaran;
use App\Models\IsiPelajaran;

class PelajaranController extends Controller
{
    public function index()
    {
        $pelajaran = Pelajaran::with('kategori')->get();
        return response()->json($pelajaran);
    }

    public function show($start, $end)
    {
        #mengambil pelajaran berdasarkan rentang id yang di ambil
        $pelajaran = Pelajaran::with('kategori')
            ->whereBetween('id', [$start, $end])
            ->get();

        if ($pelajaran->isEmpty()) {
            return response()->json(['message' => 'Pelajaran tidak ditemukan dalam rentang ini'], 404);
        }

        return response()->json($pelajaran);
    }


    public function getIsiPelajaran($start, $end)
    {
        $isiPelajaran = IsiPelajaran::whereHas('pelajaran', function ($query) use ($start, $end) {
            $query->whereBetween('id', [$start, $end]); // Ambil isi pelajaran berdasarkan rentang ID pelajaran
        })->get();

        if ($isiPelajaran->isEmpty()) {
            return response()->json(['message' => 'Isi pelajaran tidak ditemukan dalam rentang ini'], 404);
        }

        return response()->json($isiPelajaran);
    }
}
