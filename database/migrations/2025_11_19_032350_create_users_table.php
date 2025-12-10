<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_user');

            // Menambahkan kolom foreign key untuk role
            // Menggunakan unsignedInteger karena table roles menggunakan increments (int)
            $table->unsignedInteger('role_id');

            $table->string('nama', 150);
            $table->string('email', 150)->unique();
            $table->string('password', 255);
            $table->string('no_hp', 20)->nullable();

            $table->timestampTz('created_at')->useCurrent();
            $table->timestampTz('updated_at')->useCurrent();

            // Mendefinisikan relasi Foreign Key
            $table->foreign('role_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('cascade'); // Opsional: Hapus user jika role dihapus (atau ubah ke 'restrict')
        });
    }

    public function down()
    {
        // Drop foreign key dulu sebelum drop table (praktik yang baik meski dropIfExists menanganinya)
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
        });

        Schema::dropIfExists('users');
    }
}
