<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;
use App\Models\IsiPelajaran;

class PelajaranController extends Controller
{
    #list pelajaran
    public function index()
    {
        try {
            $pelajaran = Pelajaran::with('kategori')
                ->whereIn('nama', [
                    'Pelajaran Huruf 1',
                    'Pelajaran Huruf 2',
                    'Pelajaran Huruf 3',
                    'Pelajaran Huruf 4',
                    'Pelajaran Huruf 5',
                    'Pelajaran Huruf 6',
                    'Pelajaran Huruf 7',
                    'Pelajaran Kata 1',
                ])
                ->get()->map(function($item) {
                    return [
                        'id' => $item->id,
                        'nama' => $item->nama,
                        'kategori_id' => $item->kategori_id,
                        'gambar_url' => $item->gambar ? asset($item->gambar) : null,
                    ];
                });

            return response()->json([
                'status' => 'success',
                'data' => $pelajaran,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data pelajaran',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    #list isi pelajaran
    public function listIsiPelajaran($pelajaran_id)
    {
        try {
            $pelajaran = Pelajaran::find($pelajaran_id);
            if (!$pelajaran) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pelajaran tidak ditemukan',
                ], 404);
            }

            $isiPelajaran = IsiPelajaran::where('pelajaran_id', $pelajaran_id)
                ->select('id', 'keterangan', 'video', 'gambar')
                ->get()->map(function ($isi) {
                    return [
                        'id' => $isi->id,
                        'keterangan' => $isi->keterangan,
                        'video_url' => $isi->video ?? null,  
                        'gambar_url' => $isi->gambar ?? null, 
                    ];
                });

            return response()->json([
                'status' => 'success',
                'data' => $isiPelajaran,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil isi pelajaran',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    #isi pelajaran
    public function isiPelajaran($pelajaran_id, $id)
    {
        try {
            $pelajaran = Pelajaran::find($pelajaran_id);
            if (!$pelajaran) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pelajaran tidak ditemukan',
                ], 404);
            }

            $isi = IsiPelajaran::where('pelajaran_id', $pelajaran_id)->where('id', $id)->first();
            if (!$isi) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Isi pelajaran tidak ditemukan',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => [
                    'id' => $isi->id,
                    'keterangan' => $isi->keterangan ?? null,
                    'video_url' => $isi->video ?? null,
                    'gambar_url' => $isi->gambar ?? null,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil isi pelajaran',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
