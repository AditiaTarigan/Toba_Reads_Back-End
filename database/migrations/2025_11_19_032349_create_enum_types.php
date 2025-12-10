<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateEnumTypes extends Migration
{
    public function up()
    {
        // PENTING: Lakukan drop dulu di UP() untuk mengatasi bug/caching saat migrate:fresh
        // Kita akan menggunakan DROP TYPE IF EXISTS sebelum CREATE TYPE
        DB::statement('DROP TYPE IF EXISTS book_status;');
        DB::statement('DROP TYPE IF EXISTS karya_status;');
        DB::statement('DROP TYPE IF EXISTS notif_status;');

        // Sekarang kita buat ulang type-nya
        DB::statement("CREATE TYPE book_status AS ENUM ('aktif','nonaktif');");
        DB::statement("CREATE TYPE karya_status AS ENUM ('pending','diterima','ditolak');");
        DB::statement("CREATE TYPE notif_status AS ENUM ('belum_dibaca','dibaca');");
    }

    public function down()
    {
        // Method down ini sudah benar, hanya memastikan drop dilakukan saat rollback normal
        DB::statement('DROP TYPE IF EXISTS notif_status;');
        DB::statement('DROP TYPE IF EXISTS karya_status;');
        DB::statement('DROP TYPE IF EXISTS book_status;');
    }
}
