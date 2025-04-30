<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        #Tabel Latihan
        Schema::create('latihan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['nama', 'kategori_id']);
        });

        #Tabel Soal Gambar
        Schema::create('soal_gambar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('latihan_id')->constrained('latihan')->onDelete('cascade');
            $table->string('soal');
            $table->string('opsi_a');
            $table->string('opsi_b');
            $table->string('opsi_c');
            $table->string('opsi_d');
            $table->string('jawaban');
            $table->string('gambar_url');
            $table->timestamps();
        });

        #Tabel Soal Audio
        Schema::create('soal_audio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('latihan_id')->constrained('latihan')->onDelete('cascade');
            $table->string('soal');
            $table->string('opsi_a');
            $table->string('opsi_b');
            $table->string('opsi_c');
            $table->string('opsi_d');
            $table->string('jawaban');
            $table->string('audio_url');
            $table->timestamps();
        });

        #Tabel Soal Video
        Schema::create('soal_video', function (Blueprint $table) {
            $table->id();
            $table->foreignId('latihan_id')->constrained('latihan')->onDelete('cascade');
            $table->string('soal');
            $table->string('opsi_a');
            $table->string('opsi_b');
            $table->string('opsi_c');
            $table->string('opsi_d');
            $table->string('jawaban');
            $table->string('video_url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('soal_video');
        Schema::dropIfExists('soal_audio');
        Schema::dropIfExists('soal_gambar');
        Schema::dropIfExists('latihan');
    }
};
