<?php

namespace App\Http\Controllers;

use App\Models\Kuis;
use App\Models\Kategori;
use App\Models\SoalAudio;
use App\Models\SoalVideo;
use App\Models\Score;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    #variabel untuk model untuk soal gambar, audio, dan video
    protected $soalModels = [
        'audio' => SoalAudio::class,
        'video' => SoalVideo::class,
    ];

    #soal kuis berdasarkan kategori dan ID kuis

    public function getSoalKuis($kategoriNama, $kuisId)
    {
        try {
            #cari kategori berdasarkan nama (dengan pencocokan case-insensitive)
            $kategori = Kategori::whereRaw('LOWER(nama) = ?', [strtolower($kategoriNama)])->first();

            if (!$kategori) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            #cari kuis berdasarkan kategori dan id
            $kuis = Kuis::where('id', $kuisId)
                        ->where('kategori_id', $kategori->id)
                        ->first();

            if (!$kuis) {
                return response()->json(['message' => 'Kuis tidak ditemukan'], 404);
            }

            #soal-soal dari semua jenis (audio dan video)

            $soalAudio = SoalAudio::whereHas('latihan', function($query) use ($kategori) {
                $query->where('kategori_id', $kategori->id);
            })->inRandomOrder()->take(10)->get();

            $soalVideo = SoalVideo::whereHas('latihan', function($query) use ($kategori) {
                $query->where('kategori_id', $kategori->id);
            })->inRandomOrder()->take(10)->get();

            #gabungan semua soal secara acak
            $soalGabungan = $soalAudio->concat($soalVideo)->shuffle()->take(20)->values();

            #informasi jenis soal di setiap soal (agar mudah di cek di postman)
            $soalFinal = $soalGabungan->map(function($soal) {
                return [
                    'id' => $soal->id,
                    'pertanyaan' => $soal->soal ?? '',
                    'file' => $soal->gambar_url ?? $soal->audio_url ?? $soal->video_url, 
                    'opsi_a' => $soal->opsi_a,
                    'opsi_b' => $soal->opsi_b,
                    'opsi_c' => $soal->opsi_c,
                    'opsi_d' => $soal->opsi_d,
                    'jenis' => $this->getJenisSoal($soal),
                ];
            });

            return response()->json([
                'kuis' => $kuis,
                'soal' => $soalFinal,
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan', 'error' => $e->getMessage()], 500);
        }
    }

    #submit jawaban, kuis, dan penyimpanan score
    public function submitJawabanKuis(Request $request)
    {
        try {
            #validasi input jawaban
            $request->validate([
                'user_id' => 'required|integer',
                'kuis_id' => 'required|integer',
                'jawaban' => 'required|array',
            ]);

            #pengecekan untuk menyimpan skor jika soal sudah dijawab semua
            $totalSoal = count($request->jawaban);

                if ($totalSoal < 20) {
                    return response()->json([
                        'message' => 'Semua soal harus dijawab sebelum menyimpan hasil kuis.',
                        'total_dijawab' => $totalSoal,
                    ], 400);
                }

            $jawabanBenar = 0;
            $totalSoal = count($request->jawaban);

            foreach ($request->jawaban as $dataJawaban) {
                $jenis = $dataJawaban['jenis'] ?? null;
                $soalId = $dataJawaban['soal_id'] ?? null;
                $jawabanUser = $dataJawaban['jawaban_user'] ?? null;

                if (!$jenis || !$soalId || !$jawabanUser) {
                    continue;
                }

                $model = $this->soalModels[$jenis] ?? null;
                if (!$model) {
                    continue;
                }

                #soal berdasarkan jenis dan id
                $soal = $model::find($soalId);
                if ($soal && strtolower($soal->jawaban) === strtolower($jawabanUser)) {
                    $jawabanBenar++;
                }
            }

            #perhitungan score bintang
            $bintang = 0;
            if ($jawabanBenar == 20) {
                $bintang = 3;
            } elseif ($jawabanBenar >= 10) {
                $bintang = 2;
            } elseif ($jawabanBenar >= 5) {
                $bintang = 1;
            }

            #simpen score ke database
            Score::create([
                'user_id' => $request->user_id,
                'kuis_id' => $request->kuis_id,
                'jumlah_benar' => $jawabanBenar,
                'jumlah_soal' => $totalSoal,
                'bintang' => $bintang,
            ]);

            return response()->json([
                'jawaban_benar' => $jawabanBenar,
                'total_soal' => $totalSoal,
                'bintang' => $bintang,
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan', 'error' => $e->getMessage()], 500);
        }
    }

    #nentuin jenis soal berdasarkan instance model soal.
    private function getJenisSoal($soal)
    {
        if ($soal instanceof SoalAudio) {
            return 'audio';
        } elseif ($soal instanceof SoalVideo) {
            return 'video';
        }
        return null;
    }
}
