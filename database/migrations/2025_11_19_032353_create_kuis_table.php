<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKuisTable extends Migration
{
    public function up()
    {
        Schema::create('kuis', function (Blueprint $table) {
            $table->increments('id_kuis');
            $table->string('judul', 150);
            $table->text('deskripsi')->nullable();
            $table->timestampTz('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kuis');
    }
}
