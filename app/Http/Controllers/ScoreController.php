<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Score;

class ScoreController extends Controller
{
    #Submit atau update skor kuis user
    public function submitKuisScore(Request $request)
    {
        try {
            $request->validate([
                'kuis_id' => 'required|exists:kuis,id',
                'score' => 'required|integer|min:0|max:100',
            ]);

            $user = Auth::user();

            $score = Score::updateOrCreate(
                ['user_id' => $user->id, 'kuis_id' => $request->kuis_id],
                ['score' => $request->score]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Skor kuis berhasil disimpan',
                'data' => $score,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan skor',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    #Mengambil semua skor kuis milik user
    public function getUserScores()
    {
        try {
            $user = Auth::user();
            $scores = Score::where('user_id', $user->id)->get();

            return response()->json([
                'status' => 'success',
                'data' => $scores,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data skor',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
