<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateEnumTypes extends Migration
{
    public function up()
    {
        // DB::statement("CREATE TYPE user_role AS ENUM ('admin','user');");
        DB::statement("CREATE TYPE book_status AS ENUM ('aktif','nonaktif');");
        DB::statement("CREATE TYPE karya_status AS ENUM ('pending','diterima','ditolak');");
        DB::statement("CREATE TYPE notif_status AS ENUM ('belum_dibaca','dibaca');");
    }

    public function down()
    {
        DB::statement('DROP TYPE IF EXISTS notif_status;');
        DB::statement('DROP TYPE IF EXISTS karya_status;');
        DB::statement('DROP TYPE IF EXISTS book_status;');
        // DB::statement('DROP TYPE IF EXISTS user_role;');
    }
}
