<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penilaian');
            $table->unsignedBigInteger('peserta_id');
            $table->unsignedBigInteger('materi_id');
            $table->unsignedBigInteger('ruang_id');
            $table->unsignedBigInteger('penilai_id');
            $table->double('nilai');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('peserta_id')->references('id')->on('pesertas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('materi_id')->references('id')->on('materi_seleksi')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ruang_id')->references('id')->on('ruang')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('penilai_id')->references('id')->on('penilai')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilaians');
    }
}
