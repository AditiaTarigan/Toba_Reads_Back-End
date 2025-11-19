<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFavoritTable extends Migration
{
    public function up()
    {
        Schema::create('favorit', function (Blueprint $table) {
            $table->increments('id_favorit');
            $table->integer('id_user')->unsigned();
            $table->integer('id_buku')->unsigned();
            $table->timestampTz('created_at')->useCurrent();

            $table->unique(['id_user', 'id_buku']);

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_buku')->references('id_buku')->on('buku')->onDelete('cascade');
        });

        DB::statement('CREATE INDEX IF NOT EXISTS idx_favorit_user ON favorit (id_user);');
    }

    public function down()
    {
        Schema::dropIfExists('favorit');
    }
}
