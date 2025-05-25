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
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');
            $table->string('nama');
            $table->string('gambar_url');
            $table->unique(['nama', 'kategori_id']);
            $table->timestamps();
        });

        #Tabel Soal Audio
        Schema::create('soal_audio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('latihan_id')->constrained('latihan')->onDelete('cascade');
            $table->string('audio_url');
            $table->string('opsi_a');
            $table->string('opsi_b');
            $table->string('opsi_c');
            $table->string('opsi_d');
            $table->string('jawaban');
            $table->timestamps();
        });

        #Tabel Soal Video
        Schema::create('soal_video', function (Blueprint $table) {
            $table->id();
            $table->foreignId('latihan_id')->constrained('latihan')->onDelete('cascade');
            $table->string('video_url');
            $table->string('opsi_a');
            $table->string('opsi_b');
            $table->string('opsi_c');
            $table->string('opsi_d');
            $table->string('jawaban');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('soal_video');
        Schema::dropIfExists('soal_audio');
        Schema::dropIfExists('latihan');
    }
};
