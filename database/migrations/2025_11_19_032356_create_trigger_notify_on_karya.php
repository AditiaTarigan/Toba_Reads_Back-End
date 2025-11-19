<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTriggerNotifyOnKarya extends Migration
{
    public function up()
    {
        // 1) create function using nowdoc to avoid escaping issues
        DB::unprepared(
            <<<'SQL'
CREATE OR REPLACE FUNCTION fn_notify_on_karya_insert()
RETURNS TRIGGER AS $$
BEGIN
  INSERT INTO notifikasi (id_user, pesan, status, created_at)
  SELECT u.id_user,
    'Karya baru berjudul "' || NEW.judul || '" diunggah oleh user id=' || NEW.id_user || '. Mohon verifikasi.',
    'belum_dibaca',
    now()
  FROM users u
  WHERE u.role = 'admin';

  RETURN NEW;
END;
$$ LANGUAGE plpgsql;
SQL
        );

        // 2) create trigger separately
        DB::unprepared(
            <<<'SQL'
CREATE TRIGGER trg_notify_on_karya
AFTER INSERT ON karya_user
FOR EACH ROW EXECUTE PROCEDURE fn_notify_on_karya_insert();
SQL
        );
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_notify_on_karya ON karya_user;');
        DB::unprepared('DROP FUNCTION IF EXISTS fn_notify_on_karya_insert();');
    }
}
