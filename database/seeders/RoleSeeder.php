<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Pastikan nama_role sesuai dengan yang Anda cari di Controller nanti
        Role::create(['nama_role' => 'admin']);
        Role::create(['nama_role' => 'user']);
    }
}
