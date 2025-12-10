<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Pastikan Role 'admin' sudah ada
        // Kita cari role berdasarkan nama agar ID-nya dinamis (tidak harus 1)
        $roleAdmin = Role::where('nama_role', 'admin')->first();

        // Safety Check: Jika role belum ada, stop seeder
        if (!$roleAdmin) {
            $this->command->error("Error: Role 'admin' belum ditemukan di tabel roles.");
            $this->command->info("Silakan jalankan 'php artisan db:seed --class=RoleSeeder' terlebih dahulu.");
            return;
        }

        // 2. Buat Akun Admin
        // Gunakan updateOrCreate: Jika email sudah ada, dia update. Jika belum, dia buat baru.
        User::updateOrCreate(
            ['email' => 'admintobareads@gmail.com'], // Cek berdasarkan email ini
            [
                'nama'     => 'Admin TobaReads',
                'password' => Hash::make('tobakelompok4'), // Password default admin
                'no_hp'    => '081234567890',
                'role_id'  => $roleAdmin->id, // Mengambil ID dari role yang ditemukan di atas
            ]
        );
    }
}
