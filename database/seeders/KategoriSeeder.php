<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        DB::table('kategori')->insert([
            ['nama' => 'Huruf'],
            ['nama' => 'Kata'],
        ]);
    }
}
