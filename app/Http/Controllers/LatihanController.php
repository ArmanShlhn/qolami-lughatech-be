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

    public function getSoalLatihan($latihanId, $jenis, Request $request)
    {
        try {
            $page = $request->input('page', 1);
            $perPage = 1;

            $latihan = Latihan::with('kategori')->find($latihanId);

            if (!$latihan) {
                return response()->json(['message' => 'Latihan tidak ditemukan'], 404);
            }

            #array model jenis soal
            $models = [

                'audio' => SoalAudio::class,
                'video' => SoalVideo::class,

            ];

            if (!isset($models[$jenis])) {
                return response()->json(['message' => 'Jenis latihan tidak valid'], 400);
            }

            $model = $models[$jenis];

            #soal berdasarkan model dan jenis
            $soal = $model::where('latihan_id', $latihanId)
                ->orderBy('id')
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->first();

            if (!$soal) {
                return response()->json(['message' => 'Soal tidak ditemukan'], 404);
            }

            return response()->json([
                'latihan' => [
                    'id' => $latihan->id,
                    'nama' => $latihan->nama,
                    'kategori_id' => $latihan->kategori_id,
                    'kategori_nama' => $latihan->kategori->nama ?? 'N/A',
                ],
                'soal' => [
                    'id' => $soal->id,
                    'latihan_id' => $soal->latihan_id,
                    'soal' => $soal->soal,
                    'media_url' => $soal->gambar_url ?? $soal->video_url ?? $soal->audio_url,
                    'opsi_a' => $soal->opsi_a,
                    'opsi_b' => $soal->opsi_b,
                    'opsi_c' => $soal->opsi_c,
                    'opsi_d' => $soal->opsi_d,
                    'jawaban' => $soal->jawaban,
                ],
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
