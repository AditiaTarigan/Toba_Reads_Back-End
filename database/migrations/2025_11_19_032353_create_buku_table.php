<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBukuTable extends Migration
{
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->increments('id_buku');
            $table->string('judul', 255);
            $table->integer('id_penulis')->unsigned()->nullable();
            $table->integer('id_kategori')->unsigned()->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('file_buku', 255)->nullable();
            $table->string('cover', 255)->nullable();
            $table->timestampTz('created_at')->useCurrent();
            $table->timestampTz('updated_at')->useCurrent();

            $table->foreign('id_penulis')->references('id_penulis')->on('penulis')->onDelete('set null');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_buku')->onDelete('set null');
        });

        DB::statement("ALTER TABLE buku ADD COLUMN status book_status NOT NULL DEFAULT 'aktif';");
        DB::statement("CREATE INDEX IF NOT EXISTS buku_search_idx ON buku USING GIN(to_tsvector('simple', coalesce(judul, '') || ' ' || coalesce(deskripsi, '')));");
    }

    public function down()
    {
        DB::statement('DROP INDEX IF EXISTS buku_search_idx;');
        Schema::dropIfExists('buku');
    }
}
