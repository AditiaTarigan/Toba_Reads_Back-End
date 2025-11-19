<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateViewRatingBuku extends Migration
{
    public function up()
    {
        DB::statement(
            <<<'SQL'
CREATE OR REPLACE VIEW view_rating_buku AS
SELECT
  b.id_buku,
  b.judul,
  COALESCE(AVG(r.rating), 0)::numeric(3,2) AS rata_rata_rating,
  COUNT(r.id_review) AS jumlah_ulasan
FROM buku b
LEFT JOIN review r ON r.id_buku = b.id_buku
GROUP BY b.id_buku, b.judul;
SQL
        );
    }

    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS view_rating_buku;');
    }
}
