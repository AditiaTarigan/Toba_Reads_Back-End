<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,   // <-- WAJIB: Membuat role 'admin' dan 'user'
            AdminSeeder::class,  // <-- WAJIB: Membuat user 'Admin TobaReads' dengan role_id admin
        ]);

        User::factory()->create([
            'nama' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
