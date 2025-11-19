<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateKaryaUserTable extends Migration
{
    public function up()
    {
        Schema::create('karya_user', function (Blueprint $table) {
            $table->increments('id_karya');
            $table->integer('id_user')->unsigned();
            $table->string('judul', 255);
            $table->text('isi');
            $table->string('file_lampiran', 255)->nullable();
            $table->timestampTz('created_at')->useCurrent();
            $table->timestampTz('updated_at')->useCurrent();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });

        DB::statement("ALTER TABLE karya_user ADD COLUMN status karya_status NOT NULL DEFAULT 'pending';");
        DB::statement('CREATE INDEX IF NOT EXISTS idx_karya_user ON karya_user (id_user);');
    }

    public function down()
    {
        Schema::dropIfExists('karya_user');
    }
}
