<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriBukuTable extends Migration
{
    public function up()
    {
        Schema::create('kategori_buku', function (Blueprint $table) {
            $table->increments('id_kategori');
            $table->string('nama_kategori', 120)->unique();
            $table->text('deskripsi')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori_buku');
    }
}
