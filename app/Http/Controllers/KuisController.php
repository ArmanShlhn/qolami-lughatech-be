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
    protected $soalModels = [
        'audio' => SoalAudio::class,
        'video' => SoalVideo::class,
    ];

    
    #List semua kuis
    public function listKuis()
    {
        try {
            $kuisList = Kuis::with('kategori')->get();
            
            return response()->json([
                'status' => 'success',
                'data' => $kuisList->map(function ($kuis) {
                    return [
                        'id' => $kuis->id,
                        'nama' => $kuis->nama_kuis,
                        'kategori' => $kuis->kategori->id ?? null,
                    ];
                }),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }

    #soal kuis berdasarkan kategori dan id kuis
    public function getSoalKuis($kategoriNama, $kuisId)
    {
        try {
            $kategori = Kategori::whereRaw('LOWER(nama) = ?', [strtolower($kategoriNama)])->first();

            if (!$kategori) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kategori tidak ditemukan'
                ], 404);
            }

            $kuis = Kuis::where('id', $kuisId)
                        ->where('kategori_id', $kategori->id)
                        ->first();

            if (!$kuis) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kuis tidak ditemukan'
                ], 404);
            }

            $soalAudio = SoalAudio::whereHas('latihan', function ($query) use ($kategori) {
                $query->where('kategori_id', $kategori->id);
            })->inRandomOrder()->take(10)->get();

            $soalVideo = SoalVideo::whereHas('latihan', function ($query) use ($kategori) {
                $query->where('kategori_id', $kategori->id);
            })->inRandomOrder()->take(10)->get();

            $soalGabungan = $soalAudio->concat($soalVideo)->shuffle()->take(20)->values();

            $soalFinal = $soalGabungan->map(function ($soal) {
                return [
                    'id' => $soal->id,
                    'jenis' => $this->getJenisSoal($soal),
                    'file_url' => $soal->gambar_url ?? $soal->audio_url ?? $soal->video_url,
                    'opsi' => [
                        'a' => $soal->opsi_a,
                        'b' => $soal->opsi_b,
                        'c' => $soal->opsi_c,
                        'd' => $soal->opsi_d,
                    ],
                    'jawaban' => $soal->jawaban
                ];
            });

            return response()->json([
                'kuis' => [
                    'id' => $kuis->id,
                    'nama' => $kuis->nama_kuis,
                    'kategori' => $kategori->nama,
                ],
                'soal' => $soalFinal,                
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }


    #Submit jawaban kuis dan simpan skor
public function submitJawabanKuis(Request $request)
{
    try {
        $validated = $request->validate([
            'kuis_id' => 'required|integer|exists:kuis,id',
            'jawaban' => 'required|array|min:0',
            'jawaban.*.soal_id' => 'required|integer',
            'jawaban.*.jenis' => 'required|string|in:audio,video',
            'jawaban.*.jawaban_user' => 'required|string',
        ]);
        $userId = $request->input('user_id');
        $jawabanBenar = 0;

        foreach ($validated['jawaban'] as $item) {
            $jenis = $item['jenis'];
            $soalId = $item['soal_id'];
            $jawabanUser = trim($item['jawaban_user']);

            if (!isset($this->soalModels[$jenis])) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Jenis soal tidak valid: $jenis"
                ], 422);
            }

            $model = $this->soalModels[$jenis];
            $soal = $model::find($soalId);

            if (!$soal) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Soal dengan ID $soalId tidak ditemukan pada jenis $jenis"
                ], 404);
            }

            if (strtolower($soal->jawaban) === strtolower($jawabanUser)) {
                $jawabanBenar++;
            }
        }

        $bintang = 0;
        if ($jawabanBenar == 20) {
            $bintang = 3;
        } elseif ($jawabanBenar >= 10) {
            $bintang = 2;
        } elseif ($jawabanBenar >= 1) {
            $bintang = 1;
        }

        return response()->json([
            'message' => 'Jawaban berhasil diproses',
            'data' => [
                'user_id' => $userId,
                'kuis_id' => $validated['kuis_id'],
                'jumlah_benar' => $jawabanBenar,
                'bintang' => $bintang,
            ],
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validasi gagal',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan',
            'errors' => $e->getMessage(),
        ], 500);
    }
}


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
