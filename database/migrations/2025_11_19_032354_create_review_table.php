<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateReviewTable extends Migration
{
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->increments('id_review');
            $table->integer('id_buku')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->smallInteger('rating');
            $table->text('ulasan')->nullable();
            $table->timestampTz('created_at')->useCurrent();

            $table->unique(['id_buku', 'id_user']);

            $table->foreign('id_buku')->references('id_buku')->on('buku')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });

        DB::statement('CREATE INDEX IF NOT EXISTS idx_review_buku ON review (id_buku);');
        DB::statement('CREATE INDEX IF NOT EXISTS idx_review_user ON review (id_user);');
    }

    public function down()
    {
        Schema::dropIfExists('review');
    }
}
