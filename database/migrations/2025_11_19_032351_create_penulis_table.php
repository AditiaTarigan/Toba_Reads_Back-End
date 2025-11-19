<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenulisTable extends Migration
{
    public function up()
    {
        Schema::create('penulis', function (Blueprint $table) {
            $table->increments('id_penulis');
            $table->string('nama_penulis', 150);
            $table->text('bio')->nullable();
            $table->string('foto', 255)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penulis');
    }
}
