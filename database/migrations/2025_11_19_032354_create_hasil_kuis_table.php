<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilKuisTable extends Migration
{
    public function up()
    {
        Schema::create('hasil_kuis', function (Blueprint $table) {
            $table->increments('id_hasil');
            $table->integer('id_user')->unsigned();
            $table->integer('id_kuis')->unsigned();
            $table->integer('score');
            $table->timestampTz('waktu')->useCurrent();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_kuis')->references('id_kuis')->on('kuis')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hasil_kuis');
    }
}
