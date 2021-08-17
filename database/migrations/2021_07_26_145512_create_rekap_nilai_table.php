<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_nilai', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penilaian');
            $table->double('jumlah');
            $table->double('rata_rata');
            $table->timestamps();

            // $table->foreign('penilaian_id')->references('id')->on('penilaians')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekap_nilai');
    }
}
