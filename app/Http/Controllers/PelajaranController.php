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

    public function show($id)
    {
        $pelajaran = Pelajaran::with('isiPelajaran')->find($id);

        if (!$pelajaran) {
            return response()->json(['message' => 'Pelajaran tidak ditemukan'], 404);
        }

        return response()->json($pelajaran);
    }

    public function getIsiPelajaran($id)
    {
        $isiPelajaran = IsiPelajaran::where('pelajaran_id', $id)->get();

        if ($isiPelajaran->isEmpty()) {
            return response()->json(['message' => 'Isi pelajaran tidak ditemukan'], 404);
        }

        return response()->json($isiPelajaran);
    }

    public function getIsiPelajaranGabungan(Request $request)
    {
        // Memastikan parameter 'ids' dikirimkan dan merupakan array
        $ids = $request->input('ids');

        if (!$ids || !is_array($ids)) {
            return response()->json(['message' => 'Parameter "ids" harus berupa array.'], 400);
        }

        // Mengambil data isi pelajaran yang sesuai dengan pelajaran_id yang dikirimkan
        $isiPelajaran = IsiPelajaran::whereIn('pelajaran_id', $ids)
            ->with('pelajaran:id,nama') // Menambahkan relasi untuk mengambil nama pelajaran
            ->get();

        // Mengecek apakah data isi pelajaran ditemukan
        if ($isiPelajaran->isEmpty()) {
            return response()->json(['message' => 'Isi pelajaran tidak ditemukan untuk ID tersebut.'], 404);
        }

        // Mengelompokkan isi pelajaran berdasarkan pelajaran_id
        $grouped = $isiPelajaran->groupBy('pelajaran_id');

        return response()->json($grouped);
    }

}
