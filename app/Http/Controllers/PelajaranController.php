<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelajaran;
use App\Models\IsiPelajaran;

class PelajaranController extends Controller
{
    #List pelajaran
    public function index()
    {
        $pelajaran = Pelajaran::with('kategori')
            ->whereIn('nama', ['Pelajaran Huruf 1', 'Pelajaran Huruf 2', 'Pelajaran Huruf 3', 'Pelajaran Kata 1'])
            ->get();

        return response()->json($pelajaran);
    }

    #Menampilkan isi pelajaran berdasarkan id pelajaran, dengan URL asset lengkap
    public function isiPelajaran($id)
    {
        $pelajaran = Pelajaran::find($id);
        if (!$pelajaran) {
            return response()->json(['message' => 'Pelajaran tidak ditemukan'], 404);
        }

        $nama = $pelajaran->nama;
        $isi = collect();

        if ($nama === 'Pelajaran Huruf 1') {
            $isi = IsiPelajaran::where('pelajaran_id', $id)->get();
        } 
        elseif ($nama === 'Pelajaran Huruf 2') {
            $isi = collect([
                IsiPelajaran::where('pelajaran_id', $id)->where('keterangan', 'like', '%fathah%')->inRandomOrder()->first(),
                IsiPelajaran::where('pelajaran_id', $id)->where('keterangan', 'like', '%kasrah%')->inRandomOrder()->first(),
                IsiPelajaran::where('pelajaran_id', $id)->where('keterangan', 'like', '%dhammah%')->inRandomOrder()->first(),
            ])->filter();
        } 
        elseif ($nama === 'Pelajaran Huruf 3') {
            $isi = collect([
                IsiPelajaran::where('pelajaran_id', $id)->where('keterangan', 'like', '%fathahtain%')->inRandomOrder()->first(),
                IsiPelajaran::where('pelajaran_id', $id)->where('keterangan', 'like', '%kasrahtain%')->inRandomOrder()->first(),
                IsiPelajaran::where('pelajaran_id', $id)->where('keterangan', 'like', '%dhammahtain%')->inRandomOrder()->first(),
            ])->filter();
        } 
        elseif ($nama === 'Pelajaran Kata 1') {
            $isi = collect()
                ->merge(IsiPelajaran::where('pelajaran_id', $id)->where('keterangan', 'like', '%fathah%')->get())
                ->merge(IsiPelajaran::where('pelajaran_id', $id)->where('keterangan', 'like', '%kasrah%')->get())
                ->merge(IsiPelajaran::where('pelajaran_id', $id)->where('keterangan', 'like', '%dhammah%')->get());
        } 
        else {
            return response()->json(['message' => 'Jenis pelajaran tidak dikenali'], 400);
        }

        #Refactor: merubah path relatif asset menjadi URL lengkap menggunakan asset('storage/...')
        $isi = $isi->map(function ($item) {
            $item->video = asset('storage/' . $item->video);
            $item->gambar = asset('storage/' . $item->gambar);
            return $item;
        });

        return response()->json($isi->values());
    }
}
