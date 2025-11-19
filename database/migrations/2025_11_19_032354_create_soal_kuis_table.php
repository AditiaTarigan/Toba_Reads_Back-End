<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalKuisTable extends Migration
{
    public function up()
    {
        Schema::create('soal_kuis', function (Blueprint $table) {
            $table->increments('id_soal');
            $table->integer('id_kuis')->unsigned();
            $table->text('pertanyaan');
            $table->text('opsi_a');
            $table->text('opsi_b');
            $table->text('opsi_c')->nullable();
            $table->text('opsi_d')->nullable();
            $table->char('jawaban', 1);

            $table->foreign('id_kuis')->references('id_kuis')->on('kuis')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('soal_kuis');
    }
}
