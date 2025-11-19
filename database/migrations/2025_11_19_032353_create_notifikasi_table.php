<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateNotifikasiTable extends Migration
{
    public function up()
    {
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->increments('id_notif');
            $table->integer('id_user')->unsigned();
            $table->text('pesan');
            $table->timestampTz('created_at')->useCurrent();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });

        DB::statement("ALTER TABLE notifikasi ADD COLUMN status notif_status NOT NULL DEFAULT 'belum_dibaca';");
    }

    public function down()
    {
        Schema::dropIfExists('notifikasi');
    }
}
