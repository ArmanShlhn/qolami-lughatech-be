<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    public function up(): void
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kuis_id');
            $table->integer('jumlah_benar');
            $table->integer('jumlah_soal');
            $table->tinyInteger('bintang'); // 0-3
            $table->timestamps();

            #Relasi ke tabel users dan kuis
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kuis_id')->references('id')->on('kuis')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
}
