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
            $table->unsignedBigInteger('peserta_id');
            $table->double('lari_total');
            $table->double('lari_meter');
            $table->double('b_inggris_aula');
            $table->double('b_inggris_r_bapak');
            $table->double('agama_aula');
            $table->double('agama_r_bapak');
            $table->double('pbb_aula');
            $table->double('pbb_r_bapak');
            $table->double('seni_budaya_aula');
            $table->double('seni_budaya_r_bapak');
            $table->double('pengetahuan_aula');
            $table->double('pengetahuan_r_bapak');
            $table->double('jumlah');
            $table->double('rata_rata');
            $table->timestamps();

            $table->foreign('peserta_id')->references('id')->on('pesertas')->onUpdate('cascade')->onDelete('cascade');
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
