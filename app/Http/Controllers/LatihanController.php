<?php

namespace App\Http\Controllers;

use App\Models\Latihan;
use App\Models\SoalVideo;
use App\Models\SoalAudio;
use Illuminate\Http\Request;

class LatihanController extends Controller
{
    #Model soal berdasarkan jenis media
    protected $models = [
        'audio' => SoalAudio::class,
        'video' => SoalVideo::class,
    ];

    #List semua latihan dengan kategori
    public function listLatihan()
    {
        try {
            $latihanList = Latihan::with('kategori')->get();

            $formatted = $latihanList->map(function ($latihan) {
                return [
                    'id' => $latihan->id,
                    'nama' => $latihan->nama,
                    'kategori_id' => $latihan->kategori_id,
                    'kategori_nama' => $latihan->kategori->nama ?? null,
                ];
            });

            return response()->json([
                'status' => 'success',
                'latihan' => $formatted,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    #Ambil soal latihan berdasarkan latihan id dan jenis (audio/video)
    public function getSoalLatihan($latihanId, $jenis, Request $request)
    {
        try {
            $latihan = Latihan::with('kategori')->find($latihanId);

            if (!$latihan) {
                return response()->json(['message' => 'Latihan tidak ditemukan'], 404);
            }

            if (!isset($this->models[$jenis])) {
                return response()->json(['message' => 'Jenis latihan tidak valid'], 400);
            }

            $model = $this->models[$jenis];

            #Ambil 10 soal latihan sesuai jenis dan latihan_id
            $soalList = $model::where('latihan_id', $latihanId)
                ->orderBy('id')
                ->limit(10)
                ->get();

            if ($soalList->isEmpty()) {
                return response()->json(['message' => 'Soal tidak ditemukan'], 404);
            }

            #Format soal untuk response
            $soalFormatted = $soalList->map(function ($soal) {
                return [
                    'id' => $soal->id,
                    'latihan_id' => $soal->latihan_id,
                    'media_url' => $soal->gambar_url ?? $soal->video_url ?? $soal->audio_url,
                    'opsi_a' => $soal->opsi_a,
                    'opsi_b' => $soal->opsi_b,
                    'opsi_c' => $soal->opsi_c,
                    'opsi_d' => $soal->opsi_d,
                    'jawaban' => $soal->jawaban,
                ];
            });

            return response()->json([
                'latihan' => [
                    'id' => $latihan->id,
                    'nama' => $latihan->nama,
                    'kategori_id' => $latihan->kategori_id,
                    'kategori_nama' => $latihan->kategori->nama ?? 'N/A',
                ],
                'soal' => $soalFormatted,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan', 'error' => $e->getMessage()], 500);
        }
    }

    #Submit jawaban soal latihan dan cek hasil
    public function submitJawaban(Request $request)
    {
        try {
            $request->validate([
                'latihan_id' => 'required|exists:latihan,id',
                'jenis' => 'required|in:video,audio',
                'soal_id' => 'required|integer',
                'jawaban_user' => 'required|string',
            ]);

            $model = $this->models[$request->jenis];
            $soal = $model::find($request->soal_id);

            if (!$soal) {
                return response()->json(['message' => 'Soal tidak ditemukan'], 404);
            }

            $jawabanBenar = strtolower($soal->jawaban);
            $jawabanUser = strtolower($request->jawaban_user);
            $hasil = ($jawabanBenar === $jawabanUser) ? 'Benar' : 'Salah';

            return response()->json([
                'latihan_id' => $soal->latihan_id,
                'soal_id' => $soal->id,
                'jawaban_user' => $request->jawaban_user,
                'jawaban_benar' => $soal->jawaban,
                'hasil' => $hasil,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Validasi gagal', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan', 'error' => $e->getMessage()], 500);
        }
    }
}
