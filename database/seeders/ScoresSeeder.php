<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Score;

class ScoresSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            Score::create([
                'user_id' => rand(1, 2),
                'kuis_id' => rand(1, 9),
                'score' => rand(50, 100),
                'percentage' => rand(50, 100)
            ]);
        }
    }
}
