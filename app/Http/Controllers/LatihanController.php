<?php

namespace App\Http\Controllers;

use App\Models\Latihan;
use App\Models\SoalVideo;
use App\Models\SoalAudio;
use Illuminate\Http\Request;

class LatihanController extends Controller
{
    protected $models = [
        'video' => SoalVideo::class,
        'audio' => SoalAudio::class,
    ];
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

    public function getSoalLatihan($latihanId, $jenis, Request $request){
        try {
            $latihan = Latihan::with('kategori')->find($latihanId);

            if (!$latihan) {
                return response()->json(['message' => 'Latihan tidak ditemukan'], 404);
            }

            $models = [
                'audio' => SoalAudio::class,
                'video' => SoalVideo::class,
            ];

            if (!isset($models[$jenis])) {
                return response()->json(['message' => 'Jenis latihan tidak valid'], 400);
            }

            $model = $models[$jenis];

            #ambil 10 soal sesuai latihan dan jenis
            $soalList = $model::where('latihan_id', $latihanId)
                ->orderBy('id')
                ->limit(10)
                ->get();

            if ($soalList->isEmpty()) {
                return response()->json(['message' => 'Soal tidak ditemukan'], 404);
            }

            #Format soal untuk dikirim ke response
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
            $benar = $jawabanBenar === $jawabanUser;

            return response()->json([
                'latihan_id' => $soal->latihan_id,
                'soal_id' => $soal->id,
                'jawaban_user' => $request->jawaban_user,
                'jawaban_benar' => $soal->jawaban,
                'hasil' => $benar ? 'Benar' : 'Salah',
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan', 'error' => $e->getMessage()], 500);
        }
    }
}
