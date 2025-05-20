<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;
use App\Models\IsiPelajaran;

class PelajaranController extends Controller
{
    #Menampilkan daftar pelajaran tertentu dengan kategori
    public function index()
    {
        try {
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
                ->get()
                ->map(function($item) {
                    return [
                        'id' => $item->id,
                        'nama' => $item->nama,
                        'kategori_id' => $item->kategori_id,
                        'kategori_nama' => $item->kategori->nama ?? null,
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

    #Menampilkan daftar isi pelajaran berdasarkan pelajaran_id
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
                ->select('id', 'judul', 'video', 'gambar')
                ->get()
                ->map(function ($isi) {
                    return [
                        'id' => $isi->id,
                        'judul' => $isi->judul,
                        'video_url' => $isi->video ? asset('storage/' . $isi->video) : null,
                        'gambar_url' => $isi->gambar ? asset('storage/' . $isi->gambar) : null,
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

    #Menampilkan isi pelajaran spesifik berdasarkan pelajaran_id dan id isi_pelajaran
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

            $isi = IsiPelajaran::where('pelajaran_id', $pelajaran_id)
                ->where('id', $id)
                ->first();

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
                    'judul' => $isi->judul,
                    'video_url' => $isi->video ? asset('storage/' . $isi->video) : null,
                    'gambar_url' => $isi->gambar ? asset('storage/' . $isi->gambar) : null,
                    'keterangan' => $isi->keterangan ?? null, #jika ada kolom keterangan
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
