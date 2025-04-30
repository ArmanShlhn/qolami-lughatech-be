<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Score;
use App\Models\Kuis;

class ScoreController extends Controller
{
    public function submitKuisScore(Request $request)
    {
        try {
            $request->validate([
                'kuis_id' => 'required|exists:kuis,id',
                'score' => 'required|integer|min:0|max:100',
            ]);

            $user = Auth::user();

            #Simpan atau update skor kuis user
            $score = Score::updateOrCreate(
                ['user_id' => $user->id, 'kuis_id' => $request->kuis_id],
                ['score' => $request->score]
            );

            return response()->json([
                'message' => 'Skor kuis berhasil disimpan',
                'score' => $score,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan', 'error' => $e->getMessage()], 500);
        }
    }

    #Ambil Skor Kuis User
    public function getUserScores()
    {
        try {
            $user = Auth::user();
            $scores = Score::where('user_id', $user->id)->get();

            return response()->json([
                'scores' => $scores
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan', 'error' => $e->getMessage()], 500);
        }
    }
}
